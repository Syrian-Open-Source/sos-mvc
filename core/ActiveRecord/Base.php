<?php


namespace app\core\ActiveRecord;


class Base
{
    /**
     * The ReflectionClass instance
     *
     * @var \ReflectionClass
     */
    protected $reflection;

    /**
     * The class to inspect
     *
     * @param  \app\core\ActiveRecord\Model  $model
     *
     * @return void
     * @throws \ReflectionException
     */
    public function __construct(Model $model)
    {
        $this->reflection = new \ReflectionClass($model);
    }
}
