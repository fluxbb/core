<?php

namespace FluxBB\Actions;

use Illuminate\Auth\AuthManager;

class Login extends Base
{
    protected $auth;


    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function login($username, $password, $remember)
    {
        $credentials = array(
            'username' => $username,
            'password' => $password,
        );

        if (! $this->auth->attempt($credentials, $remember)) {
            $this->addError('Invalid username / password combination');
        }
    }
}
