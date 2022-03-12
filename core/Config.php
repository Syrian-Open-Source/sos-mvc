<?php


namespace app\core;


use Dotenv\Dotenv;

class Config
{

    /**
     * get env config
     *
     * @return array
     * @author karam mustafa
     */
    public function getEnv()
    {

        $env = Dotenv::createImmutable(__DIR__."./../");
        $env->load();
        return [
            'db' => [
                'dsn' => $_ENV['DB_DSN'],
                'user' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
            ]
        ];
    }
}
