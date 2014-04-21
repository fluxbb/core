<?php

namespace FluxBB\Models;

interface ConfigRepositoryInterface
{
    public function getGlobal();
    public function get($key);
    public function set($key, $value);
    public function isEnabled($key);
    public function isDisabled($key);
}
