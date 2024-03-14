import { TweenMax, Expo } from 'gsap/TweenMax';

class Blogs {
  init() {
    this.Blogsdateslide();
  }

  Blogsdateslide() {
    $('.blog-mob .blogs-list').slick({
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
  if ($('.block--custom-layout__blogs').length) {
    let _module = new Blogs($('.block--custom-layout__blogs'));
    _module.init();
  }
});
