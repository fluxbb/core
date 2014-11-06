<?php

namespace FluxBB\Web\Assets;

class Container implements CompilerInterface, ContainerInterface
{
    protected $assets = [];


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
