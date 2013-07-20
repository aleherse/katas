<?php

namespace spec\Aleherse\Codebreaker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;

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

    function it_should_return_codebreaker_as_command_name(InputInterface $input)
    {
        $this->getCommandName($input)->shouldReturn('codebreaker');
    }

    function it_should_have_codebreaker_command_as_one_of_the_available_commands()
    {
        $this->get('codebreaker')->shouldReturnAnInstanceOf('Aleherse\Codebreaker\CodebreakerCommand');
    }
}
