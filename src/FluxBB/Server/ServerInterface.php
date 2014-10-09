<?php

namespace FluxBB\Server;

interface ServerInterface
{
    /**
     * Resolve the request and return a response.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Server\Response\Response
     * @throws \FluxBB\Server\Exception\Exception
     */
    public function dispatch(Request $request);
}
