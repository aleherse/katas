<?php

use Symfony\Component\Console\Command\Command as CommandBase;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends CommandBase
{
    protected function configure()
    {
        $this
            ->setName('command')
            ->setDescription('Example of command with one parameter')
            ->addArgument('name', InputArgument::OPTIONAL, 'User to greet', 'World');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $output->writeln("Hello {$name}!");
    }
}

