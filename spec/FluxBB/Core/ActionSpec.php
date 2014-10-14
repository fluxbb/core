<?php

namespace spec\FluxBB\Core;

use Illuminate\Contracts\Events\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use FluxBB\Core\Action;

class ActionSpec extends ObjectBehavior
{
    function it_can_raise_events(Dispatcher $dispatcher)
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\EventAction');

        $dispatcher->fire('stdClass', [new \stdClass()])->shouldBeCalled();

        $this->setEvents($dispatcher);
        $this->execute();
    }

    function it_always_returns_responses()
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\EmptyAction');

        $this->execute()->shouldReturnAnInstanceOf('FluxBB\Server\Response');
    }
}

class EmptyAction extends Action
{
    protected function run()
    { }
}

class EventAction extends Action
{
    protected function run()
    {
        $this->raise(new \stdClass());
    }
}
