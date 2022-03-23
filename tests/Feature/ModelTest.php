<?php


namespace Feature;


use app\core\ActiveRecord\Connection;
use app\core\ActiveRecord\ModelStub;

class ModelTest extends \BaseTest
{
    /**
     *
     * @author karam mustafa
     * @var \app\core\ActiveRecord\ModelStub
     */
    private ModelStub $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = new ModelStub(new Connection(", "));
    }

    public function testConnectionMethodHasConnection()
    {
        $this->assertInstanceOf(Connection::class, $this->model->connection());
    }
}
