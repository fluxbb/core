<?php

namespace FluxBB;

use Illuminate\Support\Facades\Facade;
use Config;

class Core extends Facade
{

	protected static function getFacadeAccessor()
	{
		return static::$app;
	}

	public static function isInstalled()
	{
		$app = static::$app;
		// TODO: Use Config::has('fluxbb') once this issue is resolved:
		// https://github.com/laravel/framework/issues/63
		return file_exists($app['path'].'/config/fluxbb.php');
	}

	public static function version()
	{
		return '2.0.0-alpha1';
	}

}
