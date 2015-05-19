<?php

use Symfony\Component\Console\Command\Command as CommandBase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends CommandBase
{
    protected function configure()
    {
        $this->setName('command');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello world!');
    }
}

