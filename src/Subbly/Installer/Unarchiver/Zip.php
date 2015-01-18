<?php

class Subbly_Installer_Unarchiver_Zip extends Subbly_Installer_Unarchiver_Unarchiver
{
    /**
     * {@inheritdoc}
     */
    protected function loadStrategies()
    {
        return array(
            // 'PharData', // FIXME unarchive with phar do encode problems
            'ZipArchive',
            // 'ExecutingCommand',
        );
    }

    /**
     * Uncompress zip archive with PharData class
     *
     * @param string $targetDir
     */
    protected function uncompressWithPharData($targetDir)
    {
        $phar = new PharData($this->archiveFile);
        $phar->extractTo($targetDir);
    }

    /**
     * Uncompress zip archive with ZipArchive class
     *
     * @param string $targetDir
     */
    protected function uncompressWithZipArchive($targetDir)
    {
        $zip = new ZipArchive();

        if ($zip->open($this->archiveFile) === true) {
            $zip->extractTo($targetDir);
            $zip->close();
        } else {
            throw new ErrorException(''); // TODO
        }
    }
}
