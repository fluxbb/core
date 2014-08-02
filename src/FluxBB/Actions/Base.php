<?php

namespace FluxBB\Actions;

use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Server\Request;
use FluxBB\Server\Response\Data;
use FluxBB\Server\Response\Error;
use FluxBB\Server\Response\Redirect;
use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Illuminate\Support\MessageBag;

abstract class Base implements MessageProviderInterface
{
    protected $data = [];

    protected $errors = [];

    protected $handlers = [];

    /**
     * @var \FluxBB\Server\Request
     */
    protected $request;


    public function succeeded()
    {
        return ! $this->hasErrors();
    }

    public function failed()
    {
        // TODO: Somehow call the error handlers
        return $this->hasErrors();
    }

    public function hasErrors()
    {
        return ! empty($this->errors);
    }

    protected function handleRequest(Request $request)
    {
        //
    }

    /**
     * Turn a request into a response.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Server\Response\Response
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        try {
            $this->request = $request;
            $this->callHandlers('before');
            $this->handleRequest($request);

            $this->run();

            $response = $this->makeResponse();
            $this->callHandlers('after');
        } catch (\Exception $e) {
            throw $e;
        }

        return $response;
    }

    /**
     * @return \FluxBB\Server\Response\Response
     * @throws \Exception
     */
    protected function makeResponse()
    {
        if ($this->hasErrors()) {
            $request = $this->errorRequest();
            return new Error($request, $this->getErrors());
        } else if ($this->hasRedirect()) {
            $request = $this->nextRequest();
            return new Redirect($request);
        }

        return new Data($this->data);
    }

    protected function hasRedirect()
    {
        return false;
    }

    /**
     * @return \FluxBB\Server\Request
     */
    protected function nextRequest()
    {
        return;
    }

    /**
     * @return \FluxBB\Server\Request
     */
    protected function errorRequest()
    {
        return;
    }

    protected function hasData()
    {
        return ! empty($this->data);
    }

    /**
     * Run any desired actions.
     *
     * @return void
     */
    abstract protected function run();

    protected function addError($error)
    {
        $this->errors[] = $error;
    }

    protected function mergeErrors(ArrayableInterface $errors)
    {
        foreach ($errors->toArray() as $error) {
            $this->addError($error);
        }
    }

    public function getErrors()
    {
        return new MessageBag($this->errors);
    }

    public function trigger($event, $arguments = [])
    {
        \Event::fire($event, $arguments);
    }

    public function before($callback)
    {
        $this->registerHandler('before', $callback);
    }

    public function after($callback)
    {
        $this->registerHandler('after', $callback);
    }

    public function onSuccess($callback)
    {
        $this->registerHandler('success', $callback);
    }

    public function onError($callback)
    {
        $this->registerHandler('error', $callback);
    }

    protected function registerHandler($type, $callback)
    {
        $this->handlers[$type][] = $callback;
    }

    protected function callHandlers($type)
    {
        if (isset($this->handlers[$type])) {
            $arguments = func_get_args();
            $arguments[0] = $this;

            foreach ($this->handlers[$type] as $handler) {
                call_user_func_array($handler, $arguments);
            }
        }
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
