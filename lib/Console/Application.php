<?php

namespace Console;

use Symfony\Component\Console\Application as BaseApplication;
use Console\Command\CompileCommand;

class Application extends BaseApplication
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        error_reporting(-1);

        parent::__construct('Subbly installer', \Subbly_Installer_Application::VERSION);

        $this->add(new CompileCommand());
    }
}
