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
        $server->registerAction('category', 'FluxBB\Actions\ViewCategory');
        $server->registerAction('conversation', 'FluxBB\Actions\ViewConversation');
        $server->registerAction('viewpost', 'FluxBB\Actions\ViewPost');
        $server->registerAction('handle_registration', 'FluxBB\Actions\Register');
        $server->registerAction('handle_login', 'FluxBB\Actions\Login');
        $server->registerAction('logout', 'FluxBB\Actions\Logout');
        $server->registerAction('post_edit_handler', 'FluxBB\Actions\EditPost');
        $server->registerAction('reply_handler', 'FluxBB\Actions\Reply');
        $server->registerAction('topic_subscribe', 'FluxBB\Actions\SubscribeTopic');
        $server->registerAction('topic_unsubscribe', 'FluxBB\Actions\UnsubscribeTopic');
        $server->registerAction('new_topic_handler', 'FluxBB\Actions\NewTopic');
        $server->registerAction('admin.options.set', 'FluxBB\Actions\Admin\SetOptions');
    }

    /**
     * Register all validators with the request validator.
     *
     * @param \FluxBB\Server\RequestValidator $validator
     * @return void
     */
    protected function registerValidators(RequestValidator $validator)
    {
        $validator->registerValidator('post_edit_handler', 'FluxBB\Validator\PostValidator');
        $validator->registerValidator('reply_handler', 'FluxBB\Validator\PostValidator');
        $validator->registerValidator('new_topic_handler', 'FluxBB\Validator\PostValidator');
        $validator->registerValidator('admin.options.set', 'FluxBB\Validator\OptionsValidator');
        $validator->registerValidator('handle_registration', 'FluxBB\Validator\UserValidator');
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
