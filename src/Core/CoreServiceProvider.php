<?php

namespace FluxBB\Core;

use FluxBB\Models\CategoryRepository;
use FluxBB\Models\ConversationRepository;
use FluxBB\Models\GroupRepository;
use FluxBB\Models\ConfigRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerViewComposers();
        $this->registerEventHandlers();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLangNamespace();
        $this->registerViewNamespace();
    }

    /**
     * Register the IoC container bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('FluxBB\Models\GroupRepositoryInterface', function ($app) {
            return new GroupRepository($app['cache']);
        });

        $this->app->bind('FluxBB\Models\ConfigRepositoryInterface', function ($app) {
            return new ConfigRepository($app['cache.store'], $app['Illuminate\Database\ConnectionInterface']);
        });

        $this->app->bind('FluxBB\Models\CategoryRepositoryInterface', function ($app) {
            return new CategoryRepository($app['Illuminate\Database\ConnectionInterface']);
        });

        $this->app->bind('FluxBB\Models\ConversationRepositoryInterface', function ($app) {
            return new ConversationRepository($app['Illuminate\Database\ConnectionInterface']);
        });
    }

    /**
     * Register any view composers.
     *
     * @return void
     */
    protected function registerViewComposers()
    {
        $this->app->extend('view', function (Factory $view) {
            $view->composer('fluxbb::layout.main', 'FluxBB\View\AlertsComposer');
            $view->composer('fluxbb::layout.main', 'FluxBB\View\GlobalsComposer');
            $view->composer('fluxbb::admin.layout.main', 'FluxBB\View\GlobalsComposer');

            return $view;
        });
    }

    /**
     * Register any event handlers.
     *
     * @return void
     */
    protected function registerEventHandlers()
    {
        $events = $this->app['events'];

        $events->listen('FluxBB.Events.UserHasRegistered', 'FluxBB\Handlers\SendWelcomeEmail');
        $events->listen('FluxBB.Events.UserHasPosted', 'FluxBB\Handlers\UpdateUserPostStats');
        //$events->listen('FluxBB.Events.UserHasPosted', 'FluxBB\Handlers\UpdateForumStats');
    }

    /**
     * Register a localization namespace for the package.
     *
     * @return void
     */
    protected function registerLangNamespace()
    {
        $langPath = __DIR__ . '/../../lang';
        $this->loadTranslationsFrom($langPath, 'fluxbb');
    }

    /**
     * Register a view namespace for the package.
     *
     * @return void
     */
    protected function registerViewNamespace()
    {
        $viewPath = __DIR__ . '/../../views';
        $this->loadViewsFrom($viewPath, 'fluxbb');

        // Add another namespace for localized mail templates
        $locale = $this->app['config']['app.locale'];
        $mailPath = __DIR__ . '/../../lang/' . $locale . '/mail/';
        $this->loadViewsFrom($mailPath, 'fluxbb:mail');
    }
}
