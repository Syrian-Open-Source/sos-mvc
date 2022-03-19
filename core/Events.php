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
    private array $eventListeners;

    /**
     * @return mixed
     * @author karam mustafa
     */
    public function getEvents()
    {
        return $this->eventListeners;
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
        $this->eventListeners[$event] = $callback;
        dd($this->eventListeners);

        return $this;
    }

    /**
     * description
     *
     * @param  string  $event
     * @param  null| callable  $callback
     *
     * @return $this
     * @author karam mustafa
     */
    public function on($event, $callback = null)
    {
        $this->setEvents($event, $callback);

        return $this;
    }

    /**
     * description
     *
     * @param $event
     *
     * @return $this
     * @author karam mustafa
     */
    public function trigger($event)
    {
        $callbacks = $this->eventListeners[$event] ?? [];

        foreach ($callbacks as $callback) {

            call_user_func($callback);
        }

        return $this;
    }


}
