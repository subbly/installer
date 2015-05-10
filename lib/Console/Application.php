<?php

namespace Console;

use Symfony\Component\Console\Application as BaseApplication;
use Console\Command\BuildCommand;

class Application extends BaseApplication
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        error_reporting(-1);
        ini_set('memory_limit', -1);
        set_time_limit(0);

        parent::__construct('Subbly installer', \Subbly_Installer_Application::VERSION);

        $this->add(new BuildCommand());
    }
}
