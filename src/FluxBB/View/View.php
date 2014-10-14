<?php

namespace FluxBB\View;

use Illuminate\Contracts\View\Factory;

class View implements ViewInterface
{
    protected $factory;


    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Render the given view.
     *
     * @param string $name
     * @param array $data
     * @return string
     */
    public function render($name, array $data)
    {
        return $this->factory->make("fluxbb::$name", $data)->render();
    }
}
