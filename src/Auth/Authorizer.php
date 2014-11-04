<?php

namespace FluxBB\Auth;

use FluxBB\Models\HasPermissions;
use FluxBB\Server\Exception\NoPermission;

abstract class Authorizer
{
    /**
     * Authorize the given user.
     *
     * Should throw an exception if authorization fails.
     *
     * @param \FluxBB\Models\HasPermissions $subject
     * @return void
     * @throws \FluxBB\Server\Exception\NoPermission
     */
    abstract public function authorize(HasPermissions $subject);

    /**
     * Make sure the given check passes, otherwise throw an exception.
     *
     * @param bool $check
     * @return $this
     * @throws \FluxBB\Server\Exception\NoPermission
     */
    protected function authorizedIf($check)
    {
        if (!$check) {
            throw new NoPermission;
        }

        return $this;
    }
}
