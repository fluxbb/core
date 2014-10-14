<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Server\Request;

class Home extends Action
{
    protected function run()
    {
        return $this->forwardTo(
            new Request('category', ['slug' => '/'])
        );
    }
}
