<?php

namespace FluxBB\Web;

use Illuminate\Contracts\View\Factory;
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
        $this->app->singleton('FluxBB\Web\Router', function () {
            return new Router;
        });

        $this->app->singleton('FluxBB\View\ViewInterface', 'FluxBB\View\View');

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
        $this->app->extend('view', function (Factory $view) {
            $view->share('route', function ($name, $parameters = []) {
                return $this->app->make('FluxBB\Web\UrlGeneratorInterface')->toRoute($name, $parameters);
            });

            $view->share('asset', function ($path) {
                return $this->app->make('FluxBB\Web\UrlGeneratorInterface')->toAsset($path);
            });

            $view->share('canonical', function () {
                return $this->app->make('FluxBB\Web\UrlGeneratorInterface')->canonical();
            });

            $view->share('method', function ($name) {
                return $this->app->make('FluxBB\Web\Router')->getMethod($name);
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
        $router = $this->app['FluxBB\Web\Router'];

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
        $router->get('/', 'index', 'FluxBB\Web\Controllers\ForumController@index');
        $router->get('/categories{slug:(?:/[A-Za-z0-9/]*)?}conversations/new', 'new_topic', 'FluxBB\Web\Controllers\ConversationController@createForm');
        $router->post('/categories{slug:(?:/[A-Za-z0-9/]*)?}conversations/new', 'new_topic_handler', 'FluxBB\Web\Controllers\ConversationController@create');
        $router->get('/categories{slug:(?:/[A-Za-z0-9/]*)?}', 'category', 'FluxBB\Web\Controllers\ForumController@category');
        $router->get('/conversations/{id}', 'conversation', 'FluxBB\Web\Controllers\ForumController@conversation');
        $router->get('/post/{id}', 'viewpost', 'FluxBB\Web\Controllers\ForumController@post');
        $router->get('/register', 'register', 'FluxBB\Web\Controllers\AuthController@registerForm');
        $router->post('/register', 'handle_registration', 'FluxBB\Web\Controllers\AuthController@register');
        $router->get('/login', 'login', 'FluxBB\Web\Controllers\AuthController@loginForm');
        $router->post('/login', 'handle_login', 'FluxBB\Web\Controllers\AuthController@login');
        $router->get('/logout', 'logout', 'FluxBB\Web\Controllers\AuthController@logout');
        $router->get('/reset_password', 'reset_password', 'FluxBB\Web\Controllers\AuthController@resetForm');
        $router->get('/profile/{id}', 'profile', 'FluxBB\Web\Controllers\UserController@profile');
        $router->get('/users', 'userlist', '');
        $router->get('/search', 'search', '');
        $router->get('/post/{id}/edit', 'post_edit', 'FluxBB\Web\Controllers\PostController@editForm');
        $router->post('/post/{id}/edit', 'post_edit_handler', 'FluxBB\Web\Controllers\PostController@edit');
        $router->get('/post/{id}/report', 'post_report', 'FluxBB\Web\Controllers\PostController@reportForm');
        $router->get('/post/{id}/delete', 'post_delete', 'FluxBB\Web\Controllers\PostController@deleteForm');
        $router->get('/post/{id}/quote', 'post_quote', '');
        $router->post('/topic/{id}/reply', 'reply_handler', 'FluxBB\Web\Controllers\PostController@create');
        $router->post('/topic/{id}/subscribe', 'topic_subscribe', 'FluxBB\Web\Controllers\ConversationController@subscribe');
        $router->post('/topic/{id}/unsubscribe', 'topic_unsubscribe', 'FluxBB\Web\Controllers\ConversationController@unsubscribe');
        $router->get('/admin', 'admin.index', 'FluxBB\Web\Controllers\Admin\DashboardController@index');
        $router->get('/admin/settings', 'admin.settings.global', 'FluxBB\Web\Controllers\Admin\SettingsController@index');
        $router->get('/admin/settings/email', 'admin.settings.email', 'FluxBB\Web\Controllers\Admin\SettingsController@email');
        $router->get('/admin/settings/maintenance', 'admin.settings.maintenance', 'FluxBB\Web\Controllers\Admin\SettingsController@maintenance');
        $router->get('/admin/dashboard/stats', 'admin.dashboard.stats', 'FluxBB\Web\Controllers\Admin\DashboardController@stats');
        $router->get('/admin/dashboard/updates', 'admin.dashboard.updates', 'FluxBB\Web\Controllers\Admin\DashboardController@updates');
        $router->get('/admin/dashboard/reports', 'admin.dashboard.reports', 'FluxBB\Web\Controllers\Admin\DashboardController@reports');
        $router->get('/admin/groups', 'admin.groups.index', '');
        $router->get('/admin/groups/{id}/edit', 'admin.groups.edit', '');
        $router->get('/admin/groups/{id}/delete', 'admin.groups.delete', '');
        $router->get('/admin/categories', 'admin.categories.index', '');
    }

    /**
     * Register the API routes.
     *
     * @param \FluxBB\Web\Router $router
     * @return void
     */
    protected function registerApiRoutes(Router $router)
    {
        $router->post('/api/v1/settings', 'admin.options.set', 'FluxBB\Web\Controllers\Admin\SettingsController@set');
    }
}
