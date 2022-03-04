<?php


namespace app\core;


class Runner
{
    public Application $application;

    public function __construct(Application $application, string $type)
    {
        $this->application = $application;
        $this->resolveCommand($type);
    }

    private function resolveCommand($type)
    {
        if ($type == 'migrate') {
            $this->application->db->runMigration();
        }

        if ($type == 'db:refresh') {
            $this->application->db->refresh();
        }
    }


}
