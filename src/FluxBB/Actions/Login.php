<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Server\Request;
use Illuminate\Contracts\Auth\Authenticator;

class Login extends Action
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticator
     */
    protected $auth;


    public function __construct(Authenticator $auth)
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

        if (! $this->auth->attempt($credentials, $remember)) {
            $this->addError('Invalid username / password combination');
        }

        $this->redirectTo(
            new Request('index'),
            trans('fluxbb::login.message_login')
        );
    }
}
