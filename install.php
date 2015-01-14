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
    define('HANGAR_API_HOST', 'http://hangar.subbly.com');
}

$installer = new Subbly_Installer();
$installer->run();

Subbly_Installer_Logger::info(sprintf('Welcome! Subbly is now installed'));
