<?php

namespace FluxBB\Models;

interface ConfigRepositoryInterface
{
    public function has($key);
    public function get($key = null);
    public function set($key, $value);
    public function isEnabled($key);
    public function isDisabled($key);
}
