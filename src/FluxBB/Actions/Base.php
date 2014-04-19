<?php

namespace FluxBB\Actions;

use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Illuminate\Support\MessageBag;

abstract class Base implements MessageProviderInterface
{
    protected $handlers = array();

    protected $errors = array();


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
        $arguments = func_get_args();
        $arguments[0] = $this;

        foreach ($this->handlers[$type] as $handler)
        {
            call_user_func_array($handler, $arguments);
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
