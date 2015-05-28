<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WrapperSpec extends ObjectBehavior
{
    function it_should_return_an_empty_string_if_number_of_columns_is_zero()
    {
        $this->wrap('test', 0)->shouldReturn('');
    }

    function it_should_return_the_same_string_if_the_length_is_equal_to_its_size()
    {
        $this->wrap('test', 4)->shouldReturn('test');
    }

    function it_should_return_the_same_string_if_the_length_is_larger_to_its_size()
    {
        $this->wrap('test', 5)->shouldReturn('test');
    }

    function it_should_split_a_word_if_the_length_is_less_than_the_entered_word()
    {
        $this->wrap('test', 2)->shouldReturn("te\nst");
        $this->wrap('test', 1)->shouldReturn("t\ne\ns\nt");
    }

    function it_should_replace_an_space_with_a_newline_if_column_is_in_a_blank_space()
    {
        $this->wrap('test it', 4)->shouldReturn("test\nit");
        $this->wrap('test it', 5)->shouldReturn("test\nit");
    }

    function it_should_split_before_the_length_if_it_is_in_word()
    {
        $this->wrap('test it', 6)->shouldReturn("test\nit");
    }
}
