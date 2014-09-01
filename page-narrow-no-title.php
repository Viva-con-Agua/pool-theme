<?php
/**
 * Template Name: Narrow (No Title)
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

	the_content();
	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) );

endwhile;

get_footer();
?>