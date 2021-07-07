/*
 ===========================================================
 Table of Contents
 -----------------------------------------------------------
 ---------------------------------------------
 ** Js Index
 ---------------------------------------------
// Preloader
// Bootstrap Essentials
// Smooth Scrolling Effect
// Adjust Header Menu On Scroll Down
// On Click Show Search
// On click hide collapse menu
// Hero Section Slider
// Hero Section Slider 2
// Case Studies Section Slider
// Video hero Section
// Testimonial Carousel Slider
// Counter Js
// Team slider Section Slider
//scrollReveal js Init
// Ajax Contact Form 
// Video Hero Wrap Essentials
 ===========================================================
 ===========================================================
 */


// Js Index
(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
        $('.preloader-wrap').fadeOut('slow', function() { $(this).remove(); });
    });

    // Bootstrap Essentials
    $(".embed-responsive iframe").addClass("embed-responsive-item");
    $(".carousel-inner .item:first-child").addClass("active");
    $('[data-toggle="tooltip"]').tooltip();

    // Smooth Scrolling Effect
    $('.smoothscroll').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;

        $('html, body').stop().animate({
            'scrollTop': $(target).offset().top - 50
        }, 1200);
    });

    // Adjust Header Menu On Scroll Down
    $(window).scroll(function() {

        var wScroll = $(this).scrollTop();

        // Adjust Header Menu On Scroll Down
        if (wScroll > 0) {
            $(".nav-area ").addClass('sticky');
            // $(".navbar-default .navbar-nav").addClass('sticky2');


        } else {
            $(".nav-area").removeClass('sticky');
// $(".navbar-default .navbar-nav").removeClass('sticky2');
        }

        // Hero Parallax
        hero_parallax();
    });
