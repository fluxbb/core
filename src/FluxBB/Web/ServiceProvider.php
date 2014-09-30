<?php

namespace FluxBB\Web;

use FluxBB\Models\Guest;
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
        $this->app->singleton('fluxbb.web.router', function () {
            return new Router;
        });

        $this->app->singleton('fluxbb.web.renderer', function ($app) {
            return new Renderer($app['view'], $app['redirect'], $app['FluxBB\Web\UrlGeneratorInterface']);
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
    }

    /**
     * Register the view helpers for generating URLs etc.
     *
     * @return void
     */
    protected function registerViewHelpers()
    {
        $app = $this->app;

        $app->extend('view', function ($view, $app) {
            $view->share('route', function ($name, $parameters = []) use ($app) {
                return $app['FluxBB\Web\UrlGeneratorInterface']->toRoute($name, $parameters);
            });

            $view->share('canonical', function () use ($app) {
                return $app['FluxBB\Web\UrlGeneratorInterface']->canonical();
            });

            $view->share('method', function ($name) use ($app) {
                return $app['fluxbb.web.router']->getMethod($name);
            });

            return $view;
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

        $this->registerFrontendRoutes($router);
        $this->registerApiRoutes($router);
    }

    /**
     * Register the frontend routes.
     *
     * @param \FluxBB\Web\Router $router
     * @return void
     */
    protected function registerFrontendRoutes(Router $router)
    {
        $router->get('/', 'index');
        $router->get('categories{slug:(?:/[A-Za-z0-9/]*)?}topics/new', 'new_topic');
        $router->post('categories{slug:(?:/[A-Za-z0-9/]*)?}topics/new', 'new_topic_handler');
        $router->get('categories{slug:(?:/[A-Za-z0-9/]*)?}', 'category');
        $router->get('topics/{id}', 'topic');
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
        $router->get('admin/categories', 'admin.categories.index');
    }

    /**
     * Register the API routes.
     *
     * @param \FluxBB\Web\Router $router
     * @return void
     */
    protected function registerApiRoutes(Router $router)
    {
        $router->post('api/v1/settings', 'admin.options.set');
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
