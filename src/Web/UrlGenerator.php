<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Request;

class UrlGenerator implements UrlGeneratorInterface
{
    protected $router;

    protected $request;


    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    public function toRoute($handler, $parameters = [])
    {
        $path = $this->router->getPath($handler, $parameters);
        $path = ltrim($path, '/');

        return $this->request->getBaseUrl().'/'.$path;
    }

    public function toAsset($path)
    {
        return $this->request->getBaseUrl().'/'.$path;
    }

    public function canonical()
    {
        $path = $this->router->getCurrentPath();

        return $this->request->getBaseUrl().'/'.$path;
    }
}
