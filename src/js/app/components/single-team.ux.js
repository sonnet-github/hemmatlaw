import { TweenMax, Expo } from 'gsap/TweenMax';

class Blogs {
  init() {
    this.singTeamSlide();
    this.Blogsdateslide();
  }

  singTeamSlide() {
    
    var slides = $('.single-exp-item');
    var container = jQuery('.single-exp-edu');
    var containerHeight = container.height();
    var slidesToShow = 2;

    if(slides.length === 1) {

      $('.single-exp-list').addClass('slide-height-auto');

    } 

    // initialize container height
    container.css('height', containerHeight + 'px');

    $('.single-exp-list').slick({
      dots: false,
      infinite: true,
      speed: 300,
      arrows: true,
      slidesToShow: slidesToShow,
      slidesToScroll: 1,
      vertical: true,
      nextArrow: '.single-arrow-prev',
      verticalSwiping: true,
      adaptiveHeight: true,
    });

    

    if(slides.length > slidesToShow) {

      container.css('height', 'auto');

      // Calculate the heighest slide and set a top/bottom margin for other children.
      // As variableHeight is not supported yet: https://github.com/kenwheeler/slick/issues/1803
      var maxHeight = -1;

      $('.single-exp-list .slick-slide').each(function() {
        if ($(this).height() > maxHeight) {
          maxHeight = $(this).height();
        }
      });
      
      $('.single-exp-list .slick-slide').each(function() {
        if ($(this).height() < maxHeight) {
          $(this).css('margin', Math.ceil((maxHeight-$(this).height())/2) + 'px 0');
        }
      });

    }
    
    
  }

  Blogsdateslide() {
    $('.single-team-mob .single-team-art-list').slick({
      dots: true,
      infinite: true,
      speed: 300,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  }
}

$(document).ready(() => {
  if ($('.single-team-wrap').length) {
    let _module = new Blogs($('.single-team-wrap'));
    _module.init();
  }
});
