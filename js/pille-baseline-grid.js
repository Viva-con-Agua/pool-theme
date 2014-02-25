(function($){ // closure

$(window).resize(function() {
	baselineAdjust();
});

window.onload = onloadFuncs;
function onloadFuncs() {
	baselineAdjust();
}

function baselineAdjust() {
	var viewportWidth = window.outerWidth,
		verticalRhythm = 21; // $('.content-container p').first().css('line-height').substring(-2, 2) * 1;
	$(".content-container img").each(function() {
		var imgHeight = $(this).height();
		if( $(this).parent().is('p') ) {
			var pImgBaselineOffset = ( imgHeight - ( verticalRhythm - ( verticalRhythm / 3 ) ) ) % verticalRhythm;
			if ( pImgBaselineOffset !== 0 ) {
				var imgWidth = $(this).width();
				var resizeRatio = ( imgHeight - pImgBaselineOffset ) / imgHeight;
				$(this).css( 'height', ( imgHeight - pImgBaselineOffset ) );
				$(this).css( 'width', Math.round( imgWidth * resizeRatio ) );
			}
		} else if ( viewportWidth > 767 && $(this).hasClass('baseline-adjustable') ) {
			var imgBaselineOffset = imgHeight % verticalRhythm;
			$(this).css( 'margin-bottom', ( 2 * verticalRhythm - imgBaselineOffset ) + 'px' );
		}
	});
	$('.content-container iframe').each(function() {
		var ifrWidth = $(this).width();
		var ifrHeight = Math.round( ifrWidth / 1.78 );
		$(this).css( 'height', ifrHeight+'px' );
		if ( viewportWidth > 767 ) {
			var ifrBaselineOffset = ( ifrHeight + 6 ) % verticalRhythm; //6 accounts for borders
			$(this).css( 'margin-bottom', ( 2 * verticalRhythm - ifrBaselineOffset ) + 'px' );
		}
	});
	$('.content-container .flexslider').each(function() {
		var sliHeight = $(this).height();
		if ( viewportWidth > 767 ) {
			var sliBaselineOffset = sliHeight % verticalRhythm;
			$(this).css( 'margin-bottom', ( 2 * verticalRhythm - sliBaselineOffset ) + 'px' );
		}
	});
}

})(jQuery); // closure