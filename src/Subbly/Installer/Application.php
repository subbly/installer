<?php

class Subbly_Installer_Application
{
    const VERSION = '0.1.0-alpha.4.devel';

    /**
     * The constructor.
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

        try {
            // Requirements
            $requirements = new Subbly_Installer_Requirements();
            $requirements->check();

            if (!$requirements->isOK()) {
                return $this->showRequirementsView($requirements);
            }

            $form = new Subbly_Installer_FormValidator(
                Subbly_Installer_View::getRequestInputs()
            );

            // Show the form for the setting values
            if (Subbly_Installer_View::getRequestInput('submit') === null) {
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
        } catch (Subbly_Installer_HTTPException $e) {
            return $this->showJSONView(null, $e->getMessage());
        }
    }

    /**
     *
     */
    protected function showRequirementsView(Subbly_Installer_Requirements $requirements)
    {
        header('Content-Type: text/html; charset=utf-8');

        return Subbly_Installer_View::render('requirements.html.php', array(
            'requirements' => $requirements,
        ));
    }

    /**
     *
     */
    protected function showSettingsFormView()
    {
        header('Content-Type: text/html; charset=utf-8');

        return Subbly_Installer_View::render('install.html.php');
    }

    /**
     *
     */
    protected function showJSONView(Subbly_Installer_FormValidator $form = null, $errorMessage = null)
    {
        return Subbly_Installer_View::render('ajax.json.php', array(
            'form'         => $form,
            'errorMessage' => $errorMessage,
        ), false);
    }
}
