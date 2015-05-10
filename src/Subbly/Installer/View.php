<?php

class Subbly_Installer_View
{
    /**
     * Render a template.
     *
     * @param string  $templateName
     * @param array   $params
     * @param boolean $layout
     *
     * @static
     */
    public static function render($templateName, array $params = array(), $layout = true)
    {
        $content = Subbly_Installer_ViewContainer::renderTemplate($templateName, $params, $layout);

        echo $content;
    }

    /**
     * Retrieve request inputs
     *
     * @return array
     *
     * @static
     */
    public static function getRequestInputs()
    {
        return array_merge($_GET, $_POST);
    }

    /**
     * Retrieve a request input
     *
     * @param string $key
     *
     * @return mixed
     *
     * @static
     */
    public static function getRequestInput($key)
    {
        $inputs = self::getRequestInputs();

        if (($value = Subbly_Installer_Util::get_array_value($inputs, $key)) !== null) {
            return $value;
        }

        return;
    }
}
