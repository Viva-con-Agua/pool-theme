jQuery(document).ready(function() {
	jQuery('.toggle-wrapper').click(function(e) {
		if ( 'A' !== e.target.nodeName ) {
			jQuery(this).siblings('.toggle-wrapper').removeClass('toggle-element-show');
			jQuery(this).toggleClass('toggle-element-show');
			var elementHeight = jQuery(this).children('div').children('.measuring-wrapper').height();
			var toggleTest = jQuery(this).children('div').css('height');
			if ( toggleTest === '0px' || toggleTest == 0 ) {
				jQuery(this).children('.toggle-element').css( 'height', elementHeight );
				jQuery(this).siblings('.toggle-wrapper').children('.toggle-element').css( 'height', '0px' );
				jQuery(this).find('.toggle-arrows').removeClass('toggle-arrows-more');
				jQuery(this).find('.toggle-arrows').addClass('toggle-arrows-less');
			}
		}
	});
	jQuery('.toggle-wrapper .toggle-link').click(function(e) {
		jQuery(this).parents().siblings('.toggle-wrapper').removeClass('toggle-element-show');
		jQuery(this).parents('.toggle-wrapper').toggleClass('toggle-element-show');
		var elementHeight = jQuery(this).parents('.toggle-wrapper').children('div').children('.measuring-wrapper').height();
		var toggleTest = jQuery(this).parents('.toggle-wrapper').children('div').css('height');
		if ( toggleTest === '0px' || toggleTest == 0 ) {
			jQuery(this).parents('.toggle-wrapper').children('.toggle-element').css( 'height', elementHeight );
			jQuery(this).parents().siblings('.toggle-wrapper').children('.toggle-element').css( 'height', '0px' );
			jQuery(this).parents('.toggle-wrapper').find('.toggle-arrows').removeClass('toggle-arrows-more');
			jQuery(this).parents('.toggle-wrapper').find('.toggle-arrows').addClass('toggle-arrows-less');
		} else {
			jQuery(this).parents('.toggle-wrapper').children('.toggle-element').css( 'height', '0px' );
			jQuery(this).parents('.toggle-wrapper').find('.toggle-arrows').removeClass('toggle-arrows-less');
			jQuery(this).parents('.toggle-wrapper').find('.toggle-arrows').addClass('toggle-arrows-more');
		}
		e.preventDefault();
	});
});
