<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Core\Action;
use FluxBB\Models\ConfigRepositoryInterface;

class GlobalSettingsPage extends Action
{
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    protected function run()
    {
        $this->data['config'] = $this->config;
    }
}
