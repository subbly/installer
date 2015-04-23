<?php

class Subbly_Installer_ErrorHandler
{
    private static $debug = false;

    private $levels = array(
        E_WARNING           => 'Warning',
        E_NOTICE            => 'Notice',
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING      => 'User Warning',
        E_USER_NOTICE       => 'User Notice',
        E_STRICT            => 'Runtime Notice',
        E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
    );

    private $debugLevels = array(
        E_ERROR           => 'Error',
        E_DEPRECATED      => 'Deprecated',
        E_USER_DEPRECATED => 'User Deprecated',
    );

    /**
     * Registers the error handler.
     *
     * @return The registered error handler
     */
    public static function register($debug = false)
    {
        self::$debug = $debug;
        set_error_handler(array(new static(), 'handleError'));
        set_exception_handler(array(new static(), 'handleException'));
    }

    /**
     * Turn off errors.
     */
    public static function quiet()
    {
        error_reporting(0);
    }

    /**
     * Unregisters the error handler.
     */
    public static function unregister()
    {
        restore_error_handler();
    }

    /**
     * @throws \ErrorException When error_reporting returns error
     */
    public function handleError($level, $message, $file = 'unknown', $line = 0, $context = array())
    {
        $levels = $this->levels;
        if (self::$debug === true) {
            $levels = array_merge($levels, $this->debugLevels);
        }

        if (error_reporting() & $level) {
            throw new \ErrorException(sprintf('%s: %s in %s line %d', isset($levels[$level]) ? $levels[$level] : $level, $message, $file, $line));
        }

        return false;
    }

    /**
     *
     */
    public function handleException($exception)
    {
        Subbly_Installer_Logger::get()->error(sprintf('%s thrown with message "%s" in %s on line %s',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        ), $exception->getTrace());
    }
}
