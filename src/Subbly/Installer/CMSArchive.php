<?php

class Subbly_Installer_CMSArchive
{
    /**
     *
     */
    public function latest()
    {
        $url = Subbly_Installer::HANGAR_API_BASEURL . '/cms/latest';
        $res = Subbly_Installer_Util::call_json($url);

        // Download
    }

    protected function verifyChecksum()
    {

    }

    public function uncompress()
    {
        try {
            $this->uncompressWithPhar();
        } catch(Exception $e) {

        }
    }

    protected function uncompressWithPhar()
    {
        $p = new PharData('/path/to/my.tar.gz');
        $p->decompress(); // creates /path/to/my.tar

        // unarchive from the tar
        $phar = new PharData('/path/to/my.tar');
        $phar->extractTo('/full/path');
    }
}
