<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Actions\Page;
use FluxBB\Models\ConfigRepositoryInterface;
use Illuminate\View\Factory;

class GlobalSettingsPage extends Page
{
    protected $viewName = 'fluxbb::admin.settings.global';

    protected $config;


    public function __construct(ConfigRepositoryInterface $config, Factory $view)
    {
        parent::__construct($view);
        $this->config = $config;
    }

    protected function run()
    {
        $this->data['config'] = $this->config->getGlobal();
    }
}
