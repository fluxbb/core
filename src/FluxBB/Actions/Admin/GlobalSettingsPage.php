<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Actions\Base;
use FluxBB\Models\ConfigRepositoryInterface;

class GlobalSettingsPage extends Base
{
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    protected function run()
    {
        $this->data['config'] = $this->config->getGlobal();
    }
}
