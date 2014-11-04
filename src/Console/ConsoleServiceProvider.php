<?php

namespace FluxBB\Console;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FluxBB\Console\CommandFactory', function () {
            return new CommandFactory($this->app);
        });
    }
}
