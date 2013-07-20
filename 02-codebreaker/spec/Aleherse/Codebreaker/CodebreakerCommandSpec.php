<?php

namespace spec\Aleherse\Codebreaker;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CodebreakerCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Aleherse\Codebreaker\CodebreakerCommand');
    }
}
