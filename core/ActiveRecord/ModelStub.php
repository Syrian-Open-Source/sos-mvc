<?php


namespace app\core\ActiveRecord;


class ModelStub extends Model
{
    protected array $fillable = ["name", "email"];

    public function __construct(Connection $connection, $attributes = [])
    {
        parent::__construct($connection);

        $this->fill($attributes);
    }
}
