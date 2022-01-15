<?php


namespace app\core;


/**
 * Class Runner
 *
 * @author karam mustafa
 * @package app\core
 */
class Runner
{
    /**
     *
     * @author karam mustafa
     * @var \app\core\Application
     */
    public Application $application;

    /**
     * Runner constructor.
     *
     * @param  \app\core\Application  $application
     * @param  string  $type
     */
    public function __construct(Application $application, string $type)
    {
        $this->application = $application;
        $this->resolveCommand($type);
    }

    /**
     * find the command key and run the found code.
     *
     * @param $type
     *
     * @author karam mustafa
     */
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
