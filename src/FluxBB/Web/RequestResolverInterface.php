<?php

namespace FluxBB\Web;

interface RequestResolverInterface
{
    /**
     * Get the HTTP method of the request.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Get the URI path we are requesting.
     *
     * @return string
     */
    public function getUri();

    /**
     * Get any parameters sent along with the request.
     *
     * @return array
     */
    public function getParameters();

    /**
     * Get the request instance.
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest();
}
