<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\Exception;
use FluxBB\Web\Controller;

class AuthController extends Controller
{
    public function showLogin()
    {
        return $this->view('login');
    }

    public function login()
    {
        try {
            $this->execute('handle_login', [
                'username' => '',
                'password' => '',
                'remember' => '',
            ]);

            /*$this->redirectTo(
                new Request('index'),
                trans('fluxbb::login.message_login')
            );*/
        } catch (Exception $e) {
            //$this->onErrorRedirectTo(new Request('login'));
        }
    }

    public function logout()
    {
        //
    }
}
