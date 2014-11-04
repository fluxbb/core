<?php

namespace FluxBB\Integration\Laravel;

use FluxBB\Auth\AuthenticatorInterface;
use Illuminate\Contracts\Auth\Guard as LaravelAuth;

class Authenticator implements AuthenticatorInterface
{
    protected $auth;


    public function __construct(LaravelAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(array $credentials, $remember = false)
    {
        return $this->auth->attempt($credentials, $remember);
    }

    public function logout()
    {
        $this->auth->logout();
    }
}
