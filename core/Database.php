<?php


namespace app\core;


class Database
{

    public $pdo;

    public function __construct($config)
    {
        list($dsn, $username, $password) = $this->resolveConfig($config);

        $this->pdo = new \PDO($dsn, $username, $password);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    private function resolveConfig($config)
    {
        return [
            $config['dsn'],
            $config['user'],
            $config['password'],
        ];
    }
}
