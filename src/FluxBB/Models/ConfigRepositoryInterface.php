<?php

namespace FluxBB\Models;

interface ConfigRepositoryInterface
{

	public function getGlobal();
	public function set($key, $value);

}
