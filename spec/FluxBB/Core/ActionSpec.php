<?php

namespace spec\FluxBB\Core;

use FluxBB\Server\Response;
use Illuminate\Contracts\Events\Dispatcher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use FluxBB\Core\Action;

class ActionSpec extends ObjectBehavior
{
    function it_always_returns_responses()
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\EmptyAction');

        $this->execute()->shouldReturnAnInstanceOf('FluxBB\Server\Response');
    }

    function it_can_access_input()
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\InputAction');

        $this->execute(['foo' => 'bar', 'baz' => 'bam'])->getData()->shouldReturn(['result' => 'barbam']);
    }

    function it_can_raise_events(Dispatcher $dispatcher)
    {
        $this->beAnInstanceOf('spec\FluxBB\Core\EventAction');

        $dispatcher->fire('stdClass', [new \stdClass()])->shouldBeCalled();

        $this->setEvents($dispatcher);
        $this->execute();
    }
}

class EmptyAction extends Action
{
    protected function run()
    { }
}

class InputAction extends Action
{
    protected function run()
    {
        $foo = $this->get('foo');
        $baz = $this->get('baz');
        $result = $foo.$baz;
        return compact('result');
    }
}

class EventAction extends Action
{
    protected function run()
    {
        $this->raise(new \stdClass());
    }
}
