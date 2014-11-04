<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Support\MessageProvider;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirect;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RedirectResponse extends SymfonyRedirect
{
    /**
     * The session handler instance.
     *
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
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
        $this->session->set('fluxbb.message', $message);

        return $this;
    }

    public function withInput()
    {
        $this->session->set('fluxbb.input', $this->input);

        return $this;
    }

    public function withErrors(MessageProvider $errors)
    {
        $this->session->set('fluxbb.errors', $errors->getMessageBag());

        return $this;
    }

    public function setSession(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function setInput(array $input)
    {
        $this->input = $input;
    }
}
