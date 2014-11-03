<?php

namespace FluxBB\Web;

use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Session\Store;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Symfony\Component\HttpFoundation\Session\SessionInterface', function () {
            $connection = $this->app->make('Illuminate\Database\ConnectionInterface');
            $handler = new DatabaseSessionHandler($connection, 'sessions');

            return new Store('fluxbb_session', $handler);
        });
    }
}
