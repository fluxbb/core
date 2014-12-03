<?php

namespace FluxBB\Server;

use Illuminate\Support\ServiceProvider as Base;
use FluxBB\Core\ActionFactory;

class ServerServiceProvider extends Base
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
        $this->app->singleton('fluxbb.server.core', function ($app) {
            $server = new Server(new ActionFactory($app));
            $this->registerActions($server);

            return $server;
        });

        $this->app->singleton('FluxBB\Server\ServerInterface', function ($app) {
            return $app->make('fluxbb.server.core');
        });

        $this->app->extend('FluxBB\Server\ServerInterface', function ($server, $app) {
            $validator = new RequestValidator($app, $server);
            $this->registerValidators($validator);

            return $validator;
        });

        $this->app->extend('FluxBB\Server\ServerInterface', function ($server, $app) {
            $authorization = new AuthorizationServer($app, $server);
            $this->registerAuthorizers($authorization);

            return $authorization;
        });
    }

    /**
     * Register the actions with the server.
     *
     * @param \FluxBB\Server\Server $server
     * @return void
     */
    protected function registerActions(Server $server)
    {
        $server->registerAction('get.category', 'FluxBB\Actions\ViewCategory');
        $server->registerAction('get.conversation', 'FluxBB\Actions\GetConversation');
        $server->registerAction('get.post', 'FluxBB\Actions\GetPost');
        $server->registerAction('create.user', 'FluxBB\Actions\CreateUser');
        $server->registerAction('login.user', 'FluxBB\Actions\Login');
        $server->registerAction('logout.user', 'FluxBB\Actions\Logout');
        $server->registerAction('edit.post', 'FluxBB\Actions\EditPost');
        $server->registerAction('reply.topic', 'FluxBB\Actions\Reply');
        $server->registerAction('subscribe.topic', 'FluxBB\Actions\SubscribeTopic');
        $server->registerAction('unsubscribe.topic', 'FluxBB\Actions\UnsubscribeTopic');
        $server->registerAction('create.topic', 'FluxBB\Actions\NewTopic');
        $server->registerAction('set.options', 'FluxBB\Actions\SetOptions');
        $server->registerAction('get.settings', 'FluxBB\Actions\GetSettings');
    }

    /**
     * Register all validators with the request validator.
     *
     * @param \FluxBB\Server\RequestValidator $validator
     * @return void
     */
    protected function registerValidators(RequestValidator $validator)
    {
        $validator->registerValidator('post_edit_handler', 'FluxBB\Validation\PostValidator');
        $validator->registerValidator('reply_handler', 'FluxBB\Validation\PostValidator');
        $validator->registerValidator('new_topic_handler', 'FluxBB\Validation\PostValidator');
        $validator->registerValidator('admin.options.set', 'FluxBB\Validation\OptionsValidator');
        $validator->registerValidator('handle_registration', 'FluxBB\Validation\UserValidator');
    }

    /**
     * Register all authorizer with the authorization server.
     *
     * @param \FluxBB\Server\AuthorizationServer $auth
     * @return void
     */
    protected function registerAuthorizers(AuthorizationServer $auth)
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['FluxBB\Server\ServerInterface'];
    }
}
