<?php

namespace FluxBB\Integration\Laravel;

use FluxBB\Web\Router;
use FluxBB\Web\UrlGeneratorInterface;
use Illuminate\Contracts\Routing\UrlGenerator as LaravelGenerator;

class UrlGenerator implements UrlGeneratorInterface
{
    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $generator;


    public function __construct(Router $router, LaravelGenerator $generator)
    {
        $this->router = $router;
        $this->generator = $generator;
    }

    public function toRoute($handler, $parameters = [])
    {
        $path = $this->router->getPath($handler, $parameters);
        return $this->getUrlToPath($path);
    }

    public function toAsset($path)
    {
        return $this->generator->asset($path);
    }

    public function canonical()
    {
        $path = $this->router->getCurrentPath();
        return $this->getUrlToPath($path);
    }

    protected function getUrlToPath($path)
    {
        return $this->generator->route('fluxbb', ['url' => $path]);
    }
}
