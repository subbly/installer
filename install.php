<?php

require_once __DIR__.'/vendor/autoload.php';

# if env not set, set env = production and debug false;

Subbly_Installer_Logger::setLogDirectory(__DIR__.'/log');

$installer = new Subbly_Installer();
$installer->run();

Subbly_Installer_Logger::info(sprintf('Subbly is now installed'));
