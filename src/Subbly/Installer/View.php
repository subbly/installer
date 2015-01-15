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
}
