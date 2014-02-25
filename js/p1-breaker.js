jQuery(window).load(function() {
	jQuery('.break-heading').each( function() {
		var titleWidth = jQuery(this).find('h2').width();
		var titleHeight = jQuery(this).find('.grid-block').height();
		var rowWidth = jQuery(this).find('.grid-block').width();
		var lineWidth = ( ( rowWidth - titleWidth ) / 2 ) - 21;
		var lineHeight = Math.floor( titleHeight / 2 );
		var beforeElement = '<span class="break-span" style="width:' + lineWidth + 'px;height:' + lineHeight + 'px;float:left;"></span>';
		var afterElement = '<span class="break-span" style="width:' + lineWidth + 'px;height:' + lineHeight + 'px;float:right;"></span>';
		jQuery(this).find('h2').before(beforeElement);
		jQuery(this).find('h2').after(afterElement);
	});
});

jQuery(window).resize(function() {
	jQuery('.break-heading').each( function() {
		var titleWidth = jQuery(this).find('h2').width();
		var titleHeight = jQuery(this).find('.grid-block').height();
		var rowWidth = jQuery(this).find('.grid-block').width();
		var lineWidth = ( ( rowWidth - titleWidth ) / 2 ) - 21;
		var lineHeight = Math.floor( titleHeight / 2 );
		jQuery(this).find('.break-span').css( 'width', lineWidth );
		jQuery(this).find('.break-span').css( 'height', lineHeight );
	});
});