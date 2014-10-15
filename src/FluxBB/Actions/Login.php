<?php

namespace FluxBB\Actions;

use FluxBB\Auth\AuthenticatorInterface;
use FluxBB\Core\Action;
use FluxBB\Server\Exception\Exception;

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
            'username' => $this->get('username'),
            'password' => $this->get('password'),
        ];
        $remember = $this->get('remember');

        if (! $this->auth->login($credentials, $remember)) {
            throw new Exception('Login failure.');
        }
    }
}
