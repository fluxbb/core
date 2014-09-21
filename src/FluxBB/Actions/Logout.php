<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Server\Request;
use Illuminate\Contracts\Auth\Authenticator;

class Logout extends Action
{
    protected $auth;


    public function __construct(Authenticator $auth)
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
