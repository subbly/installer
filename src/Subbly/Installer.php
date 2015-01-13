<?php

class Subbly_Installer
{
    const VERSION = '0.1.0-dev';

    // const HANGAR_API_CMSLATEST = 'http://hangar.subbly.com/api/v1/cms/latest';
    const HANGAR_API_CMSLATEST = 'http://hangar.subbly.dev/api/v1/cms/latest';

    /**
     * The constructor
     */
    public function __construct()
    {
        // Logger
        Subbly_Installer_Logger::setLogDirectory(BASEDIR.'/log');
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

        // Error handler
        Subbly_Installer_ErrorHandler::register(true);
    }

    /**
     *
     */
    public function run()
    {
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

        // Requirements
        $requirements = new Subbly_Installer_Requirements();
        $requirements->check();

        if (!$requirements->isOK()) {
            // TODO show page with the missing requirements
            return $this->showRequirementsView($requirements);
        }

        // Download the archive
        $archiver = new Subbly_Installer_CMSArchiver();
        $archiver->downloadLatest();
        $archiver->uncompress();

        Subbly_Installer_Logger::info(sprintf('What else?'));
    }

    /**
     *
     */
    protected function showRequirementsView(Subbly_Installer_Requirements $requirements)
    {
    }

    /**
     *
     */
    protected function showSettingsFormView()
    {
    }

    /**
     *
     */
    protected function showSuccessView()
    {
    }
}
