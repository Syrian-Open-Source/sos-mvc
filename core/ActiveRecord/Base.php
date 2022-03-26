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

    /**
     * Convert the name to lowercase
     *
     * @return \app\core\ActiveRecord\Name
     * @author karam mustafa
     */
    public function lowercase()
    {
        return $this->getNameInstance()->lowercase();
    }

    /**
     * Convert the name to uppercase
     *
     * @return \app\core\ActiveRecord\Name
     * @author karam mustafa
     */
    public function uppercase()
    {
        return $this->getNameInstance()->uppercase();
    }

    /**
     * Convert the name to plural
     *
     * @return \app\core\ActiveRecord\Name
     * @author karam mustafa
     */
    public function plural()
    {
        return $this->getNameInstance()->plural();
    }

    /**
     * Convert the name to singular
     *
     * @return \app\core\ActiveRecord\Name
     * @author karam mustafa
     */
    public function singular()
    {
        return $this->getNameInstance()->singular();
    }

    protected function getNameInstance()
    {
        return new Name($this->reflection->getShortName());
    }
}
