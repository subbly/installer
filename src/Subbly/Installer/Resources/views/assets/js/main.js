smoothScroll.init({
  speed: 333,
  easing: 'easeInOutCubic',
  updateURL: true,
  offset: 0
});

(function ($) {
  $.fn.classToggler = function (config) {
    var _config = $.extend({
      "activeOptionClass": "active"
    }, config);
    var selector = this.selector;

    $(selector).on({
      click: function (event) {
        console.log(event);
        $(selector).removeClass(_config.activeOptionClass);
        $(this).addClass(_config.activeOptionClass);
      }
    });

    return this;
  };

  $.fn.hiddenRatioField = function (config) {
    var _config = $.extend({
      "shouldPreventDefault": true,
      "activeOptionClass": "active",
      "targetFieldId": "#hidden-ratio"
    }, config);
    var selector = this.selector;

    if (!_config.targetFieldId || $(_config.targetFieldId).length === 0) {
      throw new Error('hiddenRatioField should target an actual hidden ratio field, but it is undefined.');
    }

    $(selector).on({
      click: function (event) {
        if (_config.shouldPreventDefault) {
          event.preventDefault();
        }

        $(selector).removeClass(_config.activeOptionClass);
        $(this).addClass(_config.activeOptionClass);

        $(_config.targetFieldId).val($(this).data('value'));
      }
    });

    return this;
  };

  if ($ === undefined) {
    throw new Error('jQuery is not defined');
  }

  $(function () {
    $('.language-option').hiddenRatioField({
      targetFieldId: '#generic_language'
    });

    $('a', '.step').classToggler({
      targetFieldId: '#active'
    });
  });
})(window.jQuery);
