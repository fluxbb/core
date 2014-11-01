<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Support\MessageBag;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirect;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RedirectResponse extends SymfonyRedirect
{
    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;


    public function withMessage($message)
    {
        $this->session->set('fluxbb.message', $message);

        return $this;
    }

    public function withInput(array $input)
    {
        // Flash input to session
    }

    public function withErrors(MessageBag $errors)
    {
        // Flash errors to session
    }

    public function setSession(SessionInterface $session)
    {
        $this->session = $session;
    }
}
