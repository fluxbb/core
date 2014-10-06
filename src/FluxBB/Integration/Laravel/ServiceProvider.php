<?php

namespace FluxBB\Integration\Laravel;

use FluxBB\Models\Guest;
use FluxBB\Web\JsonRenderer;
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
        $this->app->make('router')->before(function () {
            if ($this->app->make('request')->ajax()) {
                $this->app->singleton('fluxbb.web.renderer', function () {
                    $redirect = $this->app->make('redirect');
                    $generator = $this->app->make('FluxBB\Web\UrlGeneratorInterface');
                    return new JsonRenderer($redirect, $generator);
                });
            }
        });

        $prefix = $this->app->make('config')->get('fluxbb.route_prefix', '');

        $this->app->make('router')->any($prefix.'/{uri}', ['as' => 'fluxbb', 'uses' => function ($uri) {
            $method = $this->app->make('request')->method();
            $parameters = $this->app->make('request')->input();
            $user = $this->app->make('auth')->user();

            $request = $this->app->make('fluxbb.web.router')->getRequest($method, $uri, $parameters);
            $response = $this->app->make('fluxbb.server')->dispatch($request, $user ?: new Guest());

            return $this->app->make('fluxbb.web.renderer')->render($response);
        }])->where('uri', '.*');
    }
}
