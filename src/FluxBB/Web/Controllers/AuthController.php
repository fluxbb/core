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
            $this->execute('handle_registration', [
                'ip' => $this->request->getClientIp(),
            ]);

            return $this->redirect('index')
                        ->withMessage(trans('fluxbb::register.reg_complete'));
        } catch (ValidationFailed $e) {
            return $this->redirect('register');
        }
    }

    public function loginForm()
    {
        return $this->view('login');
    }

    public function login()
    {
        try {
            $this->execute('handle_login');

            return $this->redirect('index')
                        ->withMessage(trans('fluxbb::login.message_login'));
        } catch (Exception $e) {
            return $this->redirect('login');
            // TODO: With errors!
        }
    }

    public function logout()
    {
        $this->execute('logout');

        return $this->redirect('index');
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
