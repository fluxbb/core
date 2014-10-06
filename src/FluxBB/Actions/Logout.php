<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Server\Request;
use FluxBB\Auth\AuthenticatorInterface;

class Logout extends Action
{
    protected $auth;


    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Run the logout action.
     *
     * @return void
     */
    protected function run()
    {
        $this->auth->logout();

        $this->redirectTo(
            new Request('index'),
            trans('fluxbb::login.message_logout')
        );
    }
}
