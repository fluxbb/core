<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\Config;

class Rules extends Action
{
    protected function run()
    {
        $this->data['rules'] = Config::get('o_rules_message');
    }
}
