<?php

class Controller_Login extends app\core\controller {
     protected $login;
     protected $password;

    function __construct() {

        $this->model = new Model_Login();
        parent::__construct();
    }

    function action_index() {

        $this->view->generate('loginTemplate_view.php');
    }

    function action_login() {
        //проверка отправки с нашей формы
        if( $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['do_login'] === 'login' ) {
            $this->login = htmlspecialchars($_POST['login']);
            $this->password = htmlspecialchars($_POST['password']);

        }
         else {
           header('Location:/login/');
        }
        //сравнение данных пользователя
       $result = $this->model->loginCheck($this->login, $this->password);
       if($result){
            $bd_login = $result[0]['login'];
            $bd_password = $result[0]['password'];

           if($this->login == $bd_login && password_verify($this->password, $bd_password)) {
               $_SESSION['player'] = $this->login;
               header('Location:/main/');
           } else {
               header('Location:/login');
           }
       } else {
          header('Location:/login');
       }
        exit();
    }

    function action_registrPage() {
        $this->view->generate('registrTemplate_view.php');
    }
    // регистрация пользователя
    function action_registr() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['do_registration'] === 'registration') {
            $this->login = htmlspecialchars($_POST['login']);
            $this->password = htmlspecialchars($_POST['password']);
        }

        if(!$this->model->loginCheck($this->login, $this->password)){
            header('Location:/login/registrPage');
        } else {
            $_SESSION['player'] = $this->login;
            header('Location:/main/');
        }
    }

    function action_getUserStats() {
        if(isset($_SESSION['player'])) $result = $this->model->getUserStats($_SESSION['player']);
        $this->view->returnData($result[0]);
    }

}