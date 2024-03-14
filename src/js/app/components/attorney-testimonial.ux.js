import { TweenMax, Expo } from 'gsap/TweenMax';

class AT {
  init() {
    this.AtTestimonial();
  }

  AtTestimonial() {
    $('.at-list').slick({
      dots: false,
      infinite: true,
      speed: 300,
      arrows: true,
      nextArrow: '.lgs-arrows.lgs-arrow-next',
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 1,
            dots: true
          },
        }
      ],
    });
  }
}

$(document).ready(() => {
  if ($('.block--custom-layout__at').length) {
    let _module = new AT($('.block--custom-layout__at'));
    _module.init();
  }
});
