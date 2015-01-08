<?php

class Subbly_Installer
{
    const VERSION = '0.1.0-dev';

    const HANGAR_API_BASEURL = 'http://hangar.subbly.com/api/v1';

    /**
     *
     */
    public function run()
    {
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

        Subbly_Installer_Logger::info(sprintf('Check the requirements'));
        Subbly_Installer_Requirements::check();

        Subbly_Installer_Logger::info(sprintf('What else?'));
    }
}
