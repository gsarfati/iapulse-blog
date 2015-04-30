/**
 * Theme functions file
 */
(function ($) {
    'use strict';

    var $document = $(document);
    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });

        /**
         * Activate jQuery.mmenu.
         */
        $("#menu-main-slide").mmenu({
            slidingSubmenus: false
        })

        /**
         * News ticker.
         */
        $('#ticker').ticker();

        /**
         * FitVids - Responsive Videos in posts
         */
        $(".entry-content").fitVids();


        /**
         * Clickable divs.
         */
        $('.clickable').on('click', function() {
            window.location.href = $(this).data('href');
        });

    });

    $window.on('load', function() {
        /**
         * Activate main slider.
         */
        $('#slider').sllider();
    });


    $.fn.sllider = function() {
        return this.each(function () {
            var $this = $(this);

            var flky = new Flickity('.slides', {
                autoPlay: (zoomOptions.slideshow_auto ? parseInt(zoomOptions.slideshow_speed, 10) : false),
                cellAlign: 'left',
                contain: true,
                percentPosition: false,
                //prevNextButtons: false,
                pageDots: false,
                accessibility: false
            });
        });
    };

    $.fn.ticker = function() {
        return this.each(function () {
            var $this = $(this);

            var _scroll = {
                delay: 1000,
                easing: 'linear',
                items: 1,
                duration: 0.05,
                timeoutDuration: 0,
                pauseOnHover: 'immediate'
            };

            $this.carouFredSel({
                width: auto,
                align: false,
                items: {
                    width: 'variable',
                    height: 35,
                    visible: 1
                },
                scroll: _scroll
            });

            // $this.parent('.caroufredsel_wrapper').css('width', '100%');
        }) ;
    };

})(jQuery);
