'use strict';

function homeMaskCalc(){
	if( jQuery('.home-header-mask').length > 0 ){
		var mask_width = 1141, mask_height = 884,
			broswer_width = jQuery(window).width(),
			menu_left = jQuery('.header-right').offset().left,
			mask_left = parseInt(menu_left) - 80,
			mask_height = parseInt((broswer_width - mask_left) * mask_height / mask_width);

		jQuery('.home-header-mask').css('left', mask_left + 'px').css('height', mask_height + 'px');
	}
}

jQuery(window).load(function(){
	homeMaskCalc();	
})

jQuery(document).ready(function(){
	// homeMaskCalc();	
	

	jQuery(window).resize(function(){
		homeMaskCalc();
	});

	if( jQuery('.home-testimonial-slider').length > 0 ){
		jQuery('.home-testimonial-slider-inner').slick({
			fade: true,
			dots: false,
			prevArrow: jQuery('.home-testimonial-slider-prev'),
			nextArrow: jQuery('.home-testimonial-slider-next'),
		});
	}

	jQuery('.home-gallery-wrapper').imagesLoaded(function(){
		jQuery('.home-gallery-wrapper').masonry({
			itemSelector: '.gallery',
		});
	});
});