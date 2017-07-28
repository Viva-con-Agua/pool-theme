<?php
/**
 * The main template file.
 */

get_header(); ?>

			<?php
			/* Run the loop to output the posts.
			 */
			 get_template_part( 'loop', 'index' );
			?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>