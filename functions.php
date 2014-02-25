<?php

/* THEME ESSENTIALS
----------------------------------------- */

/* load theme textdomain */
function pille_theme_setup(){
	load_theme_textdomain('vca-theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'pille_theme_setup');

/* loads scripts & libraries */
function pille_theme_load_scripts() {
	if ( ! is_admin() ) {
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2' );
		wp_enqueue_script( 'modernizr' );
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false, '1.7.1' );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'mediaqueries', get_template_directory_uri() . '/js/css3-mediaqueries.js', false, false, true );
		wp_enqueue_script( 'mediaqueries' );
		wp_register_script( 'pille-plugins', get_template_directory_uri() . '/js/plugins.js', false, false, true );
		wp_enqueue_script( 'pille-plugins' );
		wp_register_script( 'pille-accordion', get_template_directory_uri() . '/js/pille-accordion.js', false, false, true );
		wp_enqueue_script( 'pille-accordion' );
		wp_register_script( 'pille-baseline-grid', get_template_directory_uri() . '/js/pille-baseline-grid.js', false, false, true );
		wp_enqueue_script( 'pille-baseline-grid' );
		wp_register_script( 'pille-form-styling', get_template_directory_uri() . '/js/pille-form-styling.js', false, false, true );
		wp_enqueue_script( 'pille-form-styling' );
		wp_register_script( 'pille-tooltip', get_template_directory_uri() . '/js/pille-tooltip.js', false, false, true );
		wp_enqueue_script( 'pille-tooltip' );
		wp_register_script( 'pille-toggle', get_template_directory_uri() . '/js/pille-toggle-element.js', false, false, true );
		wp_enqueue_script( 'pille-toggle' );
	}
}
add_action ( 'init', 'pille_theme_load_scripts' );

/* Add native menu support */
/* --- currently not in use ---
if ( function_exists( 'register_nav_menus' ) ) {
	function pille_theme_register_menus() {
		register_nav_menus(
			array(
			'menu-main' => __( 'Main Navigation' ),
			'menu-xtra' => __( 'Extra Menu' )
			)
		);
	}
	add_action( 'init', 'pille_theme_register_menus' );
}
*/

/* Register widgetized areas */
function pille_theme_widgets_init() {

}
add_action( 'widgets_init', 'pille_theme_widgets_init' );



/* WORDPRESS FIXES
----------------------------------------- */

/* disable automatic formatting */
remove_filter ( 'the_content',  'wpautop' );
remove_filter ( 'the_excerpt',  'wpautop' );

/* selectively disable the visual editor */
function pille_theme_disable_visual_editor_on_pages( $setting ) {
	global $post_type, $current_user;

	if ( 'page' === $post_type && in_array( 'administrator', $current_user->roles ) )
		return false;
	return $setting;
}
add_filter( 'user_can_richedit', 'pille_theme_disable_visual_editor_on_pages');

/* Sets the post excerpt length to 40 characters */
function pille_theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'pille_theme_excerpt_length' );

/* Returns a "Continue Reading" link for excerpts */
function pille_theme_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vca-theme' ) . '</a>';
}

/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link() */
function pille_theme_auto_excerpt_more( $more ) {
	return ' &hellip;' . pille_theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'pille_theme_auto_excerpt_more' );

/* Adds a pretty "Continue Reading" link to custom post excerpts */
function pille_theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= pille_theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'pille_theme_custom_excerpt_more' );

/* Security fix (hides wp version in html head element) */
remove_action('wp_head', 'wp_generator');

/* remove pings to self */
function pille_theme_no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, $home ) )
			unset($links[$l]);
}
add_action( 'pre_ping', 'pille_theme_no_self_ping' );

/* Disable outdated browser notice */
function pille_theme_no_browser_nag() {
	$key = md5( $_SERVER['HTTP_USER_AGENT'] );
	add_filter( 'site_transient_browser_' . $key, 'pille_theme_return_null' );
}
function pille_theme_return_null() {
	return null;
}
add_action( 'admin_init', 'pille_theme_no_browser_nag' );

/* custom options page with truly all wp settings showing*/
function pille_theme_all_settings_link() {
	add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'pille_theme_all_settings_link');

/* disable the wordpress global admin bar for logged-in users */
function pille_disable_admin_bar() {
	remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );
	function remove_admin_bar_style_backend() {
	  echo '<style>html.wp-toolbar, body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
	}
	add_filter('admin_head','remove_admin_bar_style_backend');


	function remove_admin_bar_style_frontend() { // css override for the frontend
		echo '<style type="text/css" media="screen">
			html { margin-top: 0px !important; }
			* html body { margin-top: 0px !important; }
			</style>';
	}
	add_filter( 'wp_head', 'remove_admin_bar_style_frontend', 99);
}
add_action( 'init', 'pille_disable_admin_bar' );
remove_action( 'init', '_wp_admin_bar_init');

