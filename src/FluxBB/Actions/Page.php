<?php

namespace FluxBB\Actions;

use Illuminate\View\Factory;

abstract class Page extends Base
{
    protected $viewName = '';

    protected $view;


    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    protected function makeResponse()
    {
        return $this->view->make($this->viewName);
    }
}
