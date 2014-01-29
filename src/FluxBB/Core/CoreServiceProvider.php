<?php

namespace FluxBB\Core;

use Illuminate\Support\ServiceProvider;
use FluxBB\Models\GroupRepository;
use FluxBB\Models\ConfigRepository;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('fluxbb/core', 'fluxbb');

        include __DIR__.'/../../start.php';
        include __DIR__.'/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('FluxBB\Models\GroupRepositoryInterface', function ($app) {
            return new GroupRepository($app['cache']);
        });

        $this->app->bind('FluxBB\Models\ConfigRepositoryInterface', function ($app) {
            return new ConfigRepository($app['cache']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