/* Modify default wordpress footer */
function pille_theme_admin_footer() {
    echo '<span id="footer-thankyou">Developed by <a href="mailto:johannes@pilkahn.org">Pille</a>';
}
function pille_theme_footer_version() {
    return '<strong>Version 1.19_beta-2</strong>';
}
add_filter('admin_footer_text', 'pille_theme_admin_footer');
add_filter( 'update_footer', 'pille_theme_footer_version', 11 );

/* Kick users with the role "supporter" from the backend when accessed with a direct link */
function redirect_supporters_from_dash() {
	global $current_user;
	get_currentuserinfo();

	if (  in_array( 'supporter', $current_user->roles ) ) {
		header( 'Location: http://pool.vivaconagua.org' );
	}
}
add_action( 'admin_init', 'redirect_supporters_from_dash');

/* Remove the "Dashboard" from the admin menu for non-admin users */
function pille_remove_dashboard () {
	global $current_user, $menu, $submenu;
	get_currentuserinfo();

	if( ! in_array( 'administrator', $current_user->roles ) ) {
        reset( $menu );
		$page = key( $menu );
        while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
            $page = key( $menu );
        }
        if( __( 'Dashboard' ) == $menu[$page][0] ) {
			unset( $menu[$page] );
		}
        reset($menu);
		$page = key($menu);
        while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
                $page = key( $menu );
        }
        if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) && ( 'index.php' != $menu[$page][2] ) ) {
                wp_redirect( get_option( 'siteurl' ) . '/wp-admin/admin.php?page=vca-asm-home');
        }
	}
}
add_action('admin_menu', 'pille_remove_dashboard');

/* Other admin UI fixes */
function pille_admin_ui_fixes() {
	global $current_user, $menu, $submenu;
	get_currentuserinfo();

	if( ! in_array( 'administrator', $current_user->roles ) ) {
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
		remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
		remove_menu_page('edit.php');
		remove_menu_page('profile.php');
		remove_menu_page('edit-comments.php');
		remove_menu_page('link-manager.php');
		remove_menu_page('sfa-admins');
		remove_menu_page('tools.php');
		remove_menu_page('upload.php');

		function remove_admin_menu_sep() {
			echo '<style>.wp-menu-separator { display:none !important; }</style>';
		}
		add_filter('admin_head','remove_admin_menu_sep');
	}
}
add_action('admin_menu', 'pille_admin_ui_fixes');



/* SHORTCODES, 12-COLUMN GRID
----------------------------------------- */

/* add shortcode [fullrow]...[/fullrow] for adding a 12 column wide one-block row */
function pille_theme_sc_full_row( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'class' => '',
		'rowclass' => '',
	), $atts ) );
	$content = do_shortcode( $content );
	if ( ! empty( $class ) && ! empty( $rowclass ) )
		return '<div class="grid-row ' . $rowclass . '"><div class="col12 ' . $class . '">' . $content . '</div></div>';
	elseif (! empty( $rowclass ) )
		return '<div class="grid-row ' . $rowclass . '"><div class="col12">' . $content . '</div></div>';
	elseif( ! empty( $class ) )
		return '<div class="grid-row"><div class="col12 ' . $class . '">' . $content . '</div></div>';
	else
		return '<div class="grid-row"><div class="col12">' . $content . '</div></div>';
}
add_shortcode( 'fullrow', 'pille_theme_sc_full_row' );

/* add shortcode [fblock]...[/fblock] for adding the first block of a row */
function pille_theme_sc_first_block( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'cols' => 3,
		'class' => '',
		'rowclass' => '',
	), $atts ) );
	$content = do_shortcode( $content );
	if( ! empty( $class ) && ! empty( $rowclass ) )
		return '<div class="grid-row ' . $rowclass . '"><div class="grid-block col' . $cols . ' ' . $class . '">' . $content . '</div>';
	elseif( ! empty( $rowclass ) )
		return '<div class="grid-row ' . $rowclass . '"><div class="col' . $cols . '">' . $content . '</div>';
	elseif( ! empty( $class ) )
		return '<div class="grid-row"><div class="col' . $cols . ' ' . $class . '">' . $content . '</div>';
	else
		return '<div class="grid-row"><div class="col' . $cols . '">' . $content . '</div>';
}
add_shortcode( 'fblock', 'pille_theme_sc_first_block' );

/* add shortcode [mblock]...[/mblock] for adding blocks in the middle of a row */
function pille_theme_sc_middle_block( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'cols' => 6,
		'class' => ''
	), $atts ) );
	$content = do_shortcode( $content );
	if(!empty( $class ))
		return '<div class="col' . $cols . ' ' . $class. '">' . $content . '</div>';
	else
		return '<div class="col' . $cols . '">' . $content . '</div>';
}
add_shortcode( 'mblock', 'pille_theme_sc_middle_block' );

/* add shortcode [lblock]...[/lblock] for adding the last block of a row */
function pille_theme_sc_last_block( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'cols' => 3,
		'class' => ''
	), $atts ) );
	$content = do_shortcode( $content );
	if( ! empty( $class ) )
		return '<div class="col' . $cols . ' ' . $class . ' last">' . $content . '</div></div>';
	else
		return '<div class="col' . $cols . ' last">' . $content . '</div></div>';
}
add_shortcode( 'lblock', 'pille_theme_sc_last_block' );

