
/**
 * @file
 * A JavaScript file for the theme.
 */


(function (Drupal, $) {

  Drupal.behaviors.emmausToTop = {
    attach: function (context, settings) {
      $("#toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        setTimeout(function () {
          $("html, body").stop();
        }, 1000);
      });
    }
  };

  Drupal.behaviors.emmausAccordion = {
    attach: function (context, settings) {
      let blockItems = $('.block-type-accordion .field--name-field-paragraphs > .field__item');
      runAccordionItems(blockItems);
      let paragraphItems = $('.paragraph--type--accordion .field--name-field-items > .field__item');
      runAccordionItems(paragraphItems);
    }
  };

  function runAccordionItems(accordionItems) {
    if (accordionItems.length > 0) {
      accordionItems.find('.field--name-field-text').slideUp();

      accordionItems.find('.field--name-field-title').once().click(function () {
        let t = $(this);
        if (t.closest('.paragraph--type--accordion-item').hasClass('active')) {
          t.siblings('.field--name-field-text').slideUp().closest('.paragraph--type--accordion-item').removeClass('active');
        }
        else {
          accordionItems.find('.field--name-field-text').slideUp();
          accordionItems.find('.paragraph--type--accordion-item').removeClass('active');
          t.siblings('.field--name-field-text').slideDown().closest('.paragraph--type--accordion-item').addClass('active');
        }
      });
    }
  }

  // Tabs
  Drupal.behaviors.cmmlTabs = {
    attach: function (context, settings) {
      var tab = $('.block-type-tabs .paragraph--type--tab-item');
      if (tab.length) {
        var tabs = "<div class='cmml-tabs'>";
        tab.each(function (e) {
          var t = $(this);
          var id = t.attr('id');
          var tab_label = t.find('.field--name-field-label').text();
          if (e === 0) {
            tabs += "<div class='cmml-tab active' data-id='" + id + "'>" + tab_label + "</div>";
            t.parent('.field__item').addClass('active');
          }
          else {
            tabs += "<div class='cmml-tab' data-id='" + id + "'>" + tab_label + "</div>";
          }
        });
        tabs += "</div>";
        $('.block-type-tabs').once().prepend(tabs);

        $('.cmml-tab').once().click(function () {
          var t = $(this);
          if (!t.hasClass('active')) {
            t.siblings('.cmml-tab').removeClass('active');
            $('.block-type-tabs .field--name-field-items > .field__item').removeClass('active');
            t.addClass('active');
            $('#' + t.attr('data-id')).parent('.field__item').addClass('active');
          }
        });
      }
    }
  };

  // FAQs
  Drupal.behaviors.cmmlFAQs = {
    attach: function (context, settings) {
      let faq_items = $('.paragraph--type--faq-item');
      let faq_categories = $('.faq-categories li');

      faq_categories.once().click(function () {
        let t = $(this);
        let type = t.attr('data-type');
        if (type !== 'all') {
          faq_categories.removeClass('active');
          t.addClass('active');
          faq_items.hide();
          $('.paragraph--type--faq-item.' + type).show();
        }
        else {
          faq_categories.removeClass('active');
          t.addClass('active');
          faq_items.show();
        }
      });

      faq_items.once().click(function () {
        let t = $(this);
        if (t.hasClass('active')) {
          t.removeClass('active');
        }
        else {
          $('.paragraph--type--faq-item').removeClass('active');
          t.addClass('active');
        }
      });
    }
  };


  $(function() {
    $('.single-item').slick(
      {
        dots: true,
        infinite: true,
        adaptiveHeight: true
      }
    );

    $('.block-type-program_tabs__content').slice(1).hide();
    $('#block-type-program-tabs li').eq(0).addClass('active');
    $('#block-type-program-tabs li a').click(function(e) {
        e.preventDefault();
        var content = $(this).attr('href');
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $("#" + content).show();
        $("#" + content).siblings('.block-type-program_tabs__content').hide();
    });

  });
  
})(Drupal, jQuery);
