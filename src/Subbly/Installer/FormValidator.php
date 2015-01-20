<?php

class Subbly_Installer_FormValidator
{
    protected $datas;
    protected $errors;
    protected $isValid;

    /**
     *
     */
    public function __construct(array $datas)
    {
        $this->datas   = $datas;
        $this->errors  = array();
        $this->isValid = null;
    }

    /**
     *
     */
    public function isValid()
    {
        if ($this->isValid === null) {
            $this->validate();
            $this->isValid = !$this->hasErrors();
        }

        return (boolean) $this->isValid;
    }

    /**
     *
     */
    public function getData($key)
    {
        return Subbly_Installer_Util::get_array_value($this->datas, $key);
    }

    /**
     *
     */
    public function hasErrors()
    {
        return count($this->errors) !== 0;
    }

    /**
     *
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     *
     */
    protected function validate()
    {
        // generic.shop_name
        if (!$this->getData('generic.shop_name')) {
            $this->addError('generic.shop_name', 'form.errors.generic.shop_name.missing');
        }
        // generic.admin_baseurl
        if (!$this->getData('generic.admin_baseurl')) {
            $this->addError('generic.admin_baseurl', 'form.errors.generic.admin_baseurl.missing');
        }

        // user.email
        if (!$this->getData('user.email')) {
            $this->addError('user.email', 'form.errors.user.email.missing');
        } else if (filter_var($this->getData('user.email'), FILTER_VALIDATE_EMAIL) === false) {
            $this->addError('user.email', 'form.errors.user.email.invalid');
        }
        // user.password
        if (!$this->getData('user.password')) {
            $this->addError('user.password', 'form.errors.user.password.missing');
        } else if (strlen($this->getData('user.password')) < 8) {
            $this->addError('user.password', 'form.errors.user.password.too_short');
        }

        // db.host
        if (!$this->getData('db.host')) {
            $this->addError('db.host', 'form.errors.db.host.missing');
        }
        // db.name
        if (!$this->getData('db.name')) {
            $this->addError('db.name', 'form.errors.db.name.missing');
        }
        // db.username
        if (!$this->getData('db.username')) {
            $this->addError('db.username', 'form.errors.db.username.missing');
        }
        // db.password
        if (!$this->getData('db.password')) {
            $this->addError('db.password', 'form.errors.db.password.missing');
        }

        if (($errorMessage = $this->isDBConnectionOK()) !== true) {
            $this->addError('db', 'form.errors.db{'.$errorMessage.'}');
        }
    }

    /**
     *
     */
    protected function addError($fieldKey, $messageKey)
    {
        $this->errors[$fieldKey][] = $messageKey;
    }

    /**
     *
     */
    protected function isDBConnectionOK()
    {
        $dsn = "mysql:dbname={$this->getData('db.name')};host={$this->getData('db.host')}";

        try {
            $dbh = new PDO($dsn, $this->getData('db.username'), $this->getData('db.password'));
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
