<?php

namespace Console\Command;

use Console\ErrorHandler;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class Command extends BaseCommand
{
    protected $container;
    protected $input;
    protected $output;
    protected $dialog;

    protected $fs;

    /**
     * Initialize.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        if (OutputInterface::VERBOSITY_DEBUG <= $output->getVerbosity()) {
            ErrorHandler::register(true);
        }

        $this->input  = $input;
        $this->output = $output;
        $this->dialog = $this->getHelperSet()->get('dialog');

        $this->fs = new Filesystem();
    }

    /**
     * Get root directory.
     */
    protected function getRootDir()
    {
        return realpath(__DIR__.'/../../../');
    }
}
