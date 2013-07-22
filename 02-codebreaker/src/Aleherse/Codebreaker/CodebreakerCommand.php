<?php

namespace Aleherse\Codebreaker;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CodebreakerCommand extends Command
{
    protected $secret = '0000';

    protected function configure()
    {
        $this->setName('codebreaker');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Welcome to Codebreaker!');
        $output->write('Enter guess:');
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function guess($guess)
    {
        $mark = '';

        if (strpos($this->getSecret(), $guess[0])) {
            $mark .= '-';
        } else {
            $mark .= '';
        }

        return $mark;
    }
}