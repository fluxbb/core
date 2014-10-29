<?php

namespace FluxBB\Core;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Adapter\Local as LocalAdapter;

class FilesystemServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('files', function () {
            return new Filesystem();
        });

        $this->app->singleton('filesystem', function () {
            $flysystem = new Flysystem(new LocalAdapter($this->app->make('path')));
            return new FilesystemAdapter($flysystem);
        });

        $this->app->alias('filesystem', 'Illuminate\Contracts\Filesystem\Filesystem');
    }
}
