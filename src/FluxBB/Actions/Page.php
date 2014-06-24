<?php

namespace FluxBB\Actions;

use Illuminate\View\Factory;

abstract class Page extends Base
{
    /**
     * @var string
     */
    protected $viewName = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \Illuminate\View\Factory
     */
    protected $view;


    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    protected function makeResponse()
    {
        return $this->view->make($this->viewName, $this->data);
    }
}
