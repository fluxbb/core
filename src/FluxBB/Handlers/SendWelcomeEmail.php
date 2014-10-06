<?php

namespace FluxBB\Handlers;

use FluxBB\Core\EventHandler;
use FluxBB\Events\UserHasRegistered;
use Illuminate\Mail\Message;
use Illuminate\Contracts\Mail\Mailer;
use FluxBB\Web\UrlGeneratorInterface;
use FluxBB\Models\ConfigRepositoryInterface;

class SendWelcomeEmail extends EventHandler
{
    protected $mailer;

    protected $config;

    protected $url;

    public function __construct(Mailer $mailer, ConfigRepositoryInterface $config, UrlGeneratorInterface $url)
    {
        $this->mailer = $mailer;
        $this->config = $config;
        $this->url = $url;
    }
    
    public function whenUserHasRegistered(UserHasRegistered $event)
    {
        $data = [
            'board_mailer'  => $this->config->get('o_board_title'),
            'base_url'      => $this->url->toRoute('index'),
            'user'          => $event->user,
            'login_url'     => $this->url->toRoute('login'),
        ];

        $this->sendMailTo($event->user, $data);
    }

    protected function sendMailTo($user, $data)
    {
        $subject = trans('fluxbb::register.mail_welcome_subject', [
            ':board' => $this->config->get('o_board_title'),
        ]);

        $this->mailer->send(['text' => 'fluxbb:mail::welcome'], $data, function (Message $mail) use ($user, $subject) {
            $mail->to($user->email)->subject($subject);
        });
    }
}
