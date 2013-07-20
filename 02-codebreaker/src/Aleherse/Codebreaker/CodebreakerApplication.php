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

    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new CodebreakerCommand();

        return $defaultCommands;
    }

    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();

        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}