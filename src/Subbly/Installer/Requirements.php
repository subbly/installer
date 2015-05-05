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
        Subbly_Installer_Logger::get()->debug(sprintf('run: %s', __METHOD__));
    }

    /**
     * Check if the requirements are ok or not.
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
        Subbly_Installer_Logger::get()->debug(sprintf('run: %s', __METHOD__));
        Subbly_Installer_Logger::get()->info(sprintf('Check the requirements'));

        // TODO Check PHP
        Subbly_Installer_Logger::get()->info(sprintf('Check PHP version'));

        // Check des modules
        foreach ($this->modules as $groupName => $modulesGroup) {
            foreach ($modulesGroup as $module) {
                if (!extension_loaded($module)) {
                    $this->unloadedModules[$groupName][] = $module;
                }
            }
        }

        if (!$this->isOK()) {
            Subbly_Installer_Logger::get()->info(sprintf('Requirements missing'), $this->unloadedModules);
        }
    }

    /**
     *
     */
    public function getInstalledModules()
    {
        $modules = $this->modules;

        foreach ($modules as $groupName => $modulesGroup) {
            foreach ($modulesGroup as $module) {
                if (
                    array_key_exists($groupName, $this->unloadedModules)
                    && in_array($module, $this->unloadedModules[$groupName])
                ) {
                    $key = array_search($module, $this->modules[$groupName]);
                    unset($modules[$groupName][$key]);
                }
            }
        }

        return $modules;
    }

    /**
     *
     */
    public function getMissingModules()
    {
        return $this->unloadedModules;
    }
}
