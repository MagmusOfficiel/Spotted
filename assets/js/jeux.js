/*-----------------------------------------------------------------------------------
    Template Name: Deadfire
    Description: Gaming and eSports HTML5 Template
    Author: Codezion 
    Author URI: https://www.templatemonster.com/authors/codezion/
    Version: 1.0
-----------------------------------------------------------------------------------*/
(function($) {
    'use strict';
    $(window).on('load', function() {
        $('.preloader').addClass('hidden');
        $('[data-popup="tooltip"]').tooltip();
    });
    $(".hamburger_trigger > .trigger_inner").on('click', function() {
        $(".header .navigation").toggleClass('open');
        $(this).toggleClass('active');
    });
    $(".search_trigger").on('click', function() {
        $(".header .search_form").toggleClass('open');
        $(this).toggleClass('active');
    });
    // Mobile Menu
    $(".header .menu-item-has-children > a").on('click', function(e) {
        var submenu = $(this).next(".sub-menu");
        e.preventDefault();
        submenu.slideToggle(200);
    });
    // Popup Video
    $('.popup_video').magnificPopup({
        type: 'iframe',
    });
    // Popup Image
    $('.popup_image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    // Counter
    $(".counter_box .counter").each(function() {
        var $this = $(this);
        $this.one('inview', function(event, isInView) {
            if (isInView) {
                $this.countTo({ speed: 5000 });
            }
        });
    });
    $(".bar_text > li > span").each(function() {
        var $this = $(this);
        $this.one('inview', function(event, isInView) {
            if (isInView) {
                $this.countTo();
            }
        });
    });
    // Progress bar
    $(".progress").each(function() {
        var progressBar = $(this).find(".progress-bar");
        $(progressBar).one('inview', function(event, isInView) {
            if (isInView) {
                $(progressBar).animate({
                    width: $(progressBar).attr("aria-valuenow") + "%"
                });
            }
        });
    });
    // banner_slider
    $('.banner_slider').slick({
        dots: false,
        arrows: true,
        prevArrow: $('.banner_arrows .slick-prev'),
        nextArrow: $('.banner_arrows .slick-next'),
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        rtl: rtl_slick(),
    }).slickAnimation();
    // testimonial_slider
    $('.testimonial_slider').slick({
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        rtl: rtl_slick(),
    });
    // post_slider
    $('.post_slider').slick({
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        rtl: rtl_slick(),
    });
    // video_slider
    $('.video_slider').slick({
        dots: false,
        arrows: true,
        prevArrow: $('.video_arrows .slick-prev'),
        nextArrow: $('.video_arrows .slick-next'),
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        rtl: rtl_slick(),
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    });
    // testimonial_main_slider
    $('.testimonial_main_slider').slick({
        dots: false,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        rtl: rtl_slick(),
        asNavFor: '.testimonial_nav_slider',
    });
    // testimonial_nav_slider
    $('.testimonial_nav_slider').slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        centerMode: true,
        centerPadding: '0px',
        autoplaySpeed: 2000,
        infinite: true,
        focusOnSelect: true,
        rtl: rtl_slick(),
        asNavFor: '.testimonial_main_slider',
        responsive: [{
            breakpoint: 576,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    // smooth scroll
    $.fn.smoothScroll = function(setting) {
        var _default = {
                duration: 1000,
                easing: 'swing',
                offset: 0,
                top: '100px'
            },
            _setting = $.extend(_default, setting),
            _handler = function() {
                var dest = 0,
                    target = this.hash,
                    $target = $(target);
                $(this).on('click', function(e) {
                    e.preventDefault();
                    if ($target.offset().top > ($(document).height() - $(window).height())) {
                        dest = $(document).height() - $(window).height();
                    } else {
                        dest = $target.offset().top - _setting.offset;
                    }
                    $('html, body').animate({
                        scrollTop: dest
                    }, _setting.duration, _setting.easing);
                });
            };
        return this.each(_handler);
    };
    $('.smooth_scroll .nav-link').smoothScroll({
        duration: 1000, // animation speed
        easing: 'swing', // find more easing options on http://api.jqueryui.com/easings/
        offset: 0 // custom offset
    });
    //  Scroll back to top / Header Fix
    var offset = 150;
    var duration = 550;
    jQuery(window).on('scroll', function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.backtotop').addClass('active');
            jQuery('.can-sticky').addClass('sticky');
        } else {
            jQuery('.backtotop').removeClass('active');
            jQuery('.can-sticky').removeClass('sticky');
        }
    });
    jQuery('.backtotop').on('click', function(event) {
        event.preventDefault();
        jQuery('html, body').animate({ scrollTop: 0 }, duration);
        return false;
    })
    // Current year
    $(function() {
        if ($('span').is('#year')) {
            var d = new Date();
            document.getElementById("year").innerHTML = d.getFullYear();
        }
    });

    function rtl_slick() {
        if ($('html').is("[dir='rtl']")) {
            return true;
        } else {
            return false;
        }
    };
    // banner animation
  $(function () {
    if ($('div').is('#banner-animation')) {
      particlesJS('banner-animation', {
        "particles": {
          "number": {
            "value": 80,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "src": "img/github.svg",
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.5,
            "random": false,
            "anim": {
              "enable": false,
              "speed": 1,
              "opacity_min": 0.1,
              "sync": false
            }
          },
          "size": {
            "value": 5,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 40,
              "size_min": 0.1,
              "sync": false
            }
          },
          "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "repulse"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 400,
              "size": 40,
              "duration": 2,
              "opacity": 8,
              "speed": 3
            },
            "repulse": {
              "distance": 200
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true,
        "config_demo": {
          "hide_card": false,
          "background_color": "#b61924",
          "background_image": "",
          "background_position": "50% 50%",
          "background_repeat": "no-repeat",
          "background_size": "cover"
        }
      });
    }
  });
    new WOW().init();

})(jQuery);