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

    public function getLogout()
    {
        $this->action('logout')->logout();

        return Redirect::route('index')
            ->withMessage(trans('fluxbb::login.message_logout'));
    }

    public function getLogin()
    {
        return View::make('fluxbb::auth.login');
    }

    public function postLogin()
    {
        $username = Input::get('req_username');
        $password = Input::get('req_password');
        $remember = Input::has('save_pass');

        $login = $this->action('login');
        $login->login($username, $password, $remember);

        if ($login->succeeded()) {
            return Redirect::intended(route('index'))
                ->withMessage('You were successfully logged in.');
        } else {
            return $this->handleErrors('getLogin', $login);
        }
    }

    public function getRegister()
    {
        return View::make('fluxbb::auth.register');
    }

    public function postRegister()
    {
        $registration = $this->action('register');
        $registration->register(Input::all());

        if ($registration->succeeded()) {
            return Redirect::route('index')
                ->withMessage(trans('fluxbb::register.reg_complete'));
        } else {
            return $this->handleErrors('getRegister', $registration);
        }
    }
}
