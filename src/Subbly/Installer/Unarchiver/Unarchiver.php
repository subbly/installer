<?php

abstract class Subbly_Installer_Unarchiver_Unarchiver
{
    protected $archiveFile;

    /**
     * The constructor.
     */
    public function __construct($archiveFile)
    {
        // TODO Check if filename exists
        $this->archiveFile = $archiveFile;

        $this->loadStrategies();
    }

    /**
     *
     */
    abstract protected function loadStrategies();

    /**
     *
     */
    final public function uncompress($targetDir)
    {
        foreach ((array) $this->loadStrategies() as $strategie) {

            try {
                call_user_func(array($this, 'uncompressWith'.$strategie), $targetDir);

                return;
            } catch(Exception $e) {
                // TODO log info
                Subbly_Installer_Logger::info(sprintf('Can\'t unarchive the cms with "%s" startegie.', $strategie), array($e));
            }
        }

        throw new ErrorException('Can\'t unarchive the cms.');
    }
}
