<?php

namespace spec;

use StringCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_returns_0_when_the_operation_is_empty()
    {
        $this->calculate('')->shouldReturn(0.0);
    }

    function it_returns_the_number_if_the_operation_contains_just_a_number()
    {
        $this->calculate('4')->shouldReturn(4.0);
    }

    function it_supports_addition()
    {
        $this->calculate('3 + 2')->shouldReturn(5.0);
    }

    function it_supports_subtraction()
    {
        $this->calculate('4 - 1')->shouldReturn(3.0);
    }

    function it_supports_more_than_one_operation()
    {
        $this->calculate('3 + 2 - 1 + 8')->shouldReturn(12.0);
    }

    function it_supports_multiplication()
    {
        $this->calculate('3 * 2')->shouldReturn(6.0);
    }

    function it_supports_operator_precedence()
    {
        $this->calculate('3 * 4 + 2')->shouldReturn(14.0);
        $this->calculate('2 + 3 * 4')->shouldReturn(14.0);
    }

    function it_supports_division()
    {
        $this->calculate('6 / 2')->shouldReturn(3.0);
    }

    function it_supports_exponential()
    {
        $this->calculate('6 ^ 3')->shouldReturn(216.0);
    }

    function it_works_with_a_complex_operation()
    {
        $this->calculate('1 + 3 + 4 * 2 / 5 ^ 2 * 4 * 7 + 6')->shouldReturn(1.0 + 3.0 + 4.0 * 2.0 / 25.0 * 4.0 * 7.0 + 6.0);
    }
}
