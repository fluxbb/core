<?php

namespace FluxBB\Actions;

use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Server\Request;
use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Illuminate\Support\MessageBag;

abstract class Base implements MessageProviderInterface
{
    protected $handlers = array();

    protected $errors = array();

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
     * @return \Illuminate\Http\Response
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
        } catch (ValidationException $e) {
            return $this->errorRedirectTo($this->urlOnError());
        } catch (\Exception $e) {
            throw $e;
        }

        return $response;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    abstract protected function makeResponse();

    /**
     * @return string
     */
    protected function urlOnError()
    {
        return '';
    }

    protected function redirectTo($url)
    {
        return \Redirect::to($url);
    }

    protected function errorRedirectTo($url)
    {
        return \Redirect::to($url)
            ->withInput()
            ->withErrors($this);
    }

    /**
     * Run any desired actions.
     *
     * @return void
     */
    protected function run()
    {
        //
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
