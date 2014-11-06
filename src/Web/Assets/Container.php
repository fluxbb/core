<?php

namespace FluxBB\Web\Assets;

use FluxBB\Web\UrlGeneratorInterface;

class Container implements CompilerInterface, ContainerInterface
{
    /**
     * @var \FluxBB\Web\UrlGeneratorInterface
     */
    protected $generator;

    protected $assets = [];


    public function __construct(UrlGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function load($name, $path)
    {
        $this->assets[$name] = $path;

        return $this;
    }

    public function forget($name)
    {
        unset($this->assets[$name]);
    }

    public function dump()
    {
        $tags = [];
        foreach ($this->assets as $name => $path) {
            $tags[] = $this->createTag($path);
        }

        return $tags;
    }

    protected function createTag($path)
    {
        $parts = explode('.', $path);
        $extension = end($parts);

        $path = $this->generator->toAsset($path);

        return $this->{'create'.ucfirst($extension).'Tag'}($path);
    }

    protected function createJsTag($path)
    {
        return '<script type="text/javascript" src="'.$path.'"></script>';
    }

    protected function createCssTag($path)
    {
        return '<link rel="stylesheet" type="text/css" href="'.$path.'" />';
    }
}
