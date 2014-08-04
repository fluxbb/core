<?php

namespace FluxBB\Actions;

use FluxBB\Server\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use FluxBB\Models\Config;
use FluxBB\Models\User;

class Register extends Base
{
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

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $rules = $this->getValidationRules();
        $validation = $this->validator->make($this->input, $rules);

        $this->onErrorRedirectTo(new Request('register'));

        if ($validation->fails()) {
            $this->mergeErrors($validation->errors());
            return;
        }

        $userData = array(
            'username'          => $this->request->get('user'),
            'group_id'          => Config::get('o_default_user_group'),
            'password'          => $this->request->get('password'),
            'email'             => $this->request->get('email'),
            'email_setting'     => Config::get('o_default_email_setting'),
            'timezone'          => Config::get('o_default_timezone'),
            'dst'               => Config::get('o_default_dst'),
            'language'          => Config::get('o_default_lang'),
            'style'             => Config::get('o_default_style'),
            'registration_ip'   => $this->request->getClientIp(),
            'last_visit'        => $this->request->server('REQUEST_TIME', time()),
        );
        $user = User::create($userData);

        $this->trigger('user.registered', array($user));

        $this->redirectTo(
            new Request('index'),
            trans('fluxbb::register.reg_complete')
        );
    }
}
