<?php

namespace spec\FluxBB\Core;

use Illuminate\Contracts\Events\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use FluxBB\Core\Action;

class ActionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\ConcreteAction');
    }

    function it_can_raise_events(Dispatcher $dispatcher)
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\EventAction');

        $dispatcher->fire('stdClass', [new \stdClass()])->shouldBeCalled();

        $this->setEvents($dispatcher);
        $this->execute();
    }
}

class ConcreteAction extends Action
{
    protected function run()
    {
        //
    }
}

class EventAction extends Action
{
    protected function run()
    {
        $this->raise(new \stdClass());
    }
}
