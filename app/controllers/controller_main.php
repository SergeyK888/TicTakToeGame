<?php
use app\core\imageLoadResize;

class Controller_Main extends app\core\controller {

    function __construct() {

        $this->model = new Model_Main();
        parent::__construct();
    }

    function action_index() {

        $this->view->generate('template_view.php');
    }

    function action_start() {

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $roomData = $this->model->start($username);

            $this->view->start($roomData, 1);
        }

    }

    function action_turn() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
         $player = $_POST['player'];
         $roomid = $_POST['roomid'];
         $whogoes = $_POST['whogoes'];
         $row = $_POST['row'];
         $col = $_POST['col'];
         $username = $_POST['username'];
        }

        if($player == $whogoes)

            $field = $this->model->turn($player, $roomid, $whogoes, $row, $col,$username);
            $this->view->returnData($field);
    }

    function action_join() {

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $playerOptions = $this->model->join($id, $username);
            $this->view->returnData($playerOptions);
        }


    }

    function action_check() {

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $roomid = $_POST['roomid'];
        }

       $status = $this->model->statusCheck($roomid);
       $this->view->returnData($status);
    }

    function action_opponent() {

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $opponent = $_POST['opponent'];
        }

        $result = $this->model->getUserStats($opponent);
        $this->view->returnData($result[0]);
    }
    // список игр
    function action_list() {
        $listGames = $this->model->listGames();
        $this->view->returnData($listGames);
    }

    // список топ 5
    function action_ratings() {
        $listGames = $this->model->listRatings();
        $this->view->returnData($listGames);
    }

    function action_leave() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $room = $_POST['room'];

        }

        $this->model->leave($room);
        $this->view->returnData(true);
    }

}