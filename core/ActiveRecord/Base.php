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

    public function lowercase()
    {
        return $this->getNameInstance()->lowercase();
    }

    public function uppercase()
    {
        return $this->getNameInstance()->uppercase();
    }

    public function plural()
    {
        return $this->getNameInstance()->plural();
    }

    public function singular()
    {
        return $this->getNameInstance()->singular();
    }
}
