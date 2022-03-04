<?php


namespace app\core;


abstract class DbModel extends Model
{

    abstract public function attributes(): array;

    abstract public function tableName(): string;

    public function save()
    {
        $table = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($param) => ":$param", $attributes);
        $sqlParams = implode(",",$attributes);
        $sqlValues = implode(",",$params);

        $statement = $this->prepare("INSERT INTO $table (\"$sqlParams\") VALUES (\"$sqlValues\")");

        dd($statement);
    }


    public function prepare(string $sql)
    {
        return Application::$instance->db->pdo->prepare($sql);
    }
}
