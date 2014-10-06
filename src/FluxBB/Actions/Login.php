<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Server\Request;
use FluxBB\Auth\AuthenticatorInterface;

class Login extends Action
{
    /**
     * @var \FluxBB\Auth\AuthenticatorInterface
     */
    protected $auth;


    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    public function run()
    {
        $credentials = [
            'username' => $this->request->get('req_username'),
            'password' => $this->request->get('req_password'),
        ];
        $remember = $this->request->get('remember');

        $this->onErrorRedirectTo(new Request('login'));

        if (! $this->auth->login($credentials, $remember)) {
            $this->addError('Invalid username / password combination');
        }

        $this->redirectTo(
            new Request('index'),
            trans('fluxbb::login.message_login')
        );
    }
}
