<?php

class Subbly_Installer_I18n
{
    /**
     * List of locales
     * @var array $locales
     */
    private static $locales = array(
        'en' => array(
            'form.user.title' => 'User',
        ),
        'fr' => array(
            'form.user.title' => 'Utilisateur',
        ),
    );

    /**
     * Get the translated word or sentence for a given key
     *
     * @param string $key
     * @param array  $params
     *
     * @return string
     */
    public static function l($key, array $params = array())
    {
        if (array_key_exists($key, self::$locales)) {
            $message = self::$locales[$key];

            foreach ($params as $k => $v) {
                $params[$k] = '{'.$v.'}';
            }

            return str_replace(array_keys($params), array_values($params), $message);
        }

        return $key;
    }
}
