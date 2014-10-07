<?php

namespace FluxBB\Server\Exception;

use FluxBB\Server\Request;

class Forward extends Exception
{
    protected $next;


    public function __construct(Request $next)
    {
        $this->next = $next;
    }

    /**
     * Get the request that should be executed next.
     *
     * @return \FluxBB\Server\Request
     */
    public function getNextRequest()
    {
        return $this->next;
    }
}
