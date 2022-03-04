<?php


class k001_init
{
    public function init()
    {
        $db = \app\core\Application::$instance->db;

        $query = "create table users (
                id INT,
                email VARCHAR(255) not null,
                password VARCHAR(255) not null
                )";

        $db->pdo->exec($query);
    }
}
