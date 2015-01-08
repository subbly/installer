<?php

class Subbly_Installer_Util
{
    /**
     *
     */
    public static function call_json($url)
    {
        return json_decode(file_get_contents($url));
    }

    /**
     *
     */
    public static function download($url, $targetPath)
    {
        copy($source, $dest);
    }
}
