<?php

namespace Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('installer:test')
            ->setDescription('Test the Subbly Installer')
        ;
    }

    /**
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Compile

        // Mv install

        // Execute install

        // Check the install

        // Print install file info (like size)
    }

    /**
     *
     */
    protected function compile()
    {
        $command = $this->getApplication()->find('installer:compile');
        $input   = new ArrayInput(array());

        if ($command->run($this->input, $this->output) === 0) {
            // It works!
        }
    }
}
