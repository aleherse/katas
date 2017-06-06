<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RomanNumeralsSpec extends ObjectBehavior
{
    function it_converts_from_arabic_1_to_roman_numeral_I()
    {
        $this->fromArabic(1)->shouldReturn('I');
    }

    function it_converts_from_arabic_2_to_roman_numeral_II()
    {
        $this->fromArabic(2)->shouldReturn('II');
    }

    function it_converts_from_arabic_4_to_roman_numeral_IV()
    {
        $this->fromArabic(4)->shouldReturn('IV');
    }

    function it_converts_from_arabic_5_to_roman_numeral_V()
    {
        $this->fromArabic(5)->shouldReturn('V');
    }

    function it_converts_from_arabic_10_to_roman_numeral_X()
    {
        $this->fromArabic(10)->shouldReturn('X');
    }

    function it_converts_from_arabic_27_to_roman_numeral_XXVII()
    {
        $this->fromArabic(27)->shouldReturn('XXVII');
    }

    function it_converts_from_arabic_20_to_roman_numeral_XX()
    {
        $this->fromArabic(20)->shouldReturn('XX');
    }
}
