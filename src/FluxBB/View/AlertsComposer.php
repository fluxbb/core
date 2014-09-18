<?php

namespace FluxBB\View;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AlertsComposer
{
    protected $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function compose(View $view)
    {
        if ($this->session->has('message')) {
            $view->with('message', $this->session->get('message'));
        }
    }
}
