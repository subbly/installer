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
     * Retrieve the request inputs
     *
     * @param null|string $key
     *
     * @static
     */
    public static function getRequestInputs($key = null)
    {
        $inputs = array_merge($_GET, $_POST);

        if ($key === null) {
            return $inputs;
        }

        if (($value = Subbly_Installer_Util::get_array_value($inputs, $key)) !== null) {
            return $value;
        }

        return;
    }
}
