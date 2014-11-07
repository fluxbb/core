<?php

namespace FluxBB\Mail;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Transport\LogTransport;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mailer', function () {
            $view = $this->app->make('Illuminate\Contracts\View\Factory');
            $logger = $this->app->make('Psr\Log\LoggerInterface');
            $swift = new \Swift_Mailer(new LogTransport($logger));
            $events = $this->app->make('Illuminate\Contracts\Events\Dispatcher');

            $mailer = new Mailer($view, $swift, $events);
            $mailer->setLogger($logger);

            return $mailer;
        });

        $this->app->alias('mailer', 'Illuminate\Contracts\Mail\Mailer');
    }
}
