<?php


namespace app\core;


class Database
{

    /**
     *
     * @author karam mustafa
     * @var \PDO
     */
    public $pdo;
    /**
     *
     * @author karam mustafa
     * @var array
     */
    private $ignoredFile = ['.', '..'];
    /**
     *
     * @author karam mustafa
     * @var array
     */
    private $newMigrations = [];

    /**
     * Database constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        list($dsn, $username, $password) = $this->resolveConfig($config);

        $this->pdo = new \PDO($dsn, $username, $password);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * description
     *
     * @param $config
     *
     * @return array
     * @author karam mustafa
     */
    private function resolveConfig($config)
    {
        return [
            $config['dsn'],
            $config['user'],
            $config['password'],
        ];
    }

    /**
     * description
     *
     * @author karam mustafa
     */
    public function runMigration()
    {
        $this->createMigrationTable();

        $migrations = $this->getCreatedMigrations();

        $files = scandir('./migrations');

        $migrationsToCreate = array_diff($files, $migrations);

        $this->getNewMigrations($migrationsToCreate);

        $this->saveMigrations();
    }

    /**
     * description
     *
     * @author karam mustafa
     */
    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
        id INT AUTO_INCREMENT,
        migration varchar(255),
        created_at timestamp default current_timestamp,
        PRIMARY KEY (id)
        ) ENGINE=INNODB;");

    }

    /**
     * description
     *
     * @return array
     * @author karam mustafa
     */
    private function getCreatedMigrations()
    {
        $query = $this->pdo->prepare("SELECT migration from migrations");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_COLUMN);

    }

    /**
     * description
     *
     * @author karam mustafa
     */
    private function saveMigrations()
    {
        if (!empty($this->newMigrations)) {

            $fixedMigrationsName = array_map(function ($m) {
                return "('$m')";
            }, $this->newMigrations);

            $records = implode(",", $fixedMigrationsName);

            $query = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES {$records}");

            $query->execute();

            $tableCount = sizeof($this->newMigrations);

            $this->display("Migrate Done successfully, $tableCount table was created");

        } else {
            $this->display('No Thing to migrate');
        }
    }

    /**
     * description
     *
     * @param  array  $migrationsToCreate
     *
     * @author karam mustafa
     */
    private function getNewMigrations($migrationsToCreate)
    {
        foreach ($migrationsToCreate as $migration) {

            if (in_array($migration, $this->ignoredFile)) {
                continue;
            }

            $fileName = pathinfo($migration, PATHINFO_FILENAME);

            $instance = require_once './migrations/'.$migration;

            $this->display('Migrating '.$fileName);

            $instance->init(Application::$instance->db);

            $this->display('Migrated '.$fileName);

            $this->newMigrations[] = $migration;

        }
    }

    private function display($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }

    public function refresh()
    {

        $dbName = env('DB_NAME');
        $statement = Application::$instance->db->pdo->query(
            "SELECT GROUP_CONCAT(Concat('TRUNCATE TABLE ',table_schema,'.',TABLE_NAME) SEPARATOR ';') FROM INFORMATION_SCHEMA.TABLES where table_schema in ('$dbName');
        ")->execute();

        $this->display('Dropped All tables successfully ');
        $this->display('Migration all tables ...');

//        $this->runMigration();

    }


}
