import { TweenMax, Expo } from 'gsap/TweenMax';

class Blogs {
  init() {
    this.singTeamSlide();
    this.Blogsdateslide();
  }

  singTeamSlide() {
    

    $('.single-exp-list').slick({
      dots: false,
      infinite: true,
      speed: 300,
      arrows: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      vertical: true,
      nextArrow: '.single-arrow-prev',
      verticalSwiping: true
      
    });
    
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
  if ($('.single-news-inner-wrap').length) {
    let _module = new Blogs($('.single-news-inner-wrap'));
    _module.init();
  }
});
