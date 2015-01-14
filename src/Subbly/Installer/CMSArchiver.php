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
     * Download the latest version of the CMS
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
     * Verfiy a checksum
     *
     * @param string $file     Path of the file to check
     * @param string $checksum
     *
     * @return boolean
     */
    protected static function verifyChecksum($file, $checksum)
    {
        return md5_file($file) === $checksum;
    }

    /**
     * Uncompress the downloaded archive
     */
    public function uncompress()
    {
        if (empty($this->archiveFile)) {
            return; // IDEA return a exception instead
        }

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
     * Get the mime type of the downloaded archive
     *
     * @param string $filename
     *
     * @return string
     */
    protected function getMimeType($filename)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filename);

        finfo_close($finfo);

        return $mimeType;
    }
}
