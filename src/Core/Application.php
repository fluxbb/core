<?php

namespace FluxBB\Core;

use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application as AppContract;

class Application extends Container implements AppContract
{
    protected $basePath;

    protected $isBooted = false;

    protected $bootingCallbacks = [];

    protected $bootedCallbacks = [];

    protected $registered = [];


    public function __construct($basePath)
    {
        static::setInstance($this);

        $this->basePath = $basePath;

        $this->instance('app', $this);

        $this->alias('app', 'Illuminate\Container\Container');
        $this->alias('app', 'Illuminate\Contracts\Container\Container');

        $this->register('Illuminate\Events\EventServiceProvider');
    }

    public function register($provider, $options = [], $force = false)
    {
        $provider = $this->makeProvider($provider);

        $provider->register();

        if ($this->isBooted) {
            $provider->boot();
        }
    }

    /**
     * @param string $providerClass
     * @return \Illuminate\Support\ServiceProvider
     */
    protected function makeProvider($providerClass)
    {
        $provider = new $providerClass($this);

        $this->registered[] = $provider;

        return new $provider($this);
    }

    public function boot()
    {
        if ($this->isBooted) {
            return;
        }

        $this->fireAppCallbacks($this->bootingCallbacks);

        foreach ($this->registered as $provider) {
            $provider->boot();
        }

        $this->isBooted = true;

        $this->fireAppCallbacks($this->bootedCallbacks);
    }

    private function fireAppCallbacks($callbacks)
    {
        foreach ($callbacks as $callback) {
            $callback($this);
        }
    }

    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        // TODO: Implement version() method.
    }

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     * @return string
     */
    public function environment()
    {
        // TODO: Implement environment() method.
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        // TODO: Implement isDownForMaintenance() method.
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        // TODO: Implement registerConfiguredProviders() method.
    }

    /**
     * Register a deferred provider and service.
     *
     * @param  string $provider
     * @param  string $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        // TODO: Implement registerDeferredProvider() method.
    }

    /**
     * Register a new boot listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booting($callback)
    {
        $this->bootingCallbacks[] = $callback;
    }

    /**
     * Register a new "booted" listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booted($callback)
    {
        $this->bootedCallbacks[] = $callback;
    }
}
