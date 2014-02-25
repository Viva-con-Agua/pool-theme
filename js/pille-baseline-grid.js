jQuery(window).resize(function() {
	baselineAdjust();
});

window.onload = onloadFuncs;
function onloadFuncs() {
	baselineAdjust();
}

function baselineAdjust() {
	var viewportWidth = window.outerWidth;
	var verticalRhythm = ( jQuery('.content-container p').first().css('line-height').substring(-2, 2) * 1 );
	jQuery(".content-container img").each(function() {
		var imgHeight = jQuery(this).height();
		if( jQuery(this).parent().is('p') ) {
			var pImgBaselineOffset = ( imgHeight - ( verticalRhythm - ( verticalRhythm / 3 ) ) ) % verticalRhythm;
			if ( pImgBaselineOffset !== 0 ) {
				var imgWidth = jQuery(this).width();
				var resizeRatio = ( imgHeight - pImgBaselineOffset ) / imgHeight;
				jQuery(this).css( 'height', ( imgHeight - pImgBaselineOffset ) );
				jQuery(this).css( 'width', Math.round( imgWidth * resizeRatio ) );
			}
		} else if ( viewportWidth > 767 && ! jQuery(this).parents().is('.flexslider') ) {
			var imgBaselineOffset = imgHeight % verticalRhythm;
			jQuery(this).css( 'margin-bottom', ( 2 * verticalRhythm - imgBaselineOffset ) + 'px' );
		}
	});
	jQuery('.content-container iframe').each(function() {
		var ifrWidth = jQuery(this).width();
		var ifrHeight = Math.round( ifrWidth / 1.78 );
		jQuery(this).css( 'height', ifrHeight+'px' );
		if ( viewportWidth > 767 ) {
			var ifrBaselineOffset = ( ifrHeight + 6 ) % verticalRhythm; //6 accounts for borders
			jQuery(this).css( 'margin-bottom', ( 2 * verticalRhythm - ifrBaselineOffset ) + 'px' );
		}
	});
	jQuery('.content-container .flexslider').each(function() {
		var sliHeight = jQuery(this).height();
		if ( viewportWidth > 767 ) {
			var sliBaselineOffset = sliHeight % verticalRhythm;
			jQuery(this).css( 'margin-bottom', ( 2 * verticalRhythm - sliBaselineOffset ) + 'px' );
		}
	});
}
