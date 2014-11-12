<?php

namespace FluxBB\View;

use Illuminate\Contracts\View\View as ViewContract;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AlertsComposer
{
    protected $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function compose(ViewContract $view)
    {
        if ($this->session->has('fluxbb.message')) {
            $view->with('message', $this->session->get('fluxbb.message'));
        }
    }
}
