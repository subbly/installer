<?php

abstract class Subbly_Installer_Unarchiver_Unarchiver
{
    protected $archiveFile;

    /**
     * The constructor.
     *
     * @param string $archiveFile
     */
    public function __construct($archiveFile)
    {
        // TODO Check if filename exists
        $this->archiveFile = $archiveFile;

        $this->loadStrategies();
    }

    /**
     * Load the unarchive strategies.
     *
     * @return array
     */
    abstract protected function loadStrategies();

    /**
     * Uncompress the archive.
     *
     * @param string $targetDir
     *
     * @return boolean
     */
    final public function uncompress($targetDir)
    {
        foreach ((array) $this->loadStrategies() as $strategie) {
            try {
                call_user_func(array($this, 'uncompressWith'.$strategie), $targetDir);

                return true;
            } catch (Exception $e) {
                // TODO log info
                Subbly_Installer_Logger::get()->info(sprintf('Can\'t unarchive the cms with "%s" startegie.', $strategie), array($e));
            }
        }

        throw new ErrorException('Can\'t unarchive the cms.');
    }
}
