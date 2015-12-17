/*
 * Hero Block Manager
 * Version 0.9.7
 * Author: Oliver Green
 * Twitter: @olsgreen
 * 
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
*/

(function ($, w) {
    'use strict';

    function HeroBlockManager(block)
    {
        if ('1' === block.fill_screen) {
            setupFillScreen();
        }

        if ('1' === block.background_parallax.enabled && '0' === block.mobile) {
            setupBackgroundParallax();
        } 
        else if('1' === block.mobile) {
            block.$stage
                .css('background-attachment', 'scroll')
                .css('background-position', 'center')
                .css('background-size', 'cover');
        }

        if ('1' === block.mask_parallax.enabled && '0' === block.mobile) {
            setupMaskParallax();
        } 
        else if('1' === block.mobile) {
            block.$mask
                .css('background-attachment', 'scroll')
                .css('background-position', 'center')
                .css('background-size', 'cover');
        }

        if (block.$video.length > 0 && '0' === block.mobile) {
            setupVideo();
        }

        function setupFillScreen()
        {
            function fillScreen()
            {
                var viewport_height = (w.innerHeight - parseInt(block.fill_screen_offset));

                if (CCM_EDIT_MODE) {
                    viewport_height -= 48;
                }

                block.$content.css('height', viewport_height);
            }
            fillScreen();

            if ('0' === block.mobile) {
                $(w).resize(fillScreen);
            }
            else {
                $(w).on('orientationchange', fillScreen);
            }
        }

        function setupBackgroundParallax()
        {
            if (!$.fn.parallax) {
                setTimeout(setupBackgroundParallax, 100);
                return;
            }

            block.$stage.parallax("50%", block.background_parallax.speed);
        }

        function setupMaskParallax()
        {
            if (!$.fn.parallax) {
                setTimeout(setupMaskParallax, 100);
                return;
            }

            block.$mask.parallax("50%", block.mask_parallax.speed);
        }

        function setupVideo() 
        {
            var dataloaded = false,
                windowloaded = false;;

            function getAspect($element)
            {
                return $element.width() / $element.height();
            }

            function setMinimumWidth()
            {
                var minWidth = getAspect(block.$video) * block.$stage.height();
                block.$video.css('min-width', minWidth + 'px');
            }

            function tryPlay()
            {
                if (windowloaded && dataloaded) {
                    block.$video.get(0).play();
                }
            }

            block.$video.bind('loadeddata', function () {
                setMinimumWidth();
                block.$video.css('visibility', 'visible');
                dataloaded = true;
                tryPlay();
            });

            $(window).load(function () {
                windowloaded = true;
                tryPlay();
            });

            $(window).resize(function () {
                setMinimumWidth();
            });

        }
    }

    window.HeroBlockManager = HeroBlockManager;

}(jQuery, window));