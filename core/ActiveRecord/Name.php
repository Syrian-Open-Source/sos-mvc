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
    /**
     * Return the name as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    /**
     * Convert the name to singular
     *
     * @return \app\core\ActiveRecord\Name
     */
    public function singular()
    {
    }

    /**
     * Convert the name to plural
     *
     * @return \app\core\ActiveRecord\Name
     */
    public function plural()
    {
    }
    /**
     * Convert the name to lowercase
     *
     * @return \app\core\ActiveRecord\Name
     */
    public function lowercase()
    {
    }

    /**
     * Convert the name to uppercase
     *
     * @return \app\core\ActiveRecord\Name
     */
    public function uppercase()
    {
    }

}
