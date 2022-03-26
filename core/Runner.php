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
     *
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * find the command key and run the found code.
     *
     * @param $type
     *
     * @return bool
     * @author karam mustafa
     */
    public function resolveCommand($type)
    {
        if ($type == 'migrate') {
            $this->application->db->runMigration();
        }

        if ($type == 'db:refresh') {
            $this->application->db->refresh();
        }

        return true;
    }


}
