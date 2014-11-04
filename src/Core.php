<?php

namespace FluxBB;

use Illuminate\Support\Facades\Facade;

class Core extends Facade
{
    protected static function getFacadeAccessor()
    {
        return static::$app;
    }

    public static function isInstalled()
    {
        return static::$app->make('config')->hasGroup('fluxbb');
    }

    public static function version()
    {
        return '2.0.0-alpha1';
    }
}
