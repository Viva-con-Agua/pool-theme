<?php
/**
 * Template Name: Fuck around
 */

get_header();

?>

<style>
	#sticky-shit {
		z-index: 9999;
		width: 100%;
		height: 100px;
		background: #000;
		position: fixed;
		top: 10px;
	}
</style>

<div id="sticky-shit"></div>

<?php

if ( have_posts() ) while ( have_posts() ) : the_post();

	the_content();
	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) );

endwhile;

get_footer();
?>