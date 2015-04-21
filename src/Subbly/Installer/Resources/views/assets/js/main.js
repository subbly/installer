(function ($) {
  if ($ === undefined) {
    throw new Error('jQuery is not defined');
  }

  $(function () {
    $(window).on({
      scroll: function (event) {
        console.log(event);
        event.preventDefault();
      }
    })
  });
})(window.jQuery);
