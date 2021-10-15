<?php


namespace app\core;


class Database
{

    public $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO($dsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
