(function ($, Drupal) {
  Drupal.behaviors.bmgShare = {
    attach: function (context, settings) {
      $('.share-it').click(function(event) {
        var width  = 575,
            height = 420,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            url    = this.href,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;

        window.open(url, 'twitter', opts);

        return false;
      });
    }
  };
})(jQuery, Drupal);