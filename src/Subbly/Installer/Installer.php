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
     * Download the latest version of the CMS.
     */
    public function downloadLatest()
    {
        $apiResponse = Subbly_Installer_Util::call_json(HANGAR_API_CMSLATEST);

        if ($apiResponse === null) {
            throw new Subbly_Installer_HTTPException(sprintf('Can not upload the hangar api! URL: %s', HANGAR_API_CMSLATEST));
        }

        // TODO check if there is a downloaded file. And if there is, look the checksum to be sure it's the latest version and the good name. If ok continue, else download again

        // Download
        $cmsVersion        = $apiResponse->response->cms_version;
        $this->archiveFile = Subbly_Installer_Util::download($cmsVersion->download_url);

        if (!self::verifyChecksum($this->archiveFile, $cmsVersion->checksum)) {
            throw new Subbly_Installer_HTTPException(sprintf('Checksum not valid!')); // TODO
        }
    }

    /**
     * Uncompress the downloaded archive.
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
     * Install the CMS.
     *
     * @param Subbly_Installer_FormValidator $form
     */
    public function install(Subbly_Installer_FormValidator $form)
    {
        // 1. Save setted configs
        $configFile = BASEDIR.'/config/config.yml';
        $yaml = new Alchemy_Component_Yaml_Yaml();
        $settings = $yaml->load($configFile);

        $settings['app']['key'] = md5(microtime().rand());

        $settings['database']['host'] = $form->getData('db.host');
        $settings['database']['name'] = $form->getData('db.name');
        $settings['database']['username'] = $form->getData('db.username');
        $settings['database']['password'] = $form->getData('db.password');
        $settings['database']['prefix'] = $form->getData('db.prefix');

        $yaml = new Alchemy_Component_Yaml_Yaml($configFile);
        file_put_contents($configFile, $yaml->dump($settings, 4, 0));

        // 2. Execute migrations
        $this->execCommand('php', array('artisan', 'migrate', '--package=cartalyst/sentry'));
        $this->execCommand('php', array('artisan', 'migrate'));
        // $this->execCommand('php', array('artisan', 'db:seed'));

        // 3. Create the user
        $this->execCommand('php', array('artisan', 'migrate'));

        // 4. Remove archive file
        @unlink($this->archiveFile);
        @rmdir(dirname($this->archiveFile));
    }

    /**
     * Verfiy a checksum.
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
     * Get the mime type of the downloaded archive.
     *
     * @param string $filename
     *
     * @return string
     */
    protected function getMimeType($filename)
    {
        $finfo    = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filename);
        finfo_close($finfo);

        return $mimeType;
    }

    /**
     * Execute a command.
     *
     * @param string $bin
     * @param array $params
     *
     * @return mixed
     */
    protected function execCommand($bin, array $params = array())
    {
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w"),
        );

        // Don't save the password into the log file!
        Subbly_Installer_Logger::get()->debug(sprintf('Execute command "%s"', $bin));

        $command = $bin;

        foreach ($params as $param) {
            $command .= ' '.$param;
        }

        $process = proc_open($command, $descriptorspec, $pipes, null, null);

        if (is_resource($process)) {
            if (($error = stream_get_contents($pipes[2])) !== null) {
                throw new Subbly_Installer_HTTPException(sprintf('Error while executing "%s" - "%s"',
                    $command,
                    $error
                ));
            }

            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);

            return proc_close($process);
        }

        return shell_exec($command);
    }
}
