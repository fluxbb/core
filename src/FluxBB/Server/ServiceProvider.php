<?php

namespace FluxBB\Server;

use Illuminate\Support\ServiceProvider as Base;
use FluxBB\Core\ActionFactory;

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
        $this->app->bindShared('fluxbb.server', function ($app) {
            return new Server(new ActionFactory($app));
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
        $server->register('post_edit', 'FluxBB\Actions\EditPostPage');
        $server->register('post_edit_handler', 'FluxBB\Actions\EditPost');
        $server->register('reply_handler', 'FluxBB\Actions\Reply');
        $server->register('topic_subscribe', 'FluxBB\Actions\SubscribeTopic');
        $server->register('topic_unsubscribe', 'FluxBB\Actions\UnsubscribeTopic');
        $server->register('new_topic', 'FluxBB\Actions\NewTopicPage');
        $server->register('new_topic_handler', 'FluxBB\Actions\NewTopic');
        $server->register('admin.index', 'FluxBB\Actions\Admin\DashboardPage');
        $server->register('admin.settings.global', 'FluxBB\Actions\Admin\GlobalSettingsPage');
        $server->register('admin.settings.email', 'FluxBB\Actions\Admin\EmailSettingsPage');
        $server->register('admin.settings.maintenance', 'FluxBB\Actions\Admin\MaintenanceSettingsPage');
        $server->register('admin.dashboard.updates', 'FluxBB\Actions\Admin\UpdatesPage');
        $server->register('admin.dashboard.stats', 'FluxBB\Actions\Admin\StatsPage');
        $server->register('admin.dashboard.reports', 'FluxBB\Actions\Admin\ReportsPage');
        $server->register('admin.options.set', 'FluxBB\Actions\Admin\SetOption');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['fluxbb.server'];
    }
}
