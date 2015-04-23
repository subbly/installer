<?php

/**
 * @deprecated MUST BE DELETED
 */
class Subbly_Installer_I18n
{
    const DEFAULT_LOCALE = 'en';

    /**
     * List of locales.
     *
     * @var array
     */
    private static $locales = array(
        'en' => array(
            // requirements.php
            'requirements.title' => 'Requirements',
            'requirements.text'  => 'Some php modules are missing :/.',

            // install.php
            'form.generic.title'                        => 'Welcome,<br />install your lovely shop',
            'form.generic.languages.label'              => 'Installation language',
            'form.generic.languages.english'            => 'english',
            'form.generic.languages.french'             => 'français',
            'form.generic.shop_name.label'              => 'Name of your shop',
            'form.generic.shop_name.placeholder'        => 'My shop',
            'form.generic.links.next'                   => 'Start the aventure',

            'form.user.title'                           => 'User settings',
            'form.user.email.label'                     => 'Your email',
            'form.user.email.placeholder'               => 'you@yourshop.com',
            'form.user.password'                        => 'Your password',
            'form.user.password.placeholder'            => 'pa33w0rd',
            'form.user.admin.base_url.label'            => 'Your back-office directory (optionnal)',
            'form.user.admin.base_url.placeholder'      => 'admin',
            'form.user.links.next'                      => 'Next',

            'form.db.title'                             => 'Database settings',
            'form.db.host.label'                        => 'Database host',
            'form.db.host.placeholder'                  => '127.0.0.1',
            'form.db.name.label'                        => 'Database name',
            'form.db.name.placeholder'                  => 'name',
            'form.db.username.label'                    => 'Database username',
            'form.db.username.placeholder'              => 'username',
            'form.db.password.label'                    => 'Database user password',
            'form.db.password.placeholder'              => 'password',
            'form.db.prefix.label'                      => 'Tables prefix',
            'form.db.prefix.placeholder'                => 'subbly_',

            'form.submit' => 'Finish',
        ),
        'fr' => array(
            // // requirements.php
            // 'requirements.title' => 'Prérequis',
            // 'requirements.text'  => 'Certains modules PHP sont introuvables :/.',

            // // install.php
            // 'form.generic.title'                    => 'Bienvenue,<br />installez votre adorable boutique',
            // 'form.generic.languages.label'          => 'Langue d\'installation',
            // 'form.generic.languages.english'        => 'english',
            // 'form.generic.languages.french'         => 'français',
            // 'form.generic.shop_name.label'          => 'Nom de votre boutique',
            // 'form.generic.shop_name.placeholder'    => 'Ma boutique',
            // 'form.generic.admin.base_url.label'     => 'URL de base de l\'interface d\'administration (/admin)',
            // 'form.generic.links.next'               => 'Démarrer l\'aventure',

            // 'form.user.title'    => 'Paramètres utilisateur (administrateur)',
            // 'form.user.email'    => 'Adresse mail',
            // 'form.user.password' => 'Mot de passe',
            // 'form.user.links.next' => 'Etape suivante',

            // 'form.db.title'    => 'Paramètres de base de données',
            // 'form.db.host'     => 'Hôte de la base',
            // 'form.db.name'     => 'Nom de la base',
            // 'form.db.username' => 'Nom d\'utilisateur',
            // 'form.db.password' => 'Mot de passe utilisateur',
            // 'form.db.prefix'   => 'Préfixe des tables',

            // 'form.submit' => 'Terminer',
        ),
    );

    /**
     * Get the translated word or sentence for a given key.
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
