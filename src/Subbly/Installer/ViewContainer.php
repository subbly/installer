<?php

class Subbly_Installer_ViewContainer
{
    //builder_delimiter_begin

    private static $layoutParams = array();

    /**
     *
     */
    public static function renderTemplate($templateName, array $params = array(), $layout = true)
    {
        self::$layoutParams = $params;

        if ($layout === true) {
            $params = array_merge($params, array(
                '_page_template'  => $templateName,
                '_view_params'    => $params,
                '_locales_values' => Subbly_Installer_I18n::allLocales(),
            ));

            $templateName = 'layout.html.php';
        }

        return self::getTemplateContent($templateName, $params);
    }

    /**
     *
     */
    public static function partial($templateName, array $params = array())
    {
        if (count($params) === 0) {
            $params = self::$layoutParams;
        }

        return self::getTemplateContent($templateName, $params);
    }

    //builder_delimiter_end

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
