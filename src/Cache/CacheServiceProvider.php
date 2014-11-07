<?php

namespace FluxBB\Cache;

use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cache.store', function () {
            $files = $this->app->make('files');
            $path = $this->app->make('path.cache');

            return new Repository(new FileStore($files, $path));
        });

        $this->app->alias('cache.store', 'Illuminate\Contracts\Cache\Repository');
    }
}
