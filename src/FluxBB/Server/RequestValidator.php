<?php

namespace FluxBB\Server;

use Illuminate\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;

class RequestValidator implements ServerInterface
{
    /**
     * The wrapped server instance.
     *
     * @var \FluxBB\Server\ServerInterface
     */
    protected $next;

    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * The validator classes for registered handlers.
     *
     * @var array
     */
    protected $validators = [];


    /**
     * Create the request validator instance.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     * @param \FluxBB\Server\ServerInterface $next
     */
    public function __construct(Container $container, ServerInterface $next)
    {
        $this->container = $container;
        $this->next = $next;
    }

    /**
     * Register a validator to be used for a given action.
     *
     * @param string $name
     * @param string $validatorClass
     * @return $this
     */
    public function registerValidator($name, $validatorClass)
    {
        $this->validators[$name] = $validatorClass;

        return $this;
    }

    /**
     * Resolve the request and return a response.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Server\Response\Response
     * @throws \FluxBB\Server\Exception\Exception
     */
    public function dispatch(Request $request)
    {
        $this->validate($request);

        return $this->next->dispatch($request);
    }

    /**
     * Validate the given request.
     *
     * @param \FluxBB\Server\Request $request
     * @return void
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    protected function validate(Request $request)
    {
        $validator = $this->resolveValidator($request);

        if ($validator) {
            $validator->validate($request);
        }
    }

    /**
     * Resolve the matching validator instance.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Core\Validator|null
     */
    protected function resolveValidator(Request $request)
    {
        if (! isset($this->validators[$request->getHandler()])) {
            return null;
        }

        try {
            $validatorClass = $this->validators[$request->getHandler()];
            return $this->container->make($validatorClass);
        } catch (BindingResolutionException $e) {
            return null;
        }
    }
}
