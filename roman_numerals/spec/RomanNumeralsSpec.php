<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RomanNumeralsSpec extends ObjectBehavior
{
    function it_converts_from_1_to_3()
    {
        $this->fromArabic(1)->shouldReturn('I');
        $this->fromArabic(2)->shouldReturn('II');
        $this->fromArabic(3)->shouldReturn('III');
    }

    function it_converts_multiples_of_10()
    {
        $this->fromArabic(10)->shouldReturn('X');
        $this->fromArabic(20)->shouldReturn('XX');
        $this->fromArabic(30)->shouldReturn('XXX');
    }

    function it_converts_from_5_to_8()
    {
        $this->fromArabic(5)->shouldReturn('V');
        $this->fromArabic(6)->shouldReturn('VI');
        $this->fromArabic(7)->shouldReturn('VII');
        $this->fromArabic(8)->shouldReturn('VIII');
    }

    function it_converts_4_9_40_90()
    {
        $this->fromArabic(4)->shouldReturn('IV');
        $this->fromArabic(9)->shouldReturn('IX');
        $this->fromArabic(40)->shouldReturn('XL');
        $this->fromArabic(90)->shouldReturn('XC');
    }

    function it_converts_148_to_CXLVIII()
    {
        $this->fromArabic(148)->shouldReturn('CXLVIII');
    }
}
