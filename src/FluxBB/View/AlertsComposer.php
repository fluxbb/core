<?php

namespace FluxBB\View;

use Illuminate\Session\Store;

class AlertsComposer
{
    protected $session;


    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function compose($view)
    {
        if ($this->session->has('message')) {
            $view->with('message', $this->session->get('message'));
        }
    }
}
