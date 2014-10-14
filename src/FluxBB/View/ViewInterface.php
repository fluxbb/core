<?php

namespace FluxBB\View;

interface ViewInterface
{
    /**
     * Render the given view.
     *
     * @param string $name
     * @param array $data
     * @return string
     */
    public function render($name, array $data);
}
