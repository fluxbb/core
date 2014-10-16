<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConfigRepositoryInterface;

class GetSettings extends Action
{
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    protected function run()
    {
        return ['config' => $this->config];
    }
}
