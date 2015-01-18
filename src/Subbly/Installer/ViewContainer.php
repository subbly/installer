<?php

class Subbly_Installer_ViewContainer
{
    /*** !PARSE_DELIMITER! !BEGIN! DON'T REMOVE THIS LINE ***/

    private static $layoutParams = array();

    /**
     *
     */
    public static function renderTemplate($templateName, array $params = array(), $layout = true)
    {
        self::$layoutParams = $params;

        if ($layout === true) {
            $params = array_merge($params, array(
                '_page_template' => $templateName,
                '_view_params'   => $params,
            ));

            $templateName = 'layout.html.php';
        }

        return self::$getTemplateContent($templateName, $params);
    }

    /**
     *
     */
    public static function partial($templateName, array $params = array())
    {
        if (count($params) === 0) {
            $params = self::$layoutParams;
        }

        return self::$getTemplateContent($templateName, $params);
    }

    /*** !PARSE_DELIMITER! !END! DON'T REMOVE THIS LINE ***/

    /**
     *
     */
    protected static function getTemplateFile($templateName)
    {
        $templateBaseDir = __DIR__.'/Resources/views/';

        return $templateBaseDir.'/'.$templateName;
    }

    /**
     *
     */
    protected static function getTemplateContent($templateName, $params)
    {
        ob_start();

        extract($params);
        require self::getTemplateFile($templateName);

        return ob_get_clean();
    }
}
