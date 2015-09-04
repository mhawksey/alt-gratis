(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		if(!Modernizr.svg) {
			$('img[src*="svg"]').attr('src', function() {
				return $(this).attr('src').replace('.svg', '.png');
			});
		}
		
		/**
	   * Toggle show/hide links for off canvas layout.
	   *
	   */
      // Off-canvas menu.

      $('.l-page').bind("click touchstart", function (e) {
        var offCanvasVisible = $('.l-page-wrapper').hasClass('off-canvas-left-is-visible') || $('.l-page-wrapper').hasClass('off-canvas-right-is-visible');
        var targetIsOfOffCanvas = $(e.target).closest('.l-off-canvas').length !== 0;
        if (offCanvasVisible && !targetIsOfOffCanvas) {
          $('.l-page-wrapper').removeClass('off-canvas-left-is-visible off-canvas-right-is-visible');
          e.preventDefault();
        }
      });

      $('.l-off-canvas-show--left').bind("click touchstart", function (e) {
        $('.l-page-wrapper').removeClass('off-canvas-left-is-visible off-canvas-right-is-visible');
        $('.l-page-wrapper').addClass('off-canvas-left-is-visible');
        e.stopPropagation();
        e.preventDefault();
      });

      $('.l-off-canvas-show--right').bind("click touchstart", function (e) {
        $('.l-page-wrapper').removeClass('off-canvas-left-is-visible off-canvas-right-is-visible');
        $('.l-page-wrapper').addClass('off-canvas-right-is-visible');
        e.stopPropagation();
        e.preventDefault();
      });

      $('.l-off-canvas-hide').bind("click touchstart", function (e) {
        $('.l-page-wrapper').removeClass('off-canvas-left-is-visible off-canvas-right-is-visible');
        e.stopPropagation();
        e.preventDefault();
      });
	  
	  // Scroll to top.
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
          $('.scrolltop').fadeIn();
        } else {
          $('.scrolltop').fadeOut();
        }
      });

      $('.scrolltop').click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
      });
		
	});
	
})(jQuery, this);

