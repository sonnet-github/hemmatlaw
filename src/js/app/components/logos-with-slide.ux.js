import { TweenMax, Expo } from 'gsap/TweenMax';

class Blogs {
  constructor($elem) {
    this.block = $elem;
  }

  init() {
    this.LogoSlide();
  }

  LogoSlide() {
    var slideContainer = this.block.find('.lgs-inner');
    var slider = $('.lgs-list');

    slider.slick({
      dots: false,
      infinite: true,
      speed: 2100,
      arrows: true,
      nextArrow: '.lgs-arrows.lgs-arrow-next',
      prevArrow: '.lgs-arrows.lgs-arrow-prev',
      slidesToShow: 4,
      slidesToScroll: 1,
      cssEase: 'linear',
      pauseOnHover: true,
      autoplay: true,
      autoplaySpeed: 0,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            adaptiveHeight: true,
            speed: 2100,
          },
        },
        {
          breakpoint: 481,
          settings: {
            slidesToShow: 1,
            adaptiveHeight: true,
            speed: 2100,
          },
        },
      ],
    });

    slideContainer.on('mouseenter', function () {
      console.log('in');
      slider.slick('slickPlay');
    });

    slideContainer.on('mouseleave', function () {
      console.log('out');
      slider.slick('slickPause');
    });
  }
}

$(document).ready(() => {
  if ($('.block--custom-layout__lws').length) {
    let _module = new Blogs($('.block--custom-layout__lws'));
    _module.init();
  }
});
