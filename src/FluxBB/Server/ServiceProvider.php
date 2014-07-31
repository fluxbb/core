<?php

namespace FluxBB\Server;

use Illuminate\Support\ServiceProvider as Base;

class ServiceProvider extends Base
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('fluxbb.server', function($app) {
            return new Server($app);
        });

        $this->app->bindShared('fluxbb.router', function($app) {
            return new Router;
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHandlers();
        $this->registerRoutes();
        $this->registerLaravelRoute();
    }

    /**
     * Register the handlers with the server.
     *
     * @return void
     */
    protected function registerHandlers()
    {
        $server = $this->app['fluxbb.server'];

        $server->register('index', 'FluxBB\Actions\Home');
        $server->register('viewforum', 'FluxBB\Actions\ViewForum');
        $server->register('viewtopic', 'FluxBB\Actions\ViewTopic');
        $server->register('viewpost', 'FluxBB\Actions\ViewPost');
        $server->register('register', 'FluxBB\Actions\RegisterPage');
        $server->register('handle_registration', 'FluxBB\Actions\Register');
        $server->register('login', 'FluxBB\Actions\LoginPage');
        $server->register('handle_login', 'FluxBB\Actions\Login');
        $server->register('logout', 'FluxBB\Actions\Logout');
        $server->register('reset_password', 'FluxBB\Actions\PasswordResetPage');
        $server->register('profile', 'FluxBB\Actions\ProfilePage');
        $server->register('userlist', 'FluxBB\Actions\UsersPage');
        $server->register('rules', 'FluxBB\Actions\Rules');
        $server->register('search', 'FluxBB\Actions\SearchPage');
    }

    /**
     * Register the routes with the router.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $router = $this->app['fluxbb.router'];

        $router->get('/', 'index');
        $router->get('forum/{id}', 'viewforum');
        $router->get('topic/{id}', 'viewtopic');
        $router->get('post/{id}', 'viewpost');
        $router->get('register', 'register');
        $router->post('register', 'handle_registration');
        $router->get('login', 'login');
        $router->post('login', 'handle_login');
        $router->get('logout', 'logout');
        $router->get('reset_password', 'reset_password');
        $router->get('profile/{id}', 'profile');
        $router->get('users', 'userlist');
        $router->get('rules', 'rules');
        $router->get('search', 'search');
    }

    /**
     * Register the catch-all route with the Laravel router.
     *
     * @return void
     */
    protected function registerLaravelRoute()
    {
        $app = $this->app;
        $prefix = $app['config']->get('fluxbb.route_prefix', '');

        $app['router']->any($prefix.'/{uri}', function ($uri) use ($app) {
            $method = $app['request']->method();

            $request = $app['fluxbb.router']->getRequest($method, $uri);
            $action = $app['fluxbb.server']->resolve($request->getHandler());

            return $action->handle($request);
        })->where('uri', '.*');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('fluxbb.server', 'fluxbb.router');
    }
}
