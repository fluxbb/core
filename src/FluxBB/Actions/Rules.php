<?php

namespace FluxBB\Actions;

use FluxBB\Models\Config;

class Rules extends Base
{
    protected function run()
    {
        $this->data['rules'] = Config::get('o_rules_message');
    }
}
