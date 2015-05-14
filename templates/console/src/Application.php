<?php

use Symfony\Component\Console\Application as ApplicationBase;
use Symfony\Component\Console\Input\InputInterface;

class Application extends ApplicationBase
{
    public function getCommandName(InputInterface $input)
    {
        return 'command';
    }

    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new Command();
        
        return $defaultCommands;
    }
    
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}

