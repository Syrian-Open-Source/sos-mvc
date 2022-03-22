<?php


namespace app\core\ActiveRecord;


abstract class Model
{
    /**
     * The HTTP connection
     *
     * @var Connection
     */
    protected Connection $connection;
    /**
     * The model's attributes
     *
     * @var array
     */
    protected array $attributes = [];

    /**
     * The model's fillable attributes
     *
     * @var array
     */
    protected array $fillable = [];

    /**
     * Inject the Connection dependency
     *
     * @param  Connection  $connection
     *
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get the connection instance
     *
     * @return \app\core\ActiveRecord\Connection
     * @author karam mustafa
     */
    public function connection()
    {
        return $this->connection;
    }

    /**
     * Set attribute on object
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return void
     */
    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * description
     *
     * @param $key
     *
     * @return mixed
     * @author karam mustafa
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        throw new Exception("{$key} is not a valid property");
    }
    public function __set($key, $value)
    {
        if ($this->isFillable($key)) {
            return $this->setAttribute($key, $value);
        }

        throw new Exception("{$key} is not a valid property");
    }
    /**
     * description
     *
     * @param $key
     *
     * @return bool
     * @author karam mustafa
     */
    protected function isFillable($key)
    {
        if (in_array($key, $this->fillable)) return true;
    }

    /**
     * description
     *
     * @param  array  $attributes
     *
     * @return array
     * @author karam mustafa
     */
    protected function fillableFromArray(array $attributes)
    {
        if (count($this->fillable) > 0) {
            return array_intersect_key($attributes, array_flip($this->fillable));
        }

        return $attributes;
    }

    /**
     * description
     *
     * @param  array  $attributes
     *
     * @author karam mustafa
     */
    protected function fill(array $attributes)
    {
        foreach ($this->fillableFromArray($attributes) as $key => $value) {
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            }
        }
    }


}
