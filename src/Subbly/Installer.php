<?php

class Subbly_Installer
{
    const VERSION = '0.1.0-dev';

    const HANGAR_API_CMSLATEST = 'http://hangar.subbly.dev/api/v1/cms/latest';

    /**
     * The constructor
     */
    public function __construct()
    {
        Subbly_Installer_Logger::setLogDirectory(BASEDIR.'/log');
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

        Subbly_Installer_ErrorHandler::quiet();
        Subbly_Installer_ErrorHandler::register(DEBUG === true);
    }

    /**
     *
     */
    public function run()
    {
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

        $requirements = new Subbly_Installer_Requirements();
        $requirements->check();
        // var_dump($requirements->isOK());

        Subbly_Installer_CMSArchive::downloadLatestArchive();

        Subbly_Installer_Logger::info(sprintf('What else?'));
    }
}
