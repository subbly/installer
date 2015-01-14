<?php

class Subbly_Installer_Unarchiver_Zip extends Subbly_Installer_Unarchiver_Unarchiver
{
    /**
     * {@inheritdoc}
     */
    protected function loadStrategies()
    {
        return array(
            'ZipArchive',
            // 'ExecutingCommand',
        );
    }

    /**
     * Uncompress zip archive with ZipArchive class
     *
     * @param string $targetDir
     */
    protected function uncompressWithZip($targetDir)
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
