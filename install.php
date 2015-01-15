<?php

set_time_limit(0);

require_once __DIR__.'/vendor/autoload.php';

// Constants
if (!defined('BASEDIR')) {
    define('BASEDIR', __DIR__);
}
if (!defined('DEBUG')) {
    define('DEBUG', false);
}
if (!defined('HANGAR_API_HOST')) {
    define('HANGAR_API_HOST', 'http://hangar.subbly.com/api/v1');
}
define('HANGAR_API_CMSLATEST', HANGAR_API_HOST.'/cms/latest');

$installer = new Subbly_Installer_Application();
$installer->run();

// Subbly_Installer_Logger::get()->info(sprintf('Welcome! Subbly is now installed'));
