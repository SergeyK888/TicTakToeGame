<?php
class Model_Login extends app\core\Model {
    public $userTable = 'users';

    public function loginCheck($login, $password) {

       $sql = "SELECT `login`, `password` FROM `{$this->userTable}` WHERE `login` = ?";
       $result = $this->pdo->query($sql,[$login]);

       if(!$result) {
          $this->setRegistrData($login, $password);
          return true;
       } else {
          return $result;
       }
    }

//    public function getUserStats($login) {
//        $sql = "SELECT `login`, `win`, `lose` FROM `{$this->table}` WHERE `login` = ?";
//        return $this->pdo->query($sql,[$login]);
//    }

    private function setRegistrData($login, $password) {

        $sql = "INSERT INTO `{$this->userTable}` (`login`, `password`) VALUES (?, ?)";
        $this->pdo->exec($sql, [$login, password_hash($password, PASSWORD_DEFAULT)]);
    }
}