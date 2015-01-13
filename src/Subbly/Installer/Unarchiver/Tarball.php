<?php

class Subbly_Installer_Unarchiver_Tarball extends Subbly_Installer_Unarchiver_Unarchiver
{
    /**
     *
     */
    protected function loadStrategies()
    {
        return array(
            // 'Phar',
            // 'ExecutingCommand',
        );
    }

    /**
     *
     */
    protected function uncompressWithPhar($targetDir)
    {
        $p = new PharData('/path/to/my.tar.gz');
        $p->decompress();

        // unarchive from the tar
        $phar = new PharData('/path/to/my.tar');
        $phar->extractTo('/full/path');
    }
}
