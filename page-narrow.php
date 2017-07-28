<?php
/**
 * Template Name: Narrow (Titled)
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

	echo '<div class="narrow"><div class="col12">';
	if ( is_front_page() ) {
		echo '<h2 class="heading">' . get_the_title() . '</h2>';
	} else {
		echo '<h1>' . get_the_title() . '</h1>';	
	}
	echo '</div></div>';

	the_content();
	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) );

endwhile;

get_footer();
?>