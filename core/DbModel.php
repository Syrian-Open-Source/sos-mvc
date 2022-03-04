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

        $statement = $this->prepare("INSERT INTO $table (".implode(",", $attributes).") 
                                         VALUES (".implode(",", $params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }


    public function prepare(string $sql)
    {
        return Application::$instance->db->pdo->prepare($sql);
    }
}
