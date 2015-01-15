<?php

class Subbly_Installer_ViewContainer
{


    /*** !PARSE_DELIMITER! !BEGIN! DON'T REMOVE THIS LINE ***/

    private static $layoutParams = array();

    /**
     *
     */
    public static function renderTemplate($templateName, array $params = array())
    {
        self::$layoutParams = $params;

        $params = array_merge($params, array(
            '_page_template' => $templateName,
            '_view_params'   => $params,
        ));

        ob_start();

        extract($params);
        require self::getTemplateFile('layout.html.php');

        return ob_get_clean();
    }

    /**
     *
     */
    public static function partial($templateName, array $params = array())
    {
        ob_start();

        if (count($params) === 0) {
            $params = self::$layoutParams;
        }
        extract($params);

        require self::getTemplateFile($templateName);

        return ob_get_clean();
    }

    /*** !PARSE_DELIMITER! !END! DON'T REMOVE THIS LINE ***/

    protected static function getTemplateFile($templateName)
    {
        $templateBaseDir = __DIR__.'/Resources/views/';

        return $templateBaseDir.'/'.$templateName;
    }
}
