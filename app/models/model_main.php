<?php

class Model_Main extends app\core\Model {
    public $table = 'game';
    public $userTable = 'users';
    protected $whoWin = 0;
    protected $draw;

    public function leave($roomid) {
        $sql = "UPDATE `{$this->table}` SET `finished`= ? WHERE `roomid` = ?";
        $this->pdo->exec($sql,[true, $roomid]);

        return  true;
    }
    // старт игры: генерируем hash комнаты и поле
    public function start($username) {

        $roomid = md5(uniqid(rand(), true));
        $field = [ [0,0,0],
                   [0,0,0],
                   [0,0,0]
                 ];
        $field = serialize($field);

        $sql = "INSERT INTO `{$this->table}` (`roomid`, `field`, `player1`, `player2`, `player1name`) VALUES (?, ?, ?, ?, ?)";
        $this->pdo->exec($sql, [$roomid, $field, true, 0, $username]);

        $sql = "SELECT `id` FROM `{$this->table}` WHERE `roomid` = ?";
        $id = $this->pdo->query($sql,[$roomid]);
        $id = $id[0]['id'];

        return ['roomid' => $roomid, 'id' => $id];
    }
    // ход игрока забираем поле с базы меняем нужное значение и возвращаем назад
    public function turn($player, $roomid, $whogoes, $row, $col,$username) {

        $sql = "SELECT `field`, `draw` FROM `{$this->table}` WHERE `roomid` = ?";
        $field = $this->pdo->query($sql,[$roomid]);
        $this->draw = $field[0]['draw'];
        $field = unserialize($field[0]['field']);
        $field[$row][$col] = (int)$player;
        $field = serialize($field);
        (int)$whogoes == 1 ? $whogoes = 2 : $whogoes = 1;

        $sql = "UPDATE `{$this->table}` SET `field`= ?, `whogoes`= ? WHERE `roomid` = ?";
        $this->pdo->exec($sql,[$field, $whogoes, $roomid]);

        if($this->winCheck(unserialize($field), $roomid)) {
            $this->setWinner($player, $roomid,$username);
            $this->endGame($roomid);
        }

        $playerOptions = ['whowin' => $this->whoWin,
                          'whogoes' => $whogoes,
                          'field' => unserialize($field),
                          'draw' => $this->draw
                         ];

        return $playerOptions;
    }
    // присоединение к комнате, возвращем данные комнаты
    public function join($id, $username) {
        $sql = "SELECT * FROM {$this->table} WHERE `id` = ?";
        $player = $this->pdo->query($sql,[$id]);
        $player = $player[0];

        if(($player['player2'] == 0) && ($player['player1name'] !== $username)){
           $player['player2'] = 2;
           $this->setSecondPlayer($player['roomid'], $username);

           return  ['roomid' => $player['roomid'],
                    'field' => unserialize($player['field']),
                    'whogoes' => $player['whogoes'],
                    'player1' => $player['player1'],
                    'player2' => $player['player2'],
                   ];
        } else {
            return [];
        }

    }
    // проверка хода игрока, победы, поражения и ничьи
    public function statusCheck($roomid) {
        $sql = "SELECT `field`, `whogoes`, `whowin`,`player1name`, `player2name`, `draw` FROM `{$this->table}` WHERE `roomid` = ?";
        $field = $this->pdo->query($sql,[$roomid]);
        $field = $field[0];

       return $data = ['field' => unserialize($field['field']),
                       'whogoes' => $field['whogoes'],
                       'whowin' => $field['whowin'],
                       'player1name' => $field['player1name'],
                       'player2name' => $field['player2name'],
                       'draw' => $field['draw']
                      ];
    }
    // список доступных игр
    public function listGames() {
        $sql = "SELECT `id`, `roomid`, `player1name` FROM `{$this->table}` WHERE  `finished` = ? AND `player2` = ?";
        return $this->pdo->query($sql,[false, 0]);
    }
    // список рейтига
    public function listRatings() {
        $sql = "SELECT * FROM `{$this->userTable}` ORDER BY `users`.`score` DESC LIMIT 5";

        return $this->pdo->query($sql,[false, 0]);
    }
    //записываем победителся для партии и обновляем статистику игроков
    private function setWinner($player, $roomid,$username) {
        $sql = "UPDATE `{$this->table}` SET `whowin` = ? WHERE `roomid` = ?";
        $this->pdo->exec($sql,[$player, $roomid]);

        $sql = "SELECT `player1name`, `player2name` FROM `{$this->table}` WHERE `roomid` = ?";
        $players = $this->pdo->query($sql,[$roomid]);
        $players = $players[0];

        //рейтинг в процессе...
        $score_round = rand(25, 35);
        $rating_titles = [
            0 => [
                'title' => 'Новичок',
                'range_score' => [0, 500]
            ],
            1 =>[
                'title' => 'Профессионал',
                'range_score' => [500, 1500]
            ],
            2 =>[
                'title' => 'Мастер',
                'range_score' => [1500, 3000]
            ],
            3 =>[
                'title' => 'Титан',
                'range_score' => [3000, 5000]
            ],
        ];
        if($username == $players['player1name']) {
            $sql = "UPDATE `{$this->userTable}` SET `win` = `win` + 1, `score` = `score` + $score_round WHERE `login` = ?";
            $this->pdo->exec($sql,[$players['player1name']]);

            $sql = "UPDATE `{$this->userTable}` SET `lose` = `lose` + 1, `score` = `score` - $score_round WHERE `login` = ?";
            $this->pdo->exec($sql,[$players['player2name']]);
        } else {
            $sql = "UPDATE `{$this->userTable}` SET `lose` = `lose` + 1, `score` = `score` - $score_round WHERE `login` = ?";
            $this->pdo->exec($sql,[$players['player1name']]);

            $sql = "UPDATE `{$this->userTable}` SET `win` = `win` + 1, `score` = `score` + $score_round WHERE `login` = ?";
            $this->pdo->exec($sql,[$players['player2name']]);
        }

    }

