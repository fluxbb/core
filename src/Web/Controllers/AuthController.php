<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\Exception;
use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class AuthController extends Controller
{
    public function registerForm()
    {
        return $this->view('register');
    }

    public function register()
    {
        try {
            $this->execute('create.user', [
                'ip' => $this->request->getClientIp(),
            ]);

            return $this->redirectTo('index')
                        ->withMessage(trans('fluxbb::register.reg_complete'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('register')
                        ->withInput()
                        ->withErrors($e);
        }
    }

    public function loginForm()
    {
        return $this->view('login');
    }

    public function login()
    {
        try {
            $this->execute('login.user');

            return $this->redirectTo('index')
                        ->withMessage(trans('fluxbb::login.message_login'));
        } catch (Exception $e) {
            return $this->redirectTo('login')
                        ->withInput();
            // TODO: With errors!
        }
    }

    public function logout()
    {
        $this->execute('logout.user');

        return $this->redirectTo('index')
                    ->withMessage('Successfully logged out.');
    }

    public function resetForm()
    {
        //
    }

    public function reset()
    {
        //
    }
}
