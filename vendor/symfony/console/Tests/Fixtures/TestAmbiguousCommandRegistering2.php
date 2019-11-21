<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestAmbiguousCommandRegistering2 extends Command
{
    protected function configure()
    {
        $this
            ->setName('Test-ambiguous2')
            ->setDescription('The Test-ambiguous2 command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Test-ambiguous2');
    }
}
