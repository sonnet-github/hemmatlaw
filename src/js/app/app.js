//modules
import { CommonHelper } from './utils/common.helper';
import './lazyload/contentlazyload.ux';

// import fancybox from '@fancyapps/fancybox';

// components
import './components/header.ux';
import './components/blogs.ux';
import './components/logos-with-slide.ux';
import './components/attorney-testimonial.ux';
import './components/single-team.ux';
import './components/single-newsroom.ux';
import './components/newsroom.ux';

import './utils/slick.min';
import sal from 'sal.js';

class WebApp {
  constructor($window, $document, _data) {
    this.$window = $window;
    this.$document = $document;
    this.data = _data ? _data : {};
  }

  init() {
    this.$document.ready(() => {
      this.afterDocumentreadyHook();
    });
    this.$window.on('load', () => {
      this.afterWindowloadHook();
    });
  }

  clearData() {
    this.data = {};
    return true;
  }

  afterDocumentreadyHook() {
    const label = document.querySelector('.dropdown__filter-selected');
    const options = Array.from(
      document.querySelectorAll('.dropdown__select-option')
    );

    options.forEach((option) => {
      option.addEventListener('click', () => {
        label.textContent = option.textContent;
      });
    });

    // Custom Dropdown
    $('.drop-down .selected a').click(function () {
      $('.drop-down .options ul').toggle();
    });

    //SELECT OPTIONS AND HIDE OPTION AFTER SELECTION
    let index = 1;

    const on = (listener, query, fn) => {
      document.querySelectorAll(query).forEach((item) => {
        item.addEventListener(listener, (el) => {
          fn(el);
        });
      });
    };

    on('click', '.selectBtn', (item) => {
      const next = item.target.nextElementSibling;
      next.classList.toggle('toggle');
      next.style.zIndex = index++;

      $('.news-backdrop').click(function () {
        $('.selectDropdown').removeClass('toggle');
      });

      $('.news-search').click(function () {
        $('.selectDropdown').removeClass('toggle');
      });
    });
    on('click', '.option a', (item) => {
      const parent = item.target.closest('.select').children[0];
      $('.selectDropdown').removeClass('toggle');
      parent.innerText = item.target.innerText;
    });

    var newsLetterPopup = $('.popupwrap-hold');
    var closeTrigger = $('.close-pop');

    this.accordion();

    // load popup once
    setTimeout(function () {
      var isLoaded = localStorage.getItem('pop-wrap-inner');

      if (!isLoaded) {
        newsLetterPopup.addClass('active');
        localStorage.setItem('pop-wrap-inner', true);
        $('body').css('overflow', 'hidden');
        $('.header-inner').css('pointer-events', 'none');
      }
    }, 4000);

    closeTrigger.on('click', function () {
      newsLetterPopup.removeClass('active');
      $('body').css('overflow', 'auto');
      $('.header-inner').css('pointer-events', 'auto');
    });

    jQuery(document).on('click', '.has-sub-menu > a', function (e) {
      e.preventDefault();
      if (jQuery(this).hasClass('clicked_once')) {
        var item_link = jQuery(this).attr('href');
        window.location.href = item_link;
      } else {
        jQuery('.has-sub-menu > a').removeClass('clicked_once');
      }
      jQuery(this).addClass('clicked_once');
    });

    // this.bindScrollToAnchor();
    $('#page-content').css({
      'min-height': this.$window.height() - $('#page-footer').height(),
    });

    // let anchor = CommonHelper.getUrlParameter('goto');

    $('.service-item').bind('click', function () {
      $(this).toggleClass('active-item');
    });

    var sal = require('sal.js');
    const scrollAnimations = sal();

    sal();

    // newslisting script

    $('.single-team-art-slick').slick({
      dots: false,
      infinite: true,
      speed: 300,
      arrows: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            dots: false,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            dots: true,
            variableWidth: true,
          },
        },
        {
          breakpoint: 421,
          settings: {
            slidesToShow: 1,
            dots: true,
            variableWidth: false,
          },
        },
      ],
    });

    var activeListsARBot = jQuery('.single-team-art-list');
    var activeitem = jQuery('.single-team-art-list.active');
    var loadMore = jQuery('.more-btn a');

    activeListsARBot.each(function (index, list) {
      var count = index + 1;

      if (count > 3) {
        jQuery(list).addClass('hidden-items');
      }
    });

    if (activeListsARBot.length < 3) {
      jQuery('.more-btn').addClass('gone');
    }

    loadMore.click(function (event) {
      event.preventDefault();

      activeListsARBot.toggleClass('active');
      activeListsARBot.removeClass('hidden-items');
      jQuery('.more-btn').addClass('gone');
    });

    if ($(window).width() < 991) {
      scrollAnimations.disable();
    }
  }

  accordion() {
    $('.accord-btn').on('click', function () {
      var content = $(this).next('.accord-body');
      var parent = $(this).parents('.accord-item');
      if (parent.hasClass('active')) {
        content.slideUp();
        parent.removeClass('active');
        return;
      }
      $('.accord-item').removeClass('active').find('.accord-body').slideUp();
      content.slideDown();
      parent.addClass('active');
    });
    $('.tcwi-inner .accord-item:first-child .accord-btn').trigger('click');
  }

  afterWindowloadHook() {
    // form
    const urlParams = new URLSearchParams(window.location.search);
    const emailVal = urlParams.get('EmailPhone');

    if (emailVal) {
      if ($('#gform_next_button_5_7:visible').length) {
        $('#input_5_5').val(emailVal);
        $('#gform_next_button_5_7:visible').click();
      }
    }

    const urlParamsTwo = new URLSearchParams(window.location.search);
    const emailValTwo = urlParamsTwo.get('ScheduleNumandemail');

    if (emailValTwo) {
      if ($('#gform_next_button_5_7:visible').length) {
        $('#input_5_5').val(emailValTwo);
        $('#gform_next_button_5_7:visible').click();
      }
    }

    const urlParamsTeams = new URLSearchParams(window.location.search);
    const emailValTeams = urlParamsTeams.get('TeamEmailPhonehero');

    if (emailValTeams) {
      if ($('#gform_next_button_5_7:visible').length) {
        $('#input_5_5').val(emailValTeams);
        $('#gform_next_button_5_7:visible').click();
      }
    }

    const urlParamsTeamSide = new URLSearchParams(window.location.search);
    const emailValTeamSide = urlParamsTeamSide.get('TeamEmailPhoneheroside');

    if (emailValTeamSide) {
      if ($('#gform_next_button_5_7:visible').length) {
        $('#input_5_5').val(emailValTeamSide);
        $('#gform_next_button_5_7:visible').click();
      }
    }
  }

  bindScrollToAnchor() {}

  scrollToAnchor(target) {}

  scrollToAnchorById(target) {}
}

const _WebApp = new WebApp($(window), $(document), {
  started: Date.now(),
}).init();
