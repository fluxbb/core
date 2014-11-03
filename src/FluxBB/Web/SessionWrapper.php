<?php

namespace FluxBB\Web;

use Carbon\Carbon;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class SessionWrapper implements HttpKernelInterface
{
    /**
     * The wrapped HTTP kernel instance.
     *
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected $wrapped;

    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;


    /**
     * Create the session wrapper instance.
     *
     * @param \Symfony\Component\HttpKernel\HttpKernelInterface $wrapped
     * @param \Illuminate\Database\ConnectionInterface $connection
     */
    public function __construct(HttpKernelInterface $wrapped, ConnectionInterface $connection)
    {
        $this->wrapped = $wrapped;
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $session = $this->startSession($request);
        $request->setSession($session);

        $response = $this->wrapped->handle($request, $type, $catch);

        $session->save();
        $this->writeSession($session, $response);

        return $response;
    }

    /**
     * Prepare and start the session instance with data from the given request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected function startSession(Request $request)
    {
        $table = 'sessions';

        $handler = new DatabaseSessionHandler($this->connection, $table);
        $session = new Store('fluxbb_session', $handler);

        $session->setId($request->cookies->get('fluxbb_session'));
        $session->start();

        return $session;
    }

    /**
     * Write the session cookie to the response.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @return void
     */
    protected function writeSession(SessionInterface $session, Response $response)
    {
        // TODO: Take these values from config
        $lifetime = Carbon::now()->addMinutes(120);
        $path = '/';
        $domain = null;
        $secure = false;

        $response->headers->setCookie(new Cookie(
            $session->getName(),
            $session->getId(),
            $lifetime,
            $path,
            $domain,
            $secure
        ));
    }
}
