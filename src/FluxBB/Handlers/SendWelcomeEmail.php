<?php

namespace FluxBB\Handlers;

use Illuminate\Mail\Mailer;
use FluxBB\Models\ConfigRepositoryInterface;

class SendWelcomeEmail
{
    protected $mailer;

    protected $config;

    public function __construct(Mailer $mailer, ConfigRepositoryInterface $config)
    {
        $this->mailer = $mailer;
        $this->config = $config;
    }
    
    public function handle($user)
    {
        $data = array(
            'board_mailer'  => $this->config->get('o_board_title'),
            'base_url'      => route('index'),
            'user'          => $user,
            'login_url'     => route('login'),
        );

        $this->sendMailTo($user, $data);
    }

    protected function sendMailTo($user, $data)
    {
        $subject = trans('fluxbb::register.mail_welcome_subject', [
            ':board' => $this->config->get('o_board_title'),
        ]);

        $this->mailer->plain('fluxbb:mail::welcome', $data, function ($mail) use ($user, $subject) {
            $mail->to($user->email)->subject($subject);
        });
    }
}
