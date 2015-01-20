<?php

class Subbly_Installer_Installer
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
        $apiResponse = Subbly_Installer_Util::call_json(HANGAR_API_CMSLATEST);
        $cmsVersion = $apiResponse->response->cms_version;

        // TODO check if there is a downloaded file. And if there is, look the checksum to be sure it's the latest version and the good name. If ok continue, else download again

        // Download
        $this->archiveFile = Subbly_Installer_Util::download($cmsVersion->download_url);

        if (!self::verifyChecksum($this->archiveFile, $cmsVersion->checksum)) {
            throw new Subbly_Installer_HTTPException(sprintf('Checksum not valid!')); // TODO
        }
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
     *
     */
    public function install(Subbly_Installer_FormValidator $form)
    {
        // TODO execute what it must be
        //
        //      1. save setted configs
        //      2. migrations
        //      3. create the user

        // 1. Save setted configs
        $configFile = BASEDIR.'/config/config.yml';
        $yaml = new Alchemy_Component_Yaml_Yaml();
        $settings = $yaml->load($configFile);

        $settings['database']['host'] = $form->getData('db.host');
        $settings['database']['name'] = $form->getData('db.name');
        $settings['database']['username'] = $form->getData('db.username');
        $settings['database']['password'] = $form->getData('db.password');
        $settings['database']['prefix'] = $form->getData('db.prefix');

        $yaml = new Alchemy_Component_Yaml_Yaml($configFile);
        file_put_contents($configFile, $yaml->dump($settings, 4, 0));

        // 2. Execute migrations
        // TODO

        // 3. Create the user
        // TODO

        // 4. Remove archive file
        // TODO
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

    /**
     *
     */
    protected function execCommand($bin, array $params = array())
    {
        $command = $bin;

        foreach ($params as $param) {
            $command .= ' '.$param;
        }

        return shell_exec($command);
    }
}
