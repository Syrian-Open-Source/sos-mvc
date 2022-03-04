<?php


namespace app\core;


abstract class DbModel extends Model
{

    abstract public function attributes(): array;

    abstract public function tableName(): string;

    public function save()
    {

    }
}
