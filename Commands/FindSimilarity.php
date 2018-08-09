<?php

namespace PotSimilarity\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FindSimilarity extends Command
{
    protected function configure()
    {
        $this
            ->setName('find:similar')
            ->setDescription('Find Similar strings on pot file ')
            // the "--help" option
            ->setHelp('Find Similar strings on pot file')
            ->addArgument(
                'pot_path',
                InputArgument::REQUIRED,
                'Path of the pot file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pot_path = $input->getArgument('pot_path');

        try {
            if (! is_readable($pot_path)) {
                throw new \Exception('Pot file is unreadable.');
            }

        } catch (\Exception $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
        }
    }
}
