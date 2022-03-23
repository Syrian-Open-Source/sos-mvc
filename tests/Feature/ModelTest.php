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

    /**
     * test get connection instance when the model initialized
     *
     * @author karam mustafa
     */
    public function testConnectionMethodHasConnection()
    {
        $this->assertInstanceOf(Connection::class, $this->model->connection());
    }

    /**
     * test get plural class name
     *
     * @throws \ReflectionException
     * @author karam mustafa
     */
    public function testGetPluralEntityName()
    {
        $this->assertEquals('modelstubs', $this->model->base()->lowercase()->plural());
    }
}
