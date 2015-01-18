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
        Subbly_Installer_Logger::setLogDirectory(BASEDIR);
        Subbly_Installer_Logger::get()->debug(sprintf('Initialize the Logger'));
        Subbly_Installer_Logger::get()->debug(sprintf('run: %s', __METHOD__));

        // Error handler
        if (DEBUG !== true) {
            Subbly_Installer_ErrorHandler::quiet();
        }
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

        $form = new Subbly_Installer_FormValidator(
            Subbly_Installer_View::request_input()
        );

        // Show the form for the setting values
        if (Subbly_Installer_View::request_input('submit') === null) {
            return $this->showSettingsFormView($form);
        }

        // Check form values
        if ($form->isValid()) {
            // Install the CMS
            $installer = new Subbly_Installer_Installer();
            $installer->downloadLatest();
            $installer->uncompress();
            $installer->install($form);
        }

        return $this->showJSONView($form);
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
        return Subbly_Installer_View::render('install.html.php');
    }

    /**
     *
     */
    protected function showJSONView(Subbly_Installer_FormValidator $form)
    {
        return Subbly_Installer_View::render('ajax.json.php', array(
            'form' => $form,
        ), false);
    }
}
