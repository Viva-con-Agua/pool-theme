jQuery(document).ready(function() {
	jQuery('.toggle-wrapper').click(function(e) {
		if ( 'A' !== e.target.nodeName ) {
			var toggleWrapper = jQuery(this);
			jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper').not(this).removeClass('toggle-element-show');
			jQuery(this).parents('div.activities-container').find('div.activity').removeClass('activity-open');
			var elementHeight = jQuery(this).children('div').children('.measuring-wrapper').height();
			var toggleTest = jQuery(this).children('.toggle-element').css('height');
			if ( toggleTest === '0px' || toggleTest == 0 ) {
				jQuery(this).children('.toggle-element').css( 'height', elementHeight );
				jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper').not(this).children('.toggle-element').css( 'height', '0px' );
				jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper').not(this).find('.toggle-arrows').removeClass('toggle-arrows-less');
				jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper').not(this).find('.toggle-arrows').addClass('toggle-arrows-more');
				jQuery(this).find('.toggle-arrows').removeClass('toggle-arrows-more');
				jQuery(this).find('.toggle-arrows').addClass('toggle-arrows-less');
				jQuery(this).addClass('toggle-element-show');
				jQuery(this).closest('div.activity').addClass('activity-open');
			}
			if( 0 < jQuery(this).closest('div.activity').length ) {
				setTimeout( function() {
						jQuery('div.activities-container').isotope();
					},
					600
				);
				if ( toggleTest === '0px' || toggleTest == 0 ) {
					setTimeout( function() {
							var theOffset = toggleWrapper.offset(),
								filterContainerHeight = jQuery('div.filter-container').height();
							var scrollPosition = theOffset.top - filterContainerHeight;
							jQuery.scrollTo( scrollPosition+'px', 500 );
						},
						1000
					)
				}
			}
		}
	});
	jQuery('.toggle-wrapper .toggle-link').click(function(e) {
		var toggleWrapper = jQuery(this).parents('.toggle-wrapper');
		jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper .toggle-link').not(this).parents('.toggle-wrapper').removeClass('toggle-element-show');
		jQuery(this).parents('div.activities-container').find('div.activity').removeClass('activity-open');
		var elementHeight = jQuery(this).parents('.toggle-wrapper').children('div').children('.measuring-wrapper').height();
		var toggleTest = jQuery(this).parents('.toggle-wrapper').children('.toggle-element').css('height');
		if ( toggleTest === '0px' || toggleTest == 0 ) {
			jQuery(this).parents('.toggle-wrapper').children('.toggle-element').css( 'height', elementHeight );
			jQuery(this).parents('.toggle-list-wrapper').find('.toggle-wrapper .toggle-link').not(this).parents('.toggle-wrapper').children('.toggle-element').css( 'height', '0px' );
			toggleWrapper.find('.toggle-arrows').removeClass('toggle-arrows-more');
			toggleWrapper.find('.toggle-arrows').addClass('toggle-arrows-less');
			toggleWrapper.addClass('toggle-element-show');
			jQuery(this).closest('div.activity').addClass('activity-open');
		} else {
			toggleWrapper.children('.toggle-element').css( 'height', '' );
			toggleWrapper.find('.toggle-arrows').removeClass('toggle-arrows-less');
			toggleWrapper.find('.toggle-arrows').addClass('toggle-arrows-more');
			toggleWrapper.removeClass('toggle-element-show');
			jQuery(this).closest('div.activity').removeClass('activity-open');
		}
		if( 0 < jQuery(this).closest('div.activity').length ) {
			setTimeout( function() {
					jQuery('div.activities-container').isotope();
				},
				600
			);
			if ( toggleTest === '0px' || toggleTest == 0 ) {
				setTimeout( function() {
						var theOffset = toggleWrapper.offset(),
							filterContainerHeight = jQuery('div.filter-container').height();
						var scrollPosition = theOffset.top - filterContainerHeight;
						jQuery.scrollTo( scrollPosition+'px', 500 );
					},
					1000
				)
			}
		}
		e.preventDefault();
	});
});
