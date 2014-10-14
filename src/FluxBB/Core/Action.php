<?php

namespace FluxBB\Core;

use FluxBB\Models\HasPermissions;
use FluxBB\Server\Exception\NoPermission;
use FluxBB\Server\Request;
use FluxBB\Server\Response\Data;
use FluxBB\Server\Response\Error;
use FluxBB\Server\Response\Redirect;
use FluxBB\Server\ServerInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\MessageBag;

abstract class Action implements MessageProvider
{
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
     * The request that led to this action.
     *
     * @var \FluxBB\Server\Request
     */
    protected $request;

    /**
     * The request that the user should send next.
     *
     * @var \FluxBB\Server\Request
     */
    protected $nextRequest;

    /**
     * A message to be sent along with the next request.
     *
     * @var string
     */
    protected $redirectMessage = '';

    /**
     * The request to be executed in case of an error.
     *
     * @var \FluxBB\Server\Request
     */
    protected $errorRequest;


    /**
     * Set the request instance.
     *
     * @param \FluxBB\Server\Request $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Turn a request into a response.
     *
     * @return \FluxBB\Server\Response\Response
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $data = $this->run();

            $response = $this->makeResponse($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return $response;
    }

    /**
     * Run any desired actions.
     *
     * @return array
     */
    abstract protected function run();

    /**
     * Create a response based on the action's status.
     *
     * @return \FluxBB\Server\Response\Response
     * @throws \Exception
     */
    protected function makeResponse($data)
    {
        if ($this->hasErrors()) {
            return $this->makeErrorResponse($this->getErrors());
        } else if (isset($this->nextRequest)) {
            return new Redirect($this->nextRequest, $this->redirectMessage);
        }

        return new Data($data, $this->request);
    }

    /**
     * Create an error response for the given errors.
     *
     * @param \Illuminate\Support\MessageBag $errors
     * @return \FluxBB\Server\Response\Error
     * @throws \Exception
     */
    protected function makeErrorResponse(MessageBag $errors)
    {
        if (! isset($this->errorRequest)) {
            throw new \Exception('Cannot handle error, no handler declared.');
        }

        return new Error($this->errorRequest, $errors);
    }

    /**
     * Set another request that the user should send next.
     *
     * @param \FluxBB\Server\Request $next
     * @param string $message
     * @return void
     */
    protected function redirectTo(Request $next, $message = '')
    {
        $this->nextRequest = $next;
        $this->redirectMessage = $message;
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
     * Set a request to be executed in case of an error.
     *
     * @param \FluxBB\Server\Request $next
     * @return void
     */
    protected function onErrorRedirectTo(Request $next)
    {
        $this->errorRequest = $next;
    }

    /**
     * Determine whether this action yielded any data.
     *
     * @return bool
     */
    protected function hasData()
    {
        return ! empty($this->data);
    }

    /**
     * Determine whether the action encountered any errors.
     *
     * @return bool
     */
    public function hasErrors()
    {
        return ! empty($this->errors);
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
