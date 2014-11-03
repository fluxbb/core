<?php

namespace FluxBB\Auth;

use FluxBB\Core;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Illuminate\Contracts\Auth\Guard', function () {
            $hasher = $this->app->make('Illuminate\Contracts\Hashing\Hasher');
            $session = $this->app->make('request')->getSession();

            $provider = new EloquentUserProvider($hasher, 'FluxBB\Models\User');
            $guard = new Guard($provider, $session);

            $guard->setCookieJar($this->app->make('Illuminate\Contracts\Cookie\QueueingFactory'));
            $guard->setDispatcher($this->app->make('Illuminate\Contracts\Events\Dispatcher'));
            $guard->setRequest($this->app->make('Symfony\Component\HttpFoundation\Request'));

            return $guard;
        });

        if (Core::isInstalled()) {
            $this->app->extend('view', function ($view) {
                $view->share('user', $this->app->make('Illuminate\Contracts\Auth\Guard')->user());

                return $view;
            });
        }
    }
}
