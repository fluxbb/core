<?php

namespace FluxBB\Core;

use Illuminate\Container\Container;

class Application extends Container
{
    protected $isBooted = false;

    protected $registered = [];


    public function __construct()
    {
        static::setInstance($this);

        $this->instance('app', $this);

        $this->alias('app', 'Illuminate\Container\Container');
        $this->alias('app', 'Illuminate\Contracts\Container\Container');

        $this->register('Illuminate\Events\EventServiceProvider');
    }

    /**
     * @param string $provider
     * @return void
     */
    public function register($provider)
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

        foreach ($this->registered as $provider) {
            $provider->boot();
        }

        $this->isBooted = true;
    }
}
