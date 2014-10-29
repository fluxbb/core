<?php

namespace FluxBB\Database;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Support\ServiceProvider;
use PDO;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Illuminate\Database\ConnectionInterface', function () {
            $factory = new ConnectionFactory($this->app);

            $connection = $factory->make($this->app['config']->get('fluxbb.database'));
            $connection->setEventDispatcher($this->app->make('Illuminate\Contracts\Events\Dispatcher'));
            $connection->setFetchMode(PDO::FETCH_CLASS);

            return $connection;
        });
    }
}
