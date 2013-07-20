<?php

namespace Aleherse\Codebreaker;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class CodebreakerApplication extends Application
{

    public function getCommandName(InputInterface $input)
    {
        return 'codebreaker';
    }
}