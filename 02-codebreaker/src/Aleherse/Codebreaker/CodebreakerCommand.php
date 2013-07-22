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
        $exactMatchCount = $this->exactMatchCount($guess);
        $numberMatchCount = $this->numberMatchCount($guess);

        return str_repeat('+', $exactMatchCount) . str_repeat('-', $numberMatchCount);
    }

    protected function numberMatchCount($guess)
    {
        $numberMatchCount = 0;

        for ($i = 0; $i < 4; $i++) {
            if ($this->isNumberMatch($guess, $i)) {
                $numberMatchCount++;
            }
        }

        return $numberMatchCount;
    }

    protected function exactMatchCount($guess)
    {
        $exactMatchCount = 0;

        for ($i = 0; $i < 4; $i++) {
            if ($this->isExactMatch($guess, $i)) {
                $exactMatchCount++;
            }
        }

        return $exactMatchCount;
    }

    protected function isExactMatch($guess, $index)
    {
        return $this->getSecret()[$index] == $guess[$index];
    }

    protected function isNumberMatch($guess, $index)
    {
        $pos = strpos($this->getSecret(), $guess[$index]);

        return false !== $pos && $pos != $index;
    }
}