<?php

namespace FluxBB\Server;

use FluxBB\Models\HasPermissions;

interface ServerInterface
{
    /**
     * Resolve the request and return a response.
     *
     * @param \FluxBB\Server\Request $request
     * @param \FluxBB\Models\HasPermissions $subject
     * @return \FluxBB\Server\Response\Response
     * @throws \FluxBB\Server\Exception\Exception
     */
    public function dispatch(Request $request, HasPermissions $subject);
}
