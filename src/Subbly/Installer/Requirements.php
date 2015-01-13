<?php

class Subbly_Installer_Requirements
{
    /**
     *
     */
    protected $modules = array(
        'database' => array(
            'PDO',
            'pdo_mysql',
        ),

        'others' => array(
            'mcrypt',
            'curl',
            'zip',
        ),
    );

    /**
     *
     */
    protected $unloadedModules = array();

    /**
     * The constructor.
     */
    public function __construct()
    {
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));

    }

    /**
     * Check if the requirements are ok or not
     *
     * @return boolean
     */
    public function isOK()
    {
        return count($this->unloadedModules) === 0;
    }

    /**
     *
     */
    public function check()
    {
        Subbly_Installer_Logger::debug(sprintf('run: %s', __METHOD__));
        Subbly_Installer_Logger::info(sprintf('Check the requirements'));

        foreach ($this->modules as $groupName=>$modulesGroup) {
            foreach ($modulesGroup as $module) {

                if (!extension_loaded($module)) {
                    $this->unloadedModules[$groupName][] = $module;
                }

            }
        }

        if (!$this->isOK()) {
            Subbly_Installer_Logger::info(sprintf('Requirements missing'), $this->unloadedModules);
        }
    }
}
