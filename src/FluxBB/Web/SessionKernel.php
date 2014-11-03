<?php

namespace FluxBB\Web;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class SessionKernel implements HttpKernelInterface
{
    /**
     * The wrapped HTTP kernel instance.
     *
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected $wrapped;

    /**
     * The session instance.
     *
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;


    /**
     * Create the session wrapper instance.
     *
     * @param \Symfony\Component\HttpKernel\HttpKernelInterface $wrapped
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     */
    public function __construct(HttpKernelInterface $wrapped, SessionInterface $session)
    {
        $this->wrapped = $wrapped;
        $this->session = $session;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $this->startSession($request);
        $request->setSession($this->session);

        $response = $this->wrapped->handle($request, $type, $catch);

        $this->session->save();
        $this->writeSessionTo($response);

        return $response;
    }

    /**
     * Prepare and start the session instance with data from the given request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return void
     */
    protected function startSession(Request $request)
    {
        $this->session->setId($request->cookies->get('fluxbb_session'));
        $this->session->start();
    }

    /**
     * Write the session cookie to the response.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @return void
     */
    protected function writeSessionTo(Response $response)
    {
        // TODO: Take these values from config
        $lifetime = Carbon::now()->addMinutes(120);
        $path = '/';
        $domain = null;
        $secure = false;

        $response->headers->setCookie(new Cookie(
            $this->session->getName(),
            $this->session->getId(),
            $lifetime,
            $path,
            $domain,
            $secure
        ));
    }
}
