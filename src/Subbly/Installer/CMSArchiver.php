<?php

class Subbly_Installer_CMSArchiver
{
    protected $archiveFile;

    /**
     * The constructor.
     */
    public function __contruct()
    {
    }

    /**
     *
     */
    public function downloadLatest()
    {
        $url = Subbly_Installer::HANGAR_API_CMSLATEST;
        $apiResponse = Subbly_Installer_Util::call_json($url);
        $cmsVersion = $apiResponse->response->cms_version;

        // TODO check if there is a downloaded file. And if there is, look the checksum to be sure it's the latest version and the good name. If ok continue, else download again

        // Download
        $this->archiveFile = Subbly_Installer_Util::download($cmsVersion->download_url);

        if (!self::verifyChecksum($this->archiveFile, $cmsVersion->checksum)) {
            throw new ErrorException('TODO'); // TODO
        }
    }

    /**
     *
     */
    protected static function verifyChecksum($file, $checksum)
    {
        return md5_file($file) === $checksum;
    }

    /**
     *
     */
    public function uncompress()
    {
        switch ($this->getMimeType($this->archiveFile)) {
            case 'application/zip':
                $unarchiver = new Subbly_Installer_Unarchiver_Zip($this->archiveFile);
                break;

            default:
                // TODO Exception
                break;
        }

        $unarchiver->uncompress(BASEDIR);
    }

    /**
     *
     */
    protected function getMimeType($filename)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filename);

        finfo_close($finfo);

        return $mimeType;
    }
}
