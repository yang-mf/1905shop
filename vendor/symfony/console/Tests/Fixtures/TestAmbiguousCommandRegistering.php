<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestAmbiguousCommandRegistering extends Command
{
    protected function configure()
    {
        $this
            ->setName('Test-ambiguous')
            ->setDescription('The Test-ambiguous command')
            ->setAliases(['test'])
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Test-ambiguous');
    }
}
