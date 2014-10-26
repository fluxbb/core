<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Events\UserHasRegistered;
use FluxBB\Models\User;
use FluxBB\Models\ConfigRepositoryInterface;

class Register extends Action
{
    protected $config;


    public function __construct(ConfigRepositoryInterface $repository)
    {
        $this->config = $repository;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $user = new User([
            'username'          => $this->get('username'),
            'group_id'          => $this->config->get('o_default_user_group'),
            'password'          => $this->get('password'),
            'email'             => $this->get('email'),
            'email_setting'     => $this->config->get('o_default_email_setting'),
            'timezone'          => $this->config->get('o_default_timezone'),
            'dst'               => $this->config->get('o_default_dst'),
            'language'          => $this->config->get('o_default_lang'),
            'style'             => $this->config->get('o_default_style'),
            //'registration_ip'   => $this->request->getClientIp(),
            //'last_visit'        => $this->request->server('REQUEST_TIME', time()),
        ]);

        $user->save();
        $this->raise(new UserHasRegistered($user));
    }
}
