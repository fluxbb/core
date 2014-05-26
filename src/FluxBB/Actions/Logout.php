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

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        return \Redirect::route('index')
            ->withMessage(trans('fluxbb::login.message_logout'));
    }

    /**
     * Run the logout action.
     *
     * @return void
     */
    protected function run()
    {
        $this->auth->logout();
    }
}
