<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Cookie\QueueingFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class CookieKernel implements HttpKernelInterface
{
    /**
     * The wrapped HTTP kernel instance.
     *
     * @var \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected $wrapped;

    /**
     * The cookie jar instance.
     *
     * @var \Illuminate\Contracts\Cookie\QueueingFactory
     */
    protected $queue;


    /**
     * Create the cookie kernel instance.
     *
     * @param \Symfony\Component\HttpKernel\HttpKernelInterface $wrapped
     * @param \Illuminate\Contracts\Cookie\QueueingFactory $queue
     */
    public function __construct(HttpKernelInterface $wrapped, QueueingFactory $queue)
    {
        $this->wrapped = $wrapped;
        $this->queue = $queue;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $response = $this->wrapped->handle($request, $type, $catch);

        $this->writeQueuedCookies($response);

        return $response;
    }

    /**
     * Append all queued cookies to the response.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @return void
     */
    protected function writeQueuedCookies(Response $response)
    {
        foreach ($this->queue->getQueuedCookies() as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }
}