    private function winCheck($field, $roomid) {
        // проверка победителя
       if(((($field[0][0] == $field[0][1]) && ($field[0][1] == $field[0][2])) && ($field[0][0] != 0)) ||
           (($field[1][0] == $field[1][1]) && ($field[1][1] == $field[1][2]) && ($field[1][0] != 0))  ||
           (($field[2][0] == $field[2][1]) && ($field[2][1] == $field[2][2]) && ($field[2][0] != 0))  ||
           (($field[0][0] == $field[1][1]) && ($field[1][1] == $field[2][2]) && ($field[0][0] != 0))  ||
           (($field[0][2] == $field[1][1]) && ($field[1][1] == $field[2][0]) && ($field[0][2] != 0))  ||
           (($field[0][0] == $field[1][0]) && ($field[1][0] == $field[2][0]) && ($field[0][0] != 0))  ||
           (($field[0][2] == $field[1][2]) && ($field[1][2] == $field[2][2]) && ($field[0][2] != 0))

         ) return true;
        // проверка на ничью , если ничья,  записывает в базу
        if((($field[0][0] != 0) && ($field[0][1] != 0) && ($field[0][2] != 0))  &&
            (($field[1][0] != 0) && ($field[1][1] != 0) && ($field[1][2] != 0)) &&
            (($field[2][0] != 0) && ($field[2][1] != 0) && ($field[2][2] != 0))

        )   $this->setDraw($roomid);

        return false;
    }

    private function setDraw($roomid) {
        $sql = "UPDATE `{$this->table}` SET `draw`= 1 WHERE `roomid` = ?";
        $this->pdo->exec($sql, [$roomid]);
    }

    private function endGame($room) {
        $sql = "UPDATE `{$this->table}` SET `finished`= ? WHERE `roomid` = ?";
        $this->pdo->exec($sql, [true, $room]);
    }
    //записывем данные второго игрока для комнаты
    private function setSecondPlayer($roomid, $username) {
        $sql = "UPDATE `{$this->table}` SET `player2`= 2, `player2name`= ? WHERE `roomid` = ?";
        $this->pdo->exec($sql, [$username,$roomid]);
    }

}