<?php

namespace FluxBB\Integration\Laravel;

use FluxBB\Web\Dispatcher;
use Illuminate\Support\ServiceProvider as Base;

class ServiceProvider extends Base
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FluxBB\Web\UrlGeneratorInterface', function ($app) {
            return new UrlGenerator($app['fluxbb.web.router'], $app['url']);
        });

        $this->app->singleton('FluxBB\Auth\AuthenticatorInterface', 'FluxBB\Integration\Laravel\Authenticator');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->createLaravelRoute();
    }

    /**
     * Register the catch-all route with the Laravel router.
     *
     * @return void
     */
    protected function createLaravelRoute()
    {
        $prefix = $this->app->make('config')->get('fluxbb.route_prefix', '');

        $this->app->make('router')->any($prefix.'/{uri}', ['as' => 'fluxbb', 'uses' => function () {
            $dispatcher = new Dispatcher(
                $this->app->make('fluxbb.web.router'),
                $this->app->make('FluxBB\Web\ControllerFactory'),
                $this->app
            );

            return $dispatcher->handle($this->app->make('request'));
        }])->where('uri', '.*');
    }
}
