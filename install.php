<?php

require_once __DIR__.'/vendor/autoload.php';

// Constants
define('BASEDIR', __DIR__);
if (!defined('DEBUG')) {
    define('DEBUG', false);
}

$installer = new Subbly_Installer();
$installer->run();

Subbly_Installer_Logger::info(sprintf('Subbly is now installed'));
