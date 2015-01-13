<?php

class Subbly_Installer_Unarchiver_Zip extends Subbly_Installer_Unarchiver_Unarchiver
{
    /**
     *
     */
    protected function loadStrategies()
    {
        return array(
            'Phar',
            'ZipArchive',
            // 'ExecutingCommand',
        );
    }

    /**
     *
     */
    protected function uncompressWithPhar($targetDir)
    {
        $phar = new PharData($this->archiveFile);
        $phar->extractTo($targetDir);
    }

    /**
     *
     */
    protected function uncompressWithZip($targetDir)
    {
        $zip = new ZipArchive();

        if ($zip->open($this->archiveFile) === TRUE) {
            var_dump($zip->extractTo($targetDir));
            $zip->close();
        } else {
            throw new ErrorException(''); // TODO
        }
    }
}
