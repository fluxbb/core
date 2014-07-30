<?php

namespace FluxBB\Actions;

use FluxBB\Models\Config;

class Rules extends Page
{
    protected $viewName = 'fluxbb::misc.rules';


    protected function run()
    {
        $this->data['rules'] = Config::get('o_rules_message');
    }
}
