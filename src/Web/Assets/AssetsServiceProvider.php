<?php

namespace FluxBB\Web\Assets;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('fluxbb.assets', function () {
            return new Container();
        });

        $this->app->alias('fluxbb.assets', 'FluxBB\Web\Assets\ContainerInterface');
        $this->app->alias('fluxbb.assets', 'FluxBB\Web\Assets\CompilerInterface');

        $this->app->extend('view', function (Factory $view) {
            $view->share('assets', function () {
                $compiler = $this->app->make('FluxBB\Web\Assets\CompilerInterface');
                $tags = $compiler->dump();

                return implode("\n", $tags);
            });

            $view->share('asset', function ($name, $path) {
                $container = $this->app->make('FluxBB\Web\Assets\ContainerInterface');

                $container->load($name, $path);
            });

            return $view;
        });
    }
}
