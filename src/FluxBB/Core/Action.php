<?php

namespace FluxBB\Core;

use FluxBB\Server\Request;
use FluxBB\Server\Response;
use FluxBB\Server\ServerInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\MessageBag;

abstract class Action implements MessageProvider
{
    /**
     * All input data passed into the action.
     *
     * @var array
     */
    protected $input = [];

    /**
     * All errors that occurred in this action.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * The server instance.
     *
     * @var \FluxBB\Server\ServerInterface
     */
    protected $server;

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

        return $this->makeResponse($data ?: []);
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
     * Create a response based on the action's status.
     *
     * @param array $data
     * @return \FluxBB\Server\Response
     * @throws \Exception
     */
    protected function makeResponse($data)
    {
        return new Response($data);
    }

    /**
     * Set another request to be executed after this action.
     *
     * @param \FluxBB\Server\Request $next
     * @return array
     */
    protected function forwardTo(Request $next)
    {
        return $this->server->dispatch($next)->getData();
    }

    /**
     * Add another error message.
     *
     * @param string $error
     * @return $this
     */
    protected function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * Add the given list of error messages.
     *
     * @param \Illuminate\Contracts\Support\Arrayable $errors
     * @return $this
     */
    protected function mergeErrors(Arrayable $errors)
    {
        foreach ($errors->toArray() as $error) {
            $this->addError($error);
        }

        return $this;
    }

    /**
     * Get all error messages gathered in this action.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return new MessageBag($this->errors);
    }

    /**
     * Set the server instance.
     *
     * @param \FluxBB\Server\ServerInterface $server
     * @return void
     */
    public function setServer(ServerInterface $server)
    {
        $this->server = $server;
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

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->getErrors();
    }
}
