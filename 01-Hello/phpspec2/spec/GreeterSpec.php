<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GreeterSpec extends ObjectBehavior
{
    function it_should_be_a_greeter()
    {
        $this->shouldBeAnInstanceOf('Greeter');
    }

    function it_should_say_hello()
    {
        $this->greet()->shouldReturn('Hello world!');
    }
}