/*
particlesJS.load('particles-js2', 'ajaxserver/particles.json', function() {
  console.log('callback - particles.js config loaded');
});
*/

    // On Click Show Search
    $('#srch').on('click', function() {
        $('.search-box-area').addClass('show-srch');
    });
    $('#srch-close').on('click', function() {
        $('.search-box-area').removeClass('show-srch');
    });


    // On click hide collapse menu
    $(".navbar-nav li a").on('click', function(event) {
        $(".navbar-collapse").removeClass("collapse in").addClass("collapse").removeClass('open');
        $(".navbar-toggle").removeClass('open');

    });
    $(".dropdown-toggle").on('click', function(event) {
        $(".navbar-collapse").addClass("collapse in").removeClass("collapse");
        $(".navbar-toggle").addClass('open');
    });
    $('.navbar-toggle').on('click', function() {
        $(this).toggleClass('open');
    });

    // Typed Js For Home 3 Hero Section
    $(".after-subtitle").typed({
        strings: ["Development"],
        typeSpeed: 100,
        backDelay: 1000,
    });




    // Hero Parallax
    function hero_parallax() {
        var scrollPosition = $(window).scrollTop();
        $('.tree').css('left', (0 - (scrollPosition * .2)) + '%');
        $('.coffee').css('left', (-6 - (scrollPosition * .1)) + '%');
        $('.draw').css('bottom', (-15 - (scrollPosition * .05)) + '%');
        $('.phone').css('bottom', (28 - (scrollPosition * .1)) + '%');
        $('.frame').css('right', (4 - (scrollPosition * .1)) + '%');
        $('.laptop').css('right', (1 - (scrollPosition * .2)) + '%');
    }


    // Hero Section Slider 
    function hero_slider_carousel() {
        var owl = $("#hero-slider-screen");
        owl.owlCarousel({
            loop: true,
            margin: 0,
            centar: true,
            smartSpeed: 10000,
            animateOut: 'fadeIn',
            responsiveClass: true,
            navigation: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 1,
            addClassActive: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 10000,
            responsive: {
                0: {
                    dots: true,
                    nav: false,
                },
                760: {
                    nav: false,

                }
            }
        });
        owl.on('changed.owl.carousel', function(event) {
            $('.hero-slide-holder img').addClass('animated').addClass('slideInRight')
                .delay(0)
                .fadeIn(0);
        });
        owl.on('change.owl.carousel', function(event) {
            $('.hero-slide-holder img')
                .fadeOut(0);
        });

    }
    hero_slider_carousel();


    // Testimonial Carousel Slider
    function testimonial_carousel() {
        var owl = $("#testimonial-slider");
        owl.owlCarousel({
            loop: true,
            margin: 10,
            center: true,
            smartSpeed: 2000,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 3,
            addClassActive: true,
            dots: true,
            autoplay: false,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 3
                }
            }
        });
    }
    testimonial_carousel();

    // Tab Slider
    $('.tablist li').on('click', function() {
        $('.tablist li').removeClass('active');
        $(this).addClass('active');
        var val = $(this).attr('data-value');
        $('.single-tab').removeClass('active');
        $('.tablist-content').find('.single-tab#' + val).addClass('active animated fadeIn');
    });


    // Case Studies Section Slider
    function case_carousel() {
        var owl = $("#case-slider");
        owl.owlCarousel({
            loop: true,
            margin: 10,
            smartSpeed: 2000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 1,
            addClassActive: true,
            dots: false,
            autoplay: false,
            autoplayTimeout: 7000,
            responsive: {
                0: {
                    nav: false,
                },
                760: {
                    nav: true,

                }
            }
        });
    }
    case_carousel();

    // Vedio PopUp 
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 300,
        preloader: false,
        fixedContentPos: false
    });


    // Team slider Section Slider
    function team_carousel() {
        var owl = $("#team-slider");
        owl.owlCarousel({
            loop: true,
            margin: 15,
            smartSpeed: 2000,
            responsiveClass: true,
            navigation: false,
            nav: false,
            items: 4,
            addClassActive: true,
            dots: false,
            autoplay: false,
            autoplayTimeout: 7000,
            responsive: {
                0: {
                    items: 1
                },
                760: {
                    items: 3

                },
                1100: {
                    items: 4
                }
            }
        });
    }
    team_carousel();

    // Pricing Tab
    $('.pricing-tab li').on('click', function() {
        $('.pricing-tab li').removeClass('active');
        $(this).addClass('active');
        var val = $(this).attr('data-value');
        $('.single-pricing-table').removeClass('active');
        $('.pricing-table').find('.single-pricing-table#' + val).addClass('active animated fadeIn');
    });


    // Video hero Section
    scaleVideoContainer();

    initBannerVideoSize('.video-container .poster img');
    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');

    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .poster img');
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
    });


    // Counter Js
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    //scrollReveal js Init
    window.sr = ScrollReveal({ duration: 800 });
    sr.reveal('.foo');

    // Ajax Contact Form  

    $('.cf-msg').hide();
    $('form#cf button#submit').on('click', function() {
        var fname = $('#fname').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var msg = $('#msg').val();

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {
            alert('Please enter valid email');
            return false;
        }

        fname = $.trim(fname);
        email = $.trim(email);
        subject = $.trim(subject);
        msg = $.trim(msg);

        if (fname != '' && email != '' && subject != '' && msg != '') {
            var values = "fname=" + fname + "&email=" + email + "&subject=" + subject + "&msg=" + msg;
            $.ajax({
                type: "POST",
                url: "sendMail.php",
                data: values,
                success: function() {
                    $('#fname').val('');
                    $('#email').val('');
                    $('#subject').val('');
                    $('#msg').val('');

                    $('.cf-msg').fadeIn().css('background-color', 'rgba(98, 181, 87, 0.7)').html('<p>Email has been sent successfully.</p>');
                    setTimeout(function() {
                        $('.cf-msg').fadeOut('slow');
                    }, 2000);

                }
            });
        } else {
            $('.cf-msg').fadeIn().css('background-color', 'rgba(181,62,75,0.7)').html('<p>Please fillup the informations correctly.</p>')
        }


        return false;
    });

    // Video Hero Wrap Essentials
    function scaleVideoContainer() {
        var height = $(window).height() + 5;
        var unitHeight = parseInt(height, 10) + 'px';
        $('.homepage-hero-module').css('height', unitHeight);
    }

    function initBannerVideoSize(element) {
        $(element).each(function() {
            $(this).data('height', $(this).height());
            $(this).data('width', $(this).width());
        });
        scaleBannerVideoSize(element);
    }

    function scaleBannerVideoSize(element) {
        var windowWidth = $(window).width(),
            windowHeight = $(window).height() + 5,
            videoWidth,
            videoHeight;
        $(element).each(function() {
            var videoAspectRatio = $(this).data('height') / $(this).data('width');
            $(this).width(windowWidth);
            if (windowWidth < 1200) {
                videoHeight = windowHeight;
                videoWidth = videoHeight / videoAspectRatio;
                $(this).css({
                    'margin-top': 0,
                    'margin-left': -(videoWidth - windowWidth) / 2 + 'px'
                });
                $(this).width(videoWidth).height(videoHeight);
            }
            $('.hero-area .video-container video').addClass('fadeIn animated');
        });
    }


    // All Js

}(jQuery));