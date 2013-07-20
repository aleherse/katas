<?php

namespace Aleherse\Codebreaker;

use Symfony\Component\Console\Command\Command;

class CodebreakerCommand extends Command
{
    protected function configure()
    {
        $this->setName('codebreaker');
    }
}
