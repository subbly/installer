<?php

class Subbly_Installer_Application
{
    const VERSION = '0.1.0-dev';

    /**
     * The constructor
     */
    public function __construct()
    {
        // Logger
        Subbly_Installer_Logger::setLogDirectory(BASEDIR.'/storage/log');
        Subbly_Installer_Logger::get()->debug(sprintf('Initialize the Logger'));
        Subbly_Installer_Logger::get()->debug(sprintf('run: %s', __METHOD__));

        // Error handler
        Subbly_Installer_ErrorHandler::register(true);
    }

    /**
     *
     */
    public function run()
    {
        Subbly_Installer_Logger::get()->debug(sprintf('run: %s', __METHOD__));

        // Requirements
        $requirements = new Subbly_Installer_Requirements();
        $requirements->check();

        if (!$requirements->isOK()) {
            // TODO show page with the missing requirements
            return $this->showRequirementsView($requirements);
        }

        // Show the form for the setting values
        return $this->showSettingsFormView();

        // Install the CMS
        $installer = new Subbly_Installer_Installer();
        $installer->downloadLatest();
        $installer->uncompress();
        $installer->install();
    }

    /**
     *
     */
    protected function showRequirementsView(Subbly_Installer_Requirements $requirements)
    {
        return Subbly_Installer_View::render('requirements.html.php', array(
            'requirements' => $requirements,
        ));
    }

    /**
     *
     */
    protected function showSettingsFormView()
    {
        return Subbly_Installer_View::render('install.html.php', array('a' => 'b'));
    }

    /**
     *
     */
    protected function showSuccessView()
    {
    }
}
