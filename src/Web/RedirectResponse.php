<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirect;

class RedirectResponse extends SymfonyRedirect
{
    /**
     * The session handler instance.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * An array of previous input data that may be flashed to the session.
     *
     * @var array
     */
    protected $input;


    public function withMessage($message)
    {
        $this->session->flash('fluxbb.message', $message);

        return $this;
    }

    public function withInput()
    {
        $this->session->flashInput($this->input);

        return $this;
    }

    public function withErrors(MessageProvider $errors)
    {
        $this->session->flash('fluxbb.errors', $errors->getMessageBag());

        return $this;
    }

    public function setSession(Store $session)
    {
        $this->session = $session;
    }

    public function setInput(array $input)
    {
        $this->input = $input;
    }
}
