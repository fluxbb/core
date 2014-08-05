<?php

namespace FluxBB\Web;

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
        $this->app->bindShared('fluxbb.web.router', function () {
            return new Router;
        });

        $this->app->bindShared('fluxbb.web.renderer', function ($app) {
            return new Renderer($app['view'], $app['redirect'], $app['fluxbb.web.router']);
        });

        $this->app->bindShared('fluxbb.web.url', function ($app) {
            return new LaravelUrlGenerator($app['fluxbb.web.router'], $app['url']);
        });

        $this->registerViewHelpers();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerLaravelRoute();
    }

    /**
     * Register the view helpers for generating URLs etc.
     *
     * @return void
     */
    protected function registerViewHelpers()
    {
        $app = $this->app;

        $app->resolving('view', function ($view) use ($app) {
            $view->share('route', function ($name, $parameters = []) use ($app) {
                return $app['fluxbb.web.url']->toRoute($name, $parameters);
            });

            $view->share('canonical', function () use ($app) {
                return $app['fluxbb.web.url']->canonical();
            });

            $view->share('method', function ($name) use ($app) {
                return $app['fluxbb.web.router']->getMethod($name);
            });
        });
    }

    /**
     * Register the routes with the router.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $router = $this->app['fluxbb.web.router'];

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
        $router->get('post/{id}/edit', 'post_edit');
        $router->post('post/{id}/edit', 'post_edit_handler');
        $router->get('post/{id}/report', 'post_report');
        $router->get('post/{id}/delete', 'post_delete');
        $router->get('post/{id}/quote', 'post_quote');
        $router->post('topic/{id}/reply', 'reply_handler');
        $router->post('topic/{id}/subscribe', 'topic_subscribe');
        $router->post('topic/{id}/unsubscribe', 'topic_unsubscribe');
        $router->get('forum/{id}/topic/new', 'new_topic');
        $router->post('forum/{id}/topic/new', 'new_topic_handler');
        $router->get('admin', 'admin.index');
        $router->get('admin/settings', 'admin.settings.global');
        $router->get('admin/settings/email', 'admin.settings.email');
        $router->get('admin/settings/maintenance', 'admin.settings.maintenance');
        $router->get('admin/dashboard/stats', 'admin.dashboard.stats');
        $router->get('admin/dashboard/updates', 'admin.dashboard.updates');
        $router->get('admin/dashboard/reports', 'admin.dashboard.reports');
        $router->get('admin/groups', 'admin.groups.index');
        $router->get('admin/groups/{id}/edit', 'admin.groups.edit');
        $router->get('admin/groups/{id}/delete', 'admin.groups.delete');
        $router->post('admin/settings/{key}', 'admin.options.set');
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

        $app['router']->any($prefix.'/{uri}', ['as' => 'fluxbb', 'uses' => function ($uri) use ($app) {
            $method = $app['request']->method();
            $parameters = $app['request']->input();

            $request = $app['fluxbb.web.router']->getRequest($method, $uri, $parameters);
            $response = $app['fluxbb.server']->dispatch($request);

            return $app['fluxbb.web.renderer']->render($request, $response);
        }])->where('uri', '.*');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['fluxbb.web.router', 'fluxbb.web.renderer'];
    }
}
