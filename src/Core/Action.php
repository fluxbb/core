<?php

namespace FluxBB\Core;

use FluxBB\Server\Response;
use Illuminate\Contracts\Events\Dispatcher;

abstract class Action
{
    /**
     * All input data passed into the action.
     *
     * @var array
     */
    protected $input = [];

    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;


    /**
     * Turn a request into a response.
     *
     * @param array $input
     * @return \FluxBB\Server\Response
     */
    public function execute(array $input = [])
    {
        $this->input = $input;
        $data = $this->run();

        return new Response($data ?: []);
    }

    /**
     * Run any desired actions.
     *
     * @return array|null
     */
    abstract protected function run();

    /**
     * Get an input variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function get($key, $default = null)
    {
        return array_get($this->input, $key, $default);
    }

    /**
     * Set the event dispatcher instance.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function setEvents(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Raise the given event.
     *
     * @param object $event
     * @return void
     */
    protected function raise($event)
    {
        $qualified = get_class($event);
        $name = str_replace('\\', '.', $qualified);

        $this->events->fire($name, [$event]);
    }
}
