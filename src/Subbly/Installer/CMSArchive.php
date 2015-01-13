<?php

class Subbly_Installer_CMSArchive
{
    /**
     *
     */
    public static function downloadLatestArchive()
    {
        $url = Subbly_Installer::HANGAR_API_CMSLATEST;
        $cmsVersion = Subbly_Installer_Util::call_json($url);

        // Download
        $file = Subbly_Installer_Util::download($cmsVersion->download_url);

        if (!self::verifyChecksum($file, $cmsVersion->checksum)) {
            throw new ErrorException('TODO'); // TODO
        }
    }

    protected static function verifyChecksum($file, $checksum)
    {
        return md5_file($file) == $checksum;
    }

    protected static function uncompress()
    {
        try {
            $this->uncompressWithPhar();
        } catch(Exception $e) {

        }
    }

    protected static function uncompressWithPhar()
    {
        $p = new PharData('/path/to/my.tar.gz');
        $p->decompress();

        // unarchive from the tar
        $phar = new PharData('/path/to/my.tar');
        $phar->extractTo('/full/path');
    }
}
