<?php

namespace FluxBB\Server;

use FluxBB\Models\Guest;
use Illuminate\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;

class AuthorizationServer implements ServerInterface
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
     * The authorizer classes for registered handlers.
     *
     * @var array
     */
    protected $authorizers = [];


    /**
     * Create the authorization server instance.
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
     * Register an authorizer to be used for a given action.
     *
     * @param string $name
     * @param string $authorizerClass
     * @return $this
     */
    public function registerAuthorizer($name, $authorizerClass)
    {
        $this->authorizers[$name] = $authorizerClass;

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
        $this->authorize($request);

        return $this->next->dispatch($request);
    }

    /**
     * Authorize the given request.
     *
     * @param \FluxBB\Server\Request $request
     * @return void
     * @throws \FluxBB\Server\Exception\NoPermission
     */
    protected function authorize(Request $request)
    {
        $authorizer = $this->resolveAuthorizer($request);

        if ($authorizer) {
            $authorizer->authorize($this->getSubject());
        }
    }

    /**
     * Resolve the matching authorizer instance.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Auth\Authorizer|null
     */
    protected function resolveAuthorizer(Request $request)
    {
        if (! isset($this->authorizers[$request->getHandler()])) {
            return null;
        }

        try {
            $authorizerClass = $this->authorizers[$request->getHandler()];
            return $this->container->make($authorizerClass);
        } catch (BindingResolutionException $e) {
            return null;
        }
    }

    /**
     * Get the authorization subject from the environment.
     *
     * @return \FluxBB\Models\HasPermissions
     */
    protected function getSubject()
    {
        $subject = $this->container->make('auth')->user();

        return $subject ?: new Guest();
    }
}
