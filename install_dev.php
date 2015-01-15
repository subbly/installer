<?php

require_once __DIR__.'/vendor/autoload.php';

# set env devel
define('BASEDIR', __DIR__.'/tmp/sandbox');
define('DEBUG', true);
define('HANGAR_API_HOST', 'http://hangar.subbly.dev/api/v1');

if (file_exists(BASEDIR)) {
    $fs = new \Symfony\Component\Filesystem\Filesystem();
    $fs->remove(BASEDIR);
}
mkdir(BASEDIR, 0777, true);

require_once './install.php';
