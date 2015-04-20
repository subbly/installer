<?php

/**
 * @deprecated MUST BE DELETED
 */
class Subbly_Installer_I18n
{
    const DEFAULT_LOCALE = 'en';

    /**
     * List of locales
     * @var array $locales
     */
    private static $locales = array(
        'en' => array(
            // requirements.php
            'requirements.title' => 'Requirements',
            'requirements.text'  => 'Some php modules are missing :/.',

            // install.php
            'form.admin.base_url'     => 'Administration Base URL (/admin)',

            // install.php
            'form.generic.title'     => 'Common settings',
            'form.generic.shop_name' => 'Shop name',

            'form.user.title'    => 'User settings',
            'form.user.email'    => 'Email',
            'form.user.password' => 'Password',

            'form.db.title'    => 'Database settings',
            'form.db.host'     => 'Database host',
            'form.db.name'     => 'Database name',
            'form.db.username' => 'Database username',
            'form.db.password' => 'Database use password',
            'form.db.prefix'   => 'Tables prefix',

            'form.submit' => 'Install!',
        ),
        'fr' => array(
            // requirements.php
            'requirements.title' => 'Prérequis',
            'requirements.text'  => 'Certains modules PHP sont introuvables :/.',

            // install.php
            'form.admin.base_url'     => 'URL de base de l\'interface d\'administration (/admin)',

            // install.php
            'form.generic.title'     => 'Paramètres',
            'form.generic.shop_name' => 'Nom de la boutique',

            'form.user.title'    => 'Paramètres utilisateur (administrateur)',
            'form.user.email'    => 'Adresse mail',
            'form.user.password' => 'Mot de passe',

            'form.db.title'    => 'Paramètres de base de données',
            'form.db.host'     => 'Hôte de la base',
            'form.db.name'     => 'Nom de la base',
            'form.db.username' => 'Nom d\'utilisateur',
            'form.db.password' => 'Mot de passe utilisateur',
            'form.db.prefix'   => 'Préfixe des tables',

            'form.submit' => 'Installer !',
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
    public static function l($key, array $params = array(), $forceLocale = null)
    {
        $locale = $forceLocale;
        if ($forceLocale === null) {
            $locale = self::getLocale();
        }

        if (
            array_key_exists($locale, self::$locales)
            && array_key_exists($key, self::$locales[$locale])
        ) {
            $locales = self::$locales[$locale];
            $message = $locales[$key];

            foreach ($params as $k => $v) {
                $params[$k] = '{'.$v.'}';
            }

            return str_replace(array_keys($params), array_values($params), $message);
        }

        if ($locale !== self::DEFAULT_LOCALE) {
            return self::l($key, $params, self::DEFAULT_LOCALE);
        }

        return $key;
    }

    /**
     *
     */
    public static function getLocale()
    {
        return 'fr'; // TODO dynamise it
    }
}
