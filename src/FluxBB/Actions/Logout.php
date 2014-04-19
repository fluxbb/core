<?php

namespace FluxBB\Actions;

use Illuminate\Auth\AuthManager;

class Logout extends Base
{
    protected $auth;


    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function logout()
    {
        $this->auth->logout();
    }
}
