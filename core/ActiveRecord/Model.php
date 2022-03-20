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
     * @param Connection $connection
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
}
