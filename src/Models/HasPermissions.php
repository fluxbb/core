<?php

namespace FluxBB\Models;

interface HasPermissions
{
    public function may($action);
}
