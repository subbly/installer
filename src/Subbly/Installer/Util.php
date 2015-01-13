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
    public static function download($url, $targetPath=null)
    {
        if ($targetPath === null || !is_dir($targetPath)) {
            $targetPath = BASEDIR.'/tmp/';
            mkdir(BASEDIR.'/tmp/', 0777, true);
        }

        $urlPaths = explode('/', $url);
        $filepath = $targetPath.end($urlPaths);

        file_put_contents($filepath, fopen($url, 'r'));

        return $filepath;
    }
}
