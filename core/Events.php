<?php


namespace app\core;


/**
 * Class Events
 *
 * @author karam mustafa
 * @package app\core
 */
class Events
{


    /**
     *
     * @author karam mustafa
     * @var array
     */
    private array $events;

    /**
     * @return mixed
     * @author karam mustafa
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param  string  $event
     * @param  null|callable  $callback
     *
     * @return \app\core\Events
     * @author karam mustafa
     */
    public function setEvents($event, $callback = null)
    {
        $this->events[$event] = $callback;

        return $this;
    }

    /**
     * description
     *
     * @param $event
     * @param  null  $callback
     *
     * @return $this
     * @author karam mustafa
     */
    public function on($event, $callback = null)
    {
        $this->setEvents($event, $callback);

        return $this;
    }


}
