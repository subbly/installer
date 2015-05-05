// Framework Encapsulation
(function () {
  smoothScroll.init({
    speed: 333,
    easing: 'easeInOutCubic',
    updateURL: false,
    offset: 0
  });

  var app = new Vue({
    el: 'body',
    data: {
      locale: 'english',
      languages: {
        'english': {
          'requirements.title'                        : 'Requirements',
          'requirements.text'                         : 'Some php modules are missing :/.',

          'form.generic.title'                        : 'Welcome,<br />install your lovely shop',
          'form.generic.languages.label'              : 'Installation language',
          'form.generic.languages.english'            : 'english',
          'form.generic.languages.french'             : 'français',
          'form.generic.shop_name.label'              : 'Name of your shop',
          'form.generic.shop_name.placeholder'        : 'My shop',
          'form.generic.links.next'                   : 'Start the aventure',

          'form.user.title'                           : 'User settings',
          'form.user.email.label'                     : 'Your email',
          'form.user.email.placeholder'               : 'you@yourshop.com',
          'form.user.password.label'                  : 'Your password',
          'form.user.password.placeholder'            : 'pa33w0rd',
          'form.user.admin.base_url.label'            : 'Your back-office directory (optionnal)',
          'form.user.admin.base_url.placeholder'      : 'admin',
          'form.user.links.next'                      : 'Next',

          'form.db.title'                             : 'Database settings',
          'form.db.host.label'                        : 'Database host',
          'form.db.host.placeholder'                  : '127.0.0.1',
          'form.db.name.label'                        : 'Database name',
          'form.db.name.placeholder'                  : 'name',
          'form.db.username.label'                    : 'Database username',
          'form.db.username.placeholder'              : 'username',
          'form.db.password.label'                    : 'Database user password',
          'form.db.password.placeholder'              : 'password',
          'form.db.prefix.label'                      : 'Tables prefix',
          'form.db.prefix.placeholder'                : 'subbly_',

          'form.submit'                               : 'Finish'
        },
        'french': {
          'requirements.title'                        : 'Prérequis',
          'requirements.text'                         : 'Certains modules PHP sont introuvables :/.',

          'form.generic.title'                        : 'Bienvenue,<br />installez votre adorable boutique',
          'form.generic.languages.label'              : 'Langue d\'installation',
          'form.generic.languages.english'            : 'english',
          'form.generic.languages.french'             : 'français',
          'form.generic.shop_name.label'              : 'Nom de votre boutique',
          'form.generic.shop_name.placeholder'        : 'Ma boutique',
          'form.generic.links.next'                   : 'Démarrer l\'aventure',

          'form.user.title'                           : 'Paramètres utilisateur (administrateur)',
          'form.user.email.label'                     : 'Adresse mail',
          'form.user.email.placeholder'               : 'contact@maboutique.fr',
          'form.user.password.label'                  : 'Mot de passe',
          'form.user.password.placeholder'            : 'pa33w0rd',
          'form.user.admin.base_url.label'            : 'Votre repertoire d\'administration (optionnal)',
          'form.user.admin.base_url.placeholder'      : 'admin',
          'form.user.links.next'                      : 'Etape suivante',

          'form.db.title'                             : 'Paramètres de base de données',
          'form.db.host.label'                        : 'Hôte de la base',
          'form.db.host.placeholder'                  : '127.0.0.1',
          'form.db.name.label'                        : 'Nom de la base',
          'form.db.name.placeholder'                  : 'subbly',
          'form.db.username.label'                    : 'Nom d\'utilisateur',
          'form.db.username.placeholder'              : 'subbly',
          'form.db.password.label'                    : 'Mot de passe utilisateur',
          'form.db.password.placeholder'              : 'pa33w0rd',
          'form.db.prefix.label'                      : 'Préfixe des tables',
          'form.db.prefix.placeholder'                : 'subbly_',

          'form.submit'                               : 'Terminer'
        }
      }
    },
    methods: {
      onLanguageSelectorClick: function (event) {
        event.preventDefault();

        this.selectLanguage(event.target.dataset.locale);
      },
      selectLanguage: function (locale) {
        if (!(locale in this.languages)) {
          throw new Error('Unknown locale: ' + locale);
        }

        this.locale = locale;
      }
    },
    filters: {
      serialize: function (data) {
        return JSON.stringify(data);
      }
    }
  });
})();

// jQuery dependencies encapsulation
(function ($) {
  $.fn.classToggler = function (config) {
    var _config = $.extend({
      "activeOptionClass": "active"
    }, config);
    var selector = this.selector;

    $(selector).on({
      click: function (event) {
        $(selector).removeClass(_config.activeOptionClass);
        $(this).addClass(_config.activeOptionClass);
      }
    });

    return this;
  };

  if ($ === undefined) {
    throw new Error('jQuery is not defined');
  }

  $(function () {
    $('a', '.step').classToggler({
      targetFieldId: '#active'
    });
  });
})(window.jQuery);
