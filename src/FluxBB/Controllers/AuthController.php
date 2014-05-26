<?php

namespace FluxBB\Controllers;

use Input;
use Redirect;
use View;

class AuthController extends BaseController
{
    public function __construct()
    {
        //$this->filter('before', 'only_guests')->only(array('login', 'remember'));
        //$this->filter('before', 'only_members')->only('logout');
    }

    public function getLogin()
    {
        return View::make('fluxbb::auth.login');
    }

    public function getRegister()
    {
        return View::make('fluxbb::auth.register');
    }
}
