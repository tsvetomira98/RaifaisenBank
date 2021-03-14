jQuery(function ($) {

  /**
     * =========================
     * magnific popup start
     * =========================
     */
  $('#popimg').magnificPopup({
    delegate: '.btn-gallery',
    type: 'image',
    gallery: {
      enabled: true
    }
  });
  //for video
  $('.button-play').magnificPopup({
    type: 'iframe'
  });


  var nav_menu = $('.main-navigation ul.nav-menu');

  /**
   * =========================
   * Accessibility codes start
   * =========================
   */
  $(document).on('mousemove', 'body', function (e) {
    $(this).removeClass('keyboard-nav-on');
  });
  $(document).on('keydown', 'body', function (e) {
    if (e.which == 9) {
      $(this).addClass('keyboard-nav-on');
      $(nav_menu).removeAttr('style');
    }
  });
  /**
   * =========================
   * Accessibility codes end
   * =========================
   */

  /**
   * =========================
   * mobile navigation codes start
   * =========================
   */

  /* button for subm-menu (work only on mobile) */

  $('#primary-menu')
    .find('li.menu-item-has-children ul.sub-menu')
    .before('<button class="btn_submenu_dropdown"><span><i class="drop-down-icon"></i></span></button>')
    // .append('<button class="btn_submenu_dropdown"><span><i class="drop-down-icon"></i></span></button>');

  /* submenu toggle */
  $(document).on('click ', '.btn_submenu_dropdown', function () {
    $(this).toggleClass('active');
    $(this).parent().find('.sub-menu').first().slideToggle();
  });

 var nav_menu = $('.main-navigation ul.nav-menu');
  $(document).on('click', '.menu-toggle', function () {
    $(this).toggleClass('menu-toggle--active');
    nav_menu.slideToggle().toggleClass("menu-open");
  });
  /**
   * =========================
   * mobile navigation codes ended
   * =========================
   */

  /**
   * =========================
   * sticky navigation
   * =========================
   */

  $(window).on('scroll', function () {
    if ($(window).scrollTop() >= 50) {
      $('.heading-content').addClass('is-sticky-header');
    } else {
      $('.heading-content').removeClass('is-sticky-header', 1000, "easeInBack");
    }
  });
  /**
   * =========================
   * sticky navigation
   * =========================
   */

  /**
   * =========================
   * scroll up/back to top
   * =========================
   */

  var scroll = $(window).scrollTop();
  var $scroll_btn = $('#btn-scrollup');
  var $scroll_obj = $('.scrollup');
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 1) {
      $scroll_btn.css({ bottom: "25px" });
    }
    else {
      $scroll_btn.css({ bottom: "-100px" });
    }
  });
  $scroll_obj.click(function () {
    $('html, body').animate({ scrollTop: '0px' }, 800);
    return false;
  });
  /**
   * =========================
   * scroll up/back to top
   * =========================
   */

  /**
  * =========================
  * notice bar
  * =========================
  */
  $(document).on("click", '.notice-bar-cross', function () {
    $(".notice-bar").fadeOut();
  });
  /**
   * =========================
   * noticebar
   * =========================
   */

  /**
  * =========================
  * slick
  * =========================
  */

  /* slick button for mulitple slider */
  $(document).on('click', '.slider-nav .slick-next', function () {
    $(".multiple-slider .slick-next").trigger('click');
  });
  $(document).on('click', '.slider-nav .slick-prev', function () {
    $(".multiple-slider .slick-prev").trigger('click');
  });

  /* slick button for latest-news-slider */
  $(document).on('click', '.slider-blog-nav .slick-next', function () {
    $(".latest-news-slider .slick-next").trigger('click');
  });
  $(document).on('click', '.slider-blog-nav .slick-prev', function () {
    $(".latest-news-slider .slick-prev").trigger('click');
  });

  /* slick button for gallery slider */
  $(document).on('click', '.gallery-nav  .slick-next', function () {
    $(".gallery-slider .slick-next").trigger('click');
  });
  $(document).on('click', '.gallery-nav  .slick-prev', function () {
    $(".gallery-slider .slick-prev").trigger('click');
  });

  function eduFront_slick_slider() {

    $(".lazy").slick({
      lazyLoad: 'ondemand', // ondemand progressive anticipated
      infinite: true
    });
    $('.banner-slider').not('.slick-initialized').slick({
      autoplay: true,
      speed: 500,
      infinite: true,
      cssEase: 'linear',
      fade: true,
    });

    $('.multiple-slider').not('.slick-initialized').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      centerPadding: '40px',
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.latest-news-slider').not('.slick-initialized').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      centerPadding: '40px',
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 1600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.testimonial-slider').not('.slick-initialized').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 2,
      rows: 2,
      centerPadding: '40px',
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          rows: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    $('.instruction-slider').not('.slick-initialized').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      centerPadding: '40px',
      slidesToScroll: 4,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.gallery-slider').not('.slick-initialized').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      centerPadding: '40px',
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 1600,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

  }
  eduFront_slick_slider();
  /**
  * =========================
  * slick
  * =========================
  */





  var courseFilter = document.getElementsByClassName('course-filter-by');
  if ('undefined' !== typeof courseFilter) {
    $(courseFilter).on('change', function () {
      $(this).parent('.course-filter-by-form').submit();
    });
  }



});
