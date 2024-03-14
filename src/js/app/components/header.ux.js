import { TweenMax, Expo } from 'gsap/TweenMax';

class HeaderUX {
  constructor() {
    this.$triggers = {
      mobile_menu_toggle: $('.mobile-menu-trigger'),
      search_toggle: $('#nav-search > i'),
    };

    this.$mobile_menu = $('#mobile-menu');
    this.$contactslide = $('.mobile-nav-address');
    this.is_mobile_menu_active = false;

    this.$mobile_menu_items = $('#mobile-menu nav > a, #mobile-menu nav > div');
    this.$search_bar = $('#nav-search > input');
    this.$search_input = $('input[name="search"]');

    this.sticky_class = 'sticky-mode';
  }

  init() {
    this.adjustNav();
    this.bindEventTriggers();
    this.bindSearch();
    this.bindScroll();
    this.bindMobileSubNavToggle();
    this.ActiveNav();

    $(window).resize(() => {
      this.adjustNav();
    });
  }

  adjustNav() {
    $('#main-navigation .has-sub-menu .sub-nav').each(function () {
      let parent = $(this).parent();
      TweenMax.set($(this), {
        x: 0 - ($(this).width() - parent.width()) / 2,
      });
    });
  }

  bindEventTriggers() {
    this.$triggers.mobile_menu_toggle.unbind('click');
    this.$triggers.mobile_menu_toggle.bind('click', () => {
      this.toggleMobileMenu();
    });

    this.$triggers.search_toggle.unbind('click');
    this.$triggers.search_toggle.bind('click', () => {
      this.toggleSearchBar();
    });

    $('.ux-scroll-to-anchor').bind('click', () => {
      this.closeMobileMenu();
    });
  }

  bindScroll() {
    $(window).scroll(() => {
      let scroll = $(window).scrollTop();
      let hh = $('#page-header').height() + 1;
      let offset = 0;
      if (scroll >= hh - offset) {
        $('#page-header').addClass(this.sticky_class);
      } else {
        $('#page-header').removeClass(this.sticky_class);
      }
    });
  }

  toggleMobileMenu() {
    if (!this.is_mobile_menu_active) {
      this.openMobileMenu();
    } else {
      this.closeMobileMenu();
    }
  }

  toggleSearchBar() {
    this.$search_bar.toggleClass('active-search');
  }

  bindSearch() {
    this.$search_input.on('change', function () {
      let s = $(this).val();

      if (s.length) {
        s = encodeURI(s);
        let base = $(this).attr('data-sctrl');
        window.location = base + '?qs=' + s;
      }
    });
  }

  bindMobileSubNavToggle() {
    this.$mobile_menu.find('.has-sub-menu > a').bind('click', function () {
      $(this).nextAll('.sub-nav').slideToggle();
      $(this).toggleClass('sub-nav-active');
    });
  }

  ActiveNav() {
    document.onreadystatechange = function () {
      var selected_parent;
      if (document.readyState === 'about-us') {
        selected_parent = $('.nav-item')
          .children()
          .find('a')
          .filter('.active')
          .parent('.with-sub')
          .index();
        jQuery.data(document.body, 'selected_parent', selected_parent);
      }
      if (document.readyState === 'complete') {
        var selected_parent = jQuery.data(document.body, 'selected_parent');
        $('#menu')
          .children('li:eq(' + selected_parent + ')')
          .children('a')
          .addClass('active');
      }
    };
  }

  openMobileMenu() {
    TweenMax.set(this.$mobile_menu, {
      opacity: 0,
      x: '100vw',
      display: 'block',
      ease: Expo.easeOut,
    });

    TweenMax.set(this.$contactslide, {
      opacity: 0,
      x: '100vw',
      display: 'block',
      ease: Expo.easeOut,
    });

    TweenMax.set(this.$mobile_menu_items, {
      opacity: 0,
      x: '30vw',
    });

    this.$triggers.mobile_menu_toggle.addClass('active-menu');
    $('#page-header').addClass('mobile-menu-active');

    TweenMax.to(this.$mobile_menu, 0.5, {
      opacity: 1,
      x: 0,
      onComplete: () => {
        this.is_mobile_menu_active = true;
        TweenMax.staggerTo(
          this.$mobile_menu_items,
          0.45,
          {
            x: 0,
            opacity: 1,
          },
          0.15
        );
      },
    });

    TweenMax.to(this.$contactslide, 0.8, {
      opacity: 1,
      x: 0,
      onComplete: () => {
        this.is_mobile_menu_active = true;
        TweenMax.staggerTo(
          this.$mobile_menu_items,
          0.85,
          {
            x: 0,
            opacity: 1,
          },
          0.35
        );
      },
    });
  }

  closeMobileMenu() {
    this.$triggers.mobile_menu_toggle.removeClass('active-menu');
    $('#page-header').removeClass('mobile-menu-active');

    TweenMax.to(this.$mobile_menu, 0.5, {
      opacity: 0,
      x: '100vw',
      ease: Expo.easeIn,
      onComplete: () => {
        this.is_mobile_menu_active = false;
        TweenMax.set(this.$mobile_menu, {
          display: 'none',
        });
      },
    });
  }
}

$(function () {
  let _module = new HeaderUX();
  _module.init();
});
