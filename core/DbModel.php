<?php


namespace app\core;


/**
 * Class DbModel
 *
 * @author karam mustafa
 * @package app\core
 */
abstract class DbModel extends Model
{

    /**
     * description
     *
     * @return array
     * @author karam mustafa
     */
    abstract public function attributes(): array;

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    abstract public function tableName(): string;


    /**
     * description
     *
     * @return bool
     * @author karam mustafa
     */
    public function save()
    {
        $table = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($param) => ":$param", $attributes);

        $statement = static::prepare("INSERT INTO $table (".implode(",", $attributes).") 
                                         VALUES (".implode(",", $params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }


    /**
     * description
     *
     * @param $where
     *
     * @return mixed
     * @author karam mustafa
     */
    public function find($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode('AND', array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value){
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    /**
     * description
     *
     * @param  string  $sql
     *
     * @return bool|\PDOStatement
     * @author karam mustafa
     */
    public static function prepare(string $sql)
    {
        return Application::$instance->db->pdo->prepare($sql);
    }
}
