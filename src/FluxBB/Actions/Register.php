<?php

namespace FluxBB\Actions;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use FluxBB\Models\Config;
use FluxBB\Models\Group;
use FluxBB\Models\User;

class Register extends Base
{
    protected $request;

    protected $validator;


    public function __construct(Request $request, ValidationFactory $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }

    public function register($input)
    {
        $rules = $this->getValidationRules();
        $validation = $this->validator->make($input, $rules);

        if ($validation->fails()) {
            return $this->mergeErrors($validation);
        }

        $userData = array(
            'username'          => $input['user'],
            'group_id'          => Config::get('o_default_user_group'),
            'password'          => $input['password'],
            'email'             => $input['email'],
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

    protected function getValidationRules()
    {
        $rules = array(
            'user'      => 'required|between:2,25|username_not_guest|no_ip|username_not_reserved|no_bbcode|not_censored|unique:users,username|username_not_banned',
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
    }
}
