<?php

namespace FluxBB\Actions;

use Illuminate\Auth\AuthManager;
use Symfony\Component\HttpFoundation\Request;

class Login extends Base
{
    /**
     * @var \Illuminate\Auth\AuthManager
     */
    protected $auth;

    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var bool
     */
    protected $remember;


    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    protected function handleRequest(Request $request)
    {
        $this->credentials = array(
            'username' => $request->input('req_username'),
            'password' => $request->input('req_password'),
        );

        $this->remember = $request->input('remember');
    }

    public function run()
    {
        if (! $this->auth->attempt($this->credentials, $this->remember)) {
            $this->addError('Invalid username / password combination');
        }
    }

    protected function makeResponse()
    {
        if ($this->succeeded()) {
            return \Redirect::route('index')
                ->withMessage(trans('fluxbb::login.message_login'));
        } else {
            // TODO: Error handling here!
            return \Response::make();
        }
    }
}
