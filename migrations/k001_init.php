<?php


use app\core\Database;

return new class {

    public function init(Database $db)
    {
        $query = "CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT,
        name varchar(255),
        password varchar(255),
        PRIMARY KEY (id)
        ) ENGINE=INNODB;)";

        $db->pdo->exec($query);
    }

};
