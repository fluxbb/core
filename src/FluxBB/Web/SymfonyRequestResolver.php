<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Request;

class SymfonyRequestResolver implements RequestResolverInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;


    /**
     * Create the resolver instance.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the HTTP method of the request.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->request->getMethod();
    }

    /**
     * Get the URI path we are requesting.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->request->getPathInfo();
    }

    /**
     * Get any parameters sent along with the request.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->request->query->all() + $this->request->attributes->all();
    }
}
