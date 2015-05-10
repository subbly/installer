<?php

class Subbly_Installer_Util
{
    /**
     * Call a JSON REST api.
     *
     * @param string $url
     * @param mixed
     */
    public static function call_json($url)
    {
        return json_decode(file_get_contents($url));
    }

    /**
     * Download a file.
     *
     * @param string $url
     * @param string $targetPath
     *
     * @return string The path of the downloaded file
     */
    public static function download($url, $targetPath = null)
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

    /**
     * Get a value from a path
     *
     * @return mixed
     */
    public static function get_array_value(array $array, $path)
    {
        if (is_string($path)) {
            $paths = explode('.', $path);
            $value = $array;

            foreach ($paths as $key) {
                if (array_key_exists($key, $value)) {
                    $value = $value[$key];
                } else {
                    return;
                }
            }

            return $value;
        }

        if (array_key_exists($path, $array)) {
            return $array[$path];
        }

        return;
    }
}
