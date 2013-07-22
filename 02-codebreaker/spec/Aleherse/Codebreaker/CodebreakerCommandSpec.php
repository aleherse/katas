<?php

namespace spec\Aleherse\Codebreaker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CodebreakerCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Aleherse\Codebreaker\CodebreakerCommand');
    }

    function it_should_be_a_console_command()
    {
        $this->shouldBeAnInstanceOf('Symfony\Component\Console\Command\Command');
    }

    function it_should_have_codebreaker_as_it_name()
    {
        $this->getName()->shouldReturn('codebreaker');
    }

    function it_should_not_throw_a_logic_exception_when_the_command_is_executed(InputInterface $input, OutputInterface $output)
    {
        $this->shouldNotThrow(new \LogicException('You must override the execute() method in the concrete command class.'))->duringRun($input, $output);
    }

    function it_should_set_a_secret()
    {
        $this->setSecret('1234');
        $this->getSecret()->shouldReturn('1234');
    }

    function it_should_receive_a_guess()
    {
        $this->guess('5555');
    }

    function it_returns_an_empty_mark_with_a_guess_with_no_matches()
    {
        $this->setSecret('1234');
        $this->guess('5555')->shouldReturn('');
    }

    function it_returns_a_minus_mark_with_a_guess_with_one_number_match()
    {
        $this->setSecret('1234');
        $this->guess('25555')->shouldReturn('-');
    }

    function it_returns_a_plus_mark_with_a_guess_with_one_exact_match()
    {
        $this->setSecret('1234');
        $this->guess('15555')->shouldReturn('+');
    }

    function it_returns_2_minus_marks_with_a_guess_with_2_number_match()
    {
        $this->setSecret('1234');
        $this->guess('2355')->shouldReturn('--');
    }

    function it_returns_a_plus_and_a_minus_mark_with_a_number_match_and_an_exact_match()
    {
        $this->setSecret('1234');
        $this->guess('2535')->shouldReturn('+-');
    }
}
