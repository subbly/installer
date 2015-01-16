<?php

class Subbly_Installer_View
{
    /**
     *
     */
    public static function render($templateName, array $params = array())
    {
        $content = Subbly_Installer_ViewContainer::renderTemplate($templateName, $params);

        print $content;
    }

    /**
     *
     */
    public static function request_input($key = null)
    {
        $inputs = array_merge($_GET, $_POST);

        if ($key === null) {
            return $inputs;
        }

        if (($value = Subbly_Installer_Util::get_array_value($inputs, $key)) !== null) {
            return $value;
        }

        return null;
    }
}
