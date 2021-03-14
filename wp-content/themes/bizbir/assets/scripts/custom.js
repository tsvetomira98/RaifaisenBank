(function($) {

    "use strict";
    $.fn.bizbir = function() {
        return this.each(function(i, elem) {
            var portfolioContainer = jQuery('.portfolio-container', elem);
            portfolioContainer.imagesLoaded(function() {
                portfolioContainer.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
            });
            jQuery('.portfolio-filter a', elem).on('click', function(e) {
                e.preventDefault();
                jQuery('.portfolio-filter .current', elem).removeClass('current');
                jQuery(this).addClass('current');

                var selector = jQuery(this).attr('data-filter');
                portfolioContainer.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        });
    };

    $(document).ready(function($) {
        $('.portfolio-main-wrapper').bizbir();

        $.fn.viewportChecker = function(useroptions) {
            // Define options and extend with user.
            var options = {
                classToAdd: 'visible',
                offset: 100,
                callbackFunction: function(elem) {}
            };
            $.extend(options, useroptions);

            // Cache the given element and height of the browser
            var $elem = this,
                windowHeight = $(window).height();

            this.checkElements = function() {
                // Set some vars to check with
                var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
                    viewportTop = $(scrollElem).scrollTop(),
                    viewportBottom = (viewportTop + windowHeight);

                $elem.each(function() {
                    var $obj = $(this);
                    // If class already exists; quit
                    if ($obj.hasClass(options.classToAdd)) {
                        return;
                    }

                    // define the top position of the element and include the offset which makes is appear earlier or later
                    var elemTop = Math.round($obj.offset().top) + options.offset,
                        elemBottom = elemTop + ($obj.height());

                    // Add class if in viewport
                    if ((elemTop < viewportBottom) && (elemBottom > viewportTop)) {
                        $obj.addClass(options.classToAdd);

                        // Do the callback function. Callback will send the jQuery object as parameter
                        options.callbackFunction($obj);
                    }
                });
            };

            // Run checkelements on load and scroll.
            $(window).on('scroll', this.checkElements);
            this.checkElements();

            // On resize change the height var.
            $(window).on('resize', function(e) {
                windowHeight = e.currentTarget.innerHeight;
            });

        };

        // Search in header.
        if ($('.search-icon').length > 0) {
            $('.search-icon').on('click', function(e) {
                e.preventDefault();
                $('.search-box-wrap').slideToggle();
            });
        }
        $('#search-button, .search-box-blur').on('click', function( e ) {
            $('#search-button, .search-box-blur, .custom-search-container, #page.site').toggleClass('search-open');
        });


        $('.btn-close-sidebar').on('click',function(e){
            e.preventDefault();
            $.sidr('close', 'sidr-pull-sidebar');
        });

       var mySwiper = new Swiper('.swiper-container', {
          // Optional parameters
          direction: 'horizontal',
          loop: true,

          // If we need pagination
          pagination: {
            el: '.swiper-pagination',
            clickable: true 
          },

          // Navigation arrows
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        })

        $('#sidr-main').find('.sub-menu,.flat-mega-memu').before('<span class="dropdown-toggle"><strong class="dropdown-icon"></strong>');

        $('#sidr-main').find('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).next('.sub-menu,.flat-mega-memu').slideToggle();
            $(this).toggleClass('toggle-on');
        });

        // Counter up.
        $('.counter-nos').counterUp({
            delay: 10,
            time: 1000
        });

        // Fixed header.
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > $('.sticky-enabled').offset().top && !($('.sticky-enabled').hasClass('sticky-header'))) {
                $('.sticky-enabled').addClass('sticky-header');
            } else if (0 === $(window).scrollTop()) {
                $('.sticky-enabled').removeClass('sticky-header');
            }
        });
        $('ul.tabs li').on('click', function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

        // Single product gallery
        $('.single-main-thumb').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay:true,
          arrows: false,
          fade: true,
          asNavFor: '.pager-thumbnail'

        });

        // Product gallery
        $('.pager-thumbnail').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.single-main-thumb',
          dots: false,
          centerMode: true,
          focusOnSelect: true,
                      prevArrow: '<span data-role="none" class="slick-prev" tabindex="0"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
            nextArrow: '<span data-role="none" class="slick-next" tabindex="0"><i class="fas fa-angle-right" aria-hidden="true"></i></span>'
        });

        // Slick carousel column 1.
        $(".normal-carousel").slick( );


        // Skil bar.
        jQuery('.skillbar').each(function() {
            jQuery(this).find('.skillbar-bar').animate({
                width: jQuery(this).attr('data-percent')
            }, 3000);
        });

        // Lighbox.
        jQuery('a[data-gal]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('gal'));
        });
        jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
            animationSpeed: 'slow',
            slideshow: false,
            overlay_gallery: false,
            theme: 'light_square',
            social_tools: false,
            deeplinking: false
        });


        // Implement go to top.
        var $scroll_obj = $('#btn-scrollup');
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 100) {
                $scroll_obj.fadeIn();
            } else {
                $scroll_obj.fadeOut();
            }
        });

        $scroll_obj.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });


       // FAQ Accordion.
        $('.faq-accordion').accordionjs(); {
        }
    });

    $(document).ready(function(){

        setTimeout(function(){
            $('.ad-wrapper').slideDown('slow');
        }, 5000);
        $('.ad-wrapper .close').on('click',function(){
            $('.ad-wrapper').hide().addClass('hide');
        });

        $('.quick-view-link,.login-popup-btn').magnificPopup({
            type: 'inline',
        });
        if( $('#subscribe-popup' ).length > 0 ) {
            $(window).load(function () {
                // retrieved this line of code from http://dimsemenov.com/plugins/magnific-popup/documentation.html#api
                $.magnificPopup.open({
                    items: {
                        src: '#subscribe-popup'
                    },
                    type: 'inline'

                  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
                  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
                }, 0);
            });
        }

     });

    var dom = {};
    var CM_Catmandu = {

        init: function () {
            this.focusMenuWithChildren();
        },

        // The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
        // by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
        focusMenuWithChildren: function() {
            // Get all the link elements within the primary menu.
            var links, i, len,
                menu = document.querySelector( '#main-navigation' );

            if ( ! menu ) {
                return false;
            }

            links = menu.getElementsByTagName( 'a' );

            // Each time a menu link is focused or blurred, toggle focus.
            for ( i = 0, len = links.length; i < len; i++ ) {
                links[i].addEventListener( 'focus', toggleFocus, true );
                links[i].addEventListener( 'blur', toggleFocus, true );
            }

            //Sets or removes the .focus class on an element.
            function toggleFocus() {
                var self = this;

                // Move up through the ancestors of the current link until we hit .primary-menu.
                while ( -1 === self.className.indexOf( 'primary-menu' ) ) {
                    // On li elements toggle the class .focus.
                    if ( 'li' === self.tagName.toLowerCase() ) {
                        if ( -1 !== self.className.indexOf( 'focus' ) ) {
                            self.className = self.className.replace( ' focus', '' );
                        } else {
                            self.className += ' focus';
                        }
                    }
                    self = self.parentElement;
                }
            }
        },

    };

    // CM_Catmandu.init();
})(jQuery);



