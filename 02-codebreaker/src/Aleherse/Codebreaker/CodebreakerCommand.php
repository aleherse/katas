<?php

namespace Aleherse\Codebreaker;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CodebreakerCommand extends Command
{
    protected function configure()
    {
        $this->setName('codebreaker');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Welcome to Codebreaker!');
        $output->write('Enter guess:');
    }
}
