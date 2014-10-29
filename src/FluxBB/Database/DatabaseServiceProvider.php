<?php

namespace FluxBB\Database;

use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\Model;
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

        $this->app->singleton('Illuminate\Database\ConnectionResolverInterface', function () {
            $resolver = new ConnectionResolver([
                'fluxbb' => $this->app->make('Illuminate\Database\ConnectionInterface'),
            ]);
            $resolver->setDefaultConnection('fluxbb');

            return $resolver;
        });
    }

    public function boot()
    {
        Model::setConnectionResolver($this->app->make('Illuminate\Database\ConnectionResolverInterface'));
    }
}
