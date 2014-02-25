<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie ie9 oldie"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="Mit dem 'Pool', der VcA Supporterdatenbank, bleibtst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere Festival-Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!" />
	<meta name="keywords" content="Viva con Agua, Sankt Pauli, Trinkwasser, NGO" />
	<!-- facebook & other social media -->
	<meta property="og:title" content="Viva con Agua Pool" />
	<meta property="og:description" content="Mit dem 'Pool', der VcA Supporterdatenbank, bleibtst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere Festival-Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!" />
	<meta property="og:image" content="<?php echo get_option( 'siteurl' ); ?>/social-media-icon.png" />
	<meta property="og:url" content="<?php echo get_option( 'siteurl' ); ?>" />
	<!-- end social media -->
	<?php if( is_search() ) { ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php }?>
	<meta name="robots" content="NOODP" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-precomposed.png">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/icons/favicon.ico" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/icons/favicon.ico" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/reset.css?ver=1.19" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/grid.css?ver=1.19" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>?ver=1.191" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<?php flush(); ?>

<body <?php body_class(); ?>>

	<div class="wrapper">

		<div class="bg-side bg-left"></div>
		<div class="bg-side bg-right"></div>

		<header>
			<div class="grid-container screen">
				<div class="grid-row">
					<div class="col2">
						<a title="<?php _e( 'Visit the main website', 'vca-theme' ); ?>" href="http://<?php _e( 'vivaconagua.org', 'vca-theme' ); ?>">
							<img id="logo" alt="Logo" src="<?php bloginfo('template_url'); ?>/images/logo.png" />
						</a>
					</div><div class="col3">
					</div><div class="col2">
						<?php if ( is_home() || is_single() || is_post_type_archive( 'post' ) ) : ?>
							<a title="<?php _e( 'All Posts', 'vca-theme' ); ?>" href="<?php bloginfo('url'); ?>">
								<img id="blog-logo" class="center-logo" alt="BLOG" src="<?php bloginfo('template_url'); ?>/images/blog-logo.png" />
							</a>
						<?php else : ?>
							<a title="<?php _e( 'Back to the Start', 'vca-theme' ); ?>" href="<?php bloginfo('url'); ?>">
								<img id="pool-logo" class="center-logo" alt="POOL" src="<?php bloginfo('template_url'); ?>/images/pool-logo.png" />
							</a>
						<?php endif; ?>
					</div><div class="col5 last">
						<?php pille_pool_menu( 'screen' ); ?>
					</div>
				</div>
			</div>
			<div id="swim-in-the-pool" class="grid-container mobile">
				<div class="grid-row mobile-header">
					<div class="col12">
						<p class="site-title"><strong><a title="<?php __( 'vivaconagua.org', 'vca-theme' ); ?>" href="http://vivaconagua.org">Viva con Agua</a></strong><a title="<?php __( 'Back to the Start', 'vca-theme' ); ?>" href="<?php bloginfo('url'); ?>"> Pool</a></p>
						<div id="menu-button"><a href="#nav"><img alt="<?php __( 'Navigation Menu', 'vca-theme' ); ?>" src="<?php bloginfo('template_url'); ?>/images/menu@2x.png" /></a></div>
						<?php pille_pool_menu( 'mobile' ); ?>
					</div>
				</div>
			</div>
			<div class="edge"></div>
		</header>

		<div class="grid-container content-container">