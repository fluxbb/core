<?php

namespace FluxBB\Actions;

use Illuminate\Validation\Factory as ValidationFactory;
use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\Config;
use FluxBB\Models\User;

class Register extends Base
{
    protected $request;

    protected $input;

    protected $validator;


    public function __construct(ValidationFactory $validator)
    {
        $this->validator = $validator;
    }

    protected function getValidationRules()
    {
        $rules = array(
            'user'      => 'required|between:2,25|username_not_guest|no_ip|username_not_reserved|no_bbcode|unique:users,username|username_not_banned',
        );

        // If email confirmation is enabled
        if (Config::enabled('o_regs_verify')) {
            $rules['email'] = 'required|email|confirmed|unique:users,email|email_not_banned';
        } else {
            $rules['password'] = 'required|min:4|confirmed';
            $rules['email'] = 'required|email|unique:users,email';
        }

        // Agree to forum rules
        if (Config::enabled('o_rules')) {
            $rules['rules'] = 'accepted';
        }

        return $rules;
    }

    protected function handleRequest(Request $request)
    {
        $this->input = $request->input();
        $this->request = $request;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $rules = $this->getValidationRules();
        $validation = $this->validator->make($this->input, $rules);

        if ($validation->fails()) {
            return $this->mergeErrors($validation->errors());
        }

        $userData = array(
            'username'          => $this->input['user'],
            'group_id'          => Config::get('o_default_user_group'),
            'password'          => $this->input['password'],
            'email'             => $this->input['email'],
            'email_setting'     => Config::get('o_default_email_setting'),
            'timezone'          => Config::get('o_default_timezone'),
            'dst'               => Config::get('o_default_dst'),
            'language'          => Config::get('o_default_lang'),
            'style'             => Config::get('o_default_style'),
            'registration_ip'   => $this->request->getClientIp(),
            'last_visit'        => $this->request->server('REQUEST_TIME', time()),
        );
        $user = User::create($userData);

        // Notify the user about his new account!
        $user->sendWelcomeMail();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        if ($this->succeeded()) {
            return \Redirect::route('index')
                ->withMessage(trans('fluxbb::register.reg_complete'));
        } else {
            // TODO: Handle error!
            return \Response::make();
        }
    }
}
