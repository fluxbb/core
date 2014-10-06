<?php

namespace FluxBB\Core;

class EventHandler
{
    /**
     * Handle the given event, if a handler exists.
     *
     * @param object $event
     * @return mixed
     */
    public function handle($event)
    {
        $method = $this->getMethodFor($event);

        if (method_exists($this, $method))
        {
            return call_user_func([$this, $method], $event);
        }
    }

    /**
     * Determine the event handler method name for a given event object.
     *
     * @param object $event
     * @return string
     */
    protected function getMethodFor($event)
    {
        $qualified = get_class($event);

        return 'when'.last(explode('\\', $qualified));
    }
}
