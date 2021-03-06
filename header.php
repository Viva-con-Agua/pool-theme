<!DOCTYPE html>

<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie ie9 oldie"> <![endif]-->
<!--[if gt IE 9 ]> <html <?php language_attributes(); ?> class="no-js ie ie10"> <![endif]-->
<!--[if !(IE) ]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="Mit dem 'Pool', der VcA Supporterdatenbank, bleibtst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere Festival-Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!" />
	<meta name="keywords" content="Viva con Agua, Sankt Pauli, Trinkwasser, NGO" />
	<!-- open graph | facebook & other social media -->
	<meta property="og:title" content="Viva con Agua Pool" />
	<meta property="og:description" content="Mit dem 'Pool', der VcA Supporterdatenbank, bleibtst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere Festival-Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!" />
	<meta property="og:image" content="<?php echo site_url('', 'https' ); ?>/social-media-icon.png" />
	<meta property="og:url" content="<?php echo site_url('', 'https' ); ?>" />
	<!-- end social media -->
	<?php if( is_search() ) { ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php }?>
	<meta name="robots" content="NOODP" />

	<title><?php wp_title( '|', false, 'left' ); ?></title>

	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/images/icons/apple-touch-icon-precomposed.png">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/icons/favicon.ico" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/icons/favicon.ico" />

	<script type="text/javascript">
		document.write('<style type="text/css">body#flickerfix{opacity:0;}</style>');
	</script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="/dispenser/javascript/dropzone.js"></script>
		<script src="/dispenser/javascript/config.js"></script>
      <link href="/arise/arise.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="/dispenser/css/vca.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/reset.css?ver=2013.11.11.1" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/grid.css?ver=2013.11.11.1" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>?ver=2013.11.18.3" />
<!--	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/animation.css?ver=2013.11.13.1" />-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

	<script type="text/javascript">
		jQuery(function($) {
			jQuery('body#flickerfix').css('opacity','1');
		});
	</script>
	
	<style>
	#adminbar{ display: none; }
	</style>

</head>

<?php flush(); ?>

<body id="flickerfix" <?php body_class(); ?>>

	<div id="wppool">
		<div class="wp-navbar-vca-container">
			<div id="navigation-widget"></div>
			<script type="text/javascript" src="/dispenser/javascript/navigation_widget.js"></script>
		</div>
		<div id="content" class="content-wrap-wrap">
			<div class="content-wrap">
				<?php if ( is_user_logged_in() ) : ?>
					<div class="navigation">
						<nav>
							<?php
								if ( p1_get_admin_link() ) {
									wp_nav_menu( array( 'theme_location' => 'main-nav-admins' ) );
								} else {
									wp_nav_menu( array( 'theme_location' => 'main-nav-supporter' ) );
								}
							?>
						</nav>
					</div>
				<?php endif; ?>
				<div class="grid-container content-container<?php if ( is_user_logged_in() ) echo ' margin-container'; ?>">