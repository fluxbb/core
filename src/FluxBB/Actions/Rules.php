<?php

namespace FluxBB\Actions;

use FluxBB\Models\Config;
use Symfony\Component\HttpFoundation\Request;

class Rules extends Page
{
    protected $viewName = 'fluxbb::misc.rules';


    protected function handleRequest(Request $request)
    {
        $this->data['rules'] = Config::get('o_rules_message');
    }
}
