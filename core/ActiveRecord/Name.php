<?php


namespace app\core\ActiveRecord;


class Name
{
    /**
     * The name
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new Name instance
     *
     * @param string $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

}
