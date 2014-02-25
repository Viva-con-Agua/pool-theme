jQuery(document).ready(function() {
		jQuery('.accordion section h5').click(function(e) {
		jQuery(this).parents().siblings('section').removeClass('acc-show');
		jQuery(this).parents('section').toggleClass('acc-show');
		var elementHeight = jQuery(this).parents('section').children('div').children('.measuring-wrapper').height();
		var toggleTest = jQuery(this).parents('section').children('div').css('height');
		if ( toggleTest === '0px' || toggleTest == 0 ) {
			jQuery(this).parents('section').children('div').css( 'height', elementHeight );
			jQuery(this).parents().siblings('section').children('div').css( 'height', '0px' );
		} else {
			jQuery(this).parents('section').children('div').css( 'height', '0px' );
		}
		e.preventDefault();
	});
});
