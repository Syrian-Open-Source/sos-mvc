<?php


use app\core\Database;

return new class {

    public function init(Database $db)
    {
        $query = "create table users (
                id INT,
                name VARCHAR(255) not null,
                password VARCHAR(255) not null
                )";

        $db->pdo->exec($query);
    }

};
