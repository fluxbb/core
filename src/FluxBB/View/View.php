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
        if (!str_contains($name, '::')) {
            $name = "fluxbb::$name";
        }

        return $this->factory->make($name, $data)->render();
    }
}
