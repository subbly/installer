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
            $this->isValid = $this->hasErrors();
        }

        return (boolean) $this->isValid;
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
        // Check the datas

        $userEmail = Subbly_Installer_Util::get_array_value($this->datas, 'user.email');
        if (empty($userEmail)) {
            $this->addError('user.email', 'form.errors.user.email.missing');
        }
    }

    /**
     *
     */
    protected function addError($fieldKey, $messageKey)
    {
        $this->errors[$fieldKey][] = $messageKey;
    }
}