/* add shortcode [narrow]...[/narrow] for adding a (max.) 600px wide one-block row */
function pille_theme_sc_narrow( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'class' => '',
		'rowclass' => '',
	), $atts ) );
	$content = do_shortcode( $content );
	if ( ! empty( $class ) && ! empty( $rowclass ) )
		return '<div class="narrow ' . $rowclass . '"><div class="col12 ' . $class . '">' . $content . '</div></div>';
	elseif (! empty( $rowclass ) )
		return '<div class="narrow ' . $rowclass . '"><div class="col12">' . $content . '</div></div>';
	elseif( ! empty( $class ) )
		return '<div class="narrow"><div class="col12 ' . $class . '">' . $content . '</div></div>';
	else
		return '<div class="narrow"><div class="col12">' . $content . '</div></div>';
}
add_shortcode( 'narrow', 'pille_theme_sc_narrow' );



/* SHORTCODES TO INITIATE ACCORDION
----------------------------------------- */

/* add shortcode [accordion]...[/accordion] */
function pille_theme_create_accordion( $atts, $content='' ) {
	$content = do_shortcode( $content );
	return '<div class="accordion">' . $content . '</div>';
}
add_shortcode( 'accordion', 'pille_theme_create_accordion' );

/* add shortcode [accsection num="x" title="x"]...[/accsection] */
function pille_theme_create_accordion_section( $atts, $content='' ) {
	extract( shortcode_atts( array(
		'num' => 1,
		'title' => 'You forgot the title!',
	), $atts ) );
	$content = do_shortcode( $content );
	return '<section id="section' .
		$num .
		'"><p class="pointer">&#9654;</p><h5><a href="#section' .
		$num .
		'">' .
		$title .
		'</a></h5><div class="acc-body"><div class="measuring-wrapper">' .
		$content .
		'</div></div></section>';
}
add_shortcode( 'accsection', 'pille_theme_create_accordion_section' );



/* MISCELLANEOUS SHORTCODES
----------------------------------------- */

/* add shortcode [bloginfo] for bloginfo functions within a page or post */
function pille_theme_sc_bloginfo( $atts ) {
   extract( shortcode_atts( array(
	   'key' => ''
   ), $atts ) );
   return get_bloginfo( $key );
}
add_shortcode('bloginfo', 'pille_theme_sc_bloginfo');

/* add shortcode [logged-in]...[/logged-in] to enclose content only visible to logged in users */
function pille_theme_sc_logged_in( $atts, $content='' ) {
	$content = do_shortcode( $content );
	if( is_user_logged_in() ) {
		return $content;
	} else {
		return '';
	}
}
add_shortcode('logged-in', 'pille_theme_sc_logged_in');

/* add shortcode [logged-out]...[/logged-out] to enclose content only visible to guests and logged out users */
function pille_theme_sc_logged_out( $atts, $content='' ) {
	$content = do_shortcode( $content );
	if( is_user_logged_in() ) {
		return '';
	} else {
		return $content;
	}
}
add_shortcode('logged-out', 'pille_theme_sc_logged_out');

/* add shortcode [youtube] for inserting a youtube video */
function pille_theme_sc_youtube( $atts ) {
	extract( shortcode_atts( array(
		'id' => '',
		'width' => 346,
		'height' => 313
	), $atts ) );
	if( ! empty( $id ) )
		return '<div class="shrink-wrap"><iframe class="shrink" width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe></div>';
	else
		return ' ';
}
add_shortcode( 'youtube', 'pille_theme_sc_youtube' );



/* REDIRECTS (DEPRECATED)
----------------------------------------- */

function pille_pool_uri_fixes() {
	$page_uri = $_SERVER["REQUEST_URI"];
	$page_uri_sub = substr( $page_uri, 0, 24 );

	if( $page_uri_sub == '/?action=login&instance=' && is_home() ) {
		if( isset( $template ) ) {
			$GLOBALS['pille_asm_login_errors'] = $template->get_errors;
		}
		$redirect_url = 'http://pool.vivaconagua.org/login/';
		wp_redirect( $redirect_url, 302 );
		exit;
	}
}
add_action( 'wp_head', 'pille_pool_uri_fixes' );



/* COMMENT & POST META FUNCTIONS FROM TWENTY_TEN
 *
 * @todo replace with custom code
 *
----------------------------------------- */

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 */
function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );

if ( ! function_exists( 'twentyten_comment' ) ) :
/* Template for comments and pingbacks */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/* Removes the default styles that are packaged with the Recent Comments widget. */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/* Prints HTML with meta information for the current post—date/time and author */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/* Prints HTML with meta information for the current post (category, tags and permalink) */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;



/* FIX FOR F*CKING "MAGIC" (yeah right, my ass) QUOTES
----------------------------------------- */

if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}