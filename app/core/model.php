<?php

namespace app\core;

class Model {
    protected $pdo;

    public function __construct() {

        $this->pdo = Db::instance();
    }

    public function getUserStats($login) {
        $sql = "SELECT `login`, `win`, `lose` FROM `{$this->userTable}` WHERE `login` = ?";
        return $this->pdo->query($sql,[$login]);
    }

}