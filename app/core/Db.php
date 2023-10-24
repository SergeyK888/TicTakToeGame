<?php
namespace app\core;

use \PDO as PDO;

class Db {
    protected $pdo;
    protected static $instance;

    protected function __construct() {

        $db = require 'app/config/config_db.php';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    /**
     * Singleton
     * @return Db
     */
    public static function instance() {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Запрос в базу на добавление или создание таблиц и т.д
     * @param $sql - запрос
     * @return bool
     */
    public function exec($sql, $prep) {

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($prep);
    }

    /**
     * Выполняет запросы в базу для различного поиска
     * @param $sql - запрос
     * @return array
     */
    public function query($sql, $prep) {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($prep);
        if($res !== false)
        {
            return $stmt->fetchAll();
        }
        return [];
    }
}