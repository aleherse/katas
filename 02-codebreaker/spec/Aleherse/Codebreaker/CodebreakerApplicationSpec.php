<?php

namespace spec\Aleherse\Codebreaker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CodebreakerApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Aleherse\Codebreaker\CodebreakerApplication');
    }

    function it_should_be_a_console_application()
    {
        $this->shouldBeAnInstanceOf('Symfony\Component\Console\Application');
    }
}
