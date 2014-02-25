<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie ie6 oldie"> <![endif]--> 
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie ie7 oldie"> <![endif]--> 
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie ie8 oldie"> <![endif]--> 
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie ie9 oldie"> <![endif]--> 
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]--> 

<head>
	<!-- facebook & other social media -->
	<meta property="og:title" content="Viva con Agua Pool" />
	<meta property="og:description" content="Mit dem 'Pool', der VcA Supporterdatenbank, bleibtst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere Festival-Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!" />
	<meta property="og:image" content="http://pool.vivaconagua.org/social-media-icon.png" />
	<meta property="og:url" content="http://pool.vivaconagua.org" />
	<!-- end social media -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/grid.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<?php flush(); ?>

<body <?php body_class(); ?>>

<div class="bg-side bg-left"></div>
<div class="bg-side bg-right"></div>

	<div class="wrapper">
		<header>
			<div class="top-bar">
				<div class="grid-container">
					<div class="grid-row">
						<div class="col2">
							<a title="<?php __( 'Back to the Start', 'vca-theme' ); ?>" href="<?php bloginfo('url'); ?>">
								<img id="logo" alt="Logo" src="<?php bloginfo('template_url'); ?>/images/logo.png" />
							</a>
						</div><div class="col9 last">
						<?php
							if( is_user_logged_in() )  {
								echo do_shortcode('[theme-my-login show_title=0]');
							}
						?>
						</div>
					</div>
					<?php
						if( is_user_logged_in() )  {
							global $current_user;
							get_currentuserinfo();
								
							echo '<div class="grid-row"><div class="col12"><ul class="vca-user-links"><li>' .
								'<a title="' .
								__( 'Apply for festivals, check your current applications and your accepted festivals', 'vca-theme' ) .
								'" href="' .
								get_bloginfo( 'url' ) .
								'"/>' .
								__( 'Festivals', 'vca-theme' ) .
								'<br /><span>' .
								__( 'Summer 2012', 'vca-theme' ) .
								'</span></a></li>' .
								/*--------------------*/
								'<li>' .		
								'<a title="' .
								__( 'Read up on how this works', 'vca-theme' ) .
								'" href="' .
								get_bloginfo( 'url' ) . '/faq' .
								'"/>' .
								__( 'Help', 'vca-theme' ) .
								'<br /><span>' .
								__( 'FAQ', 'vca-theme' ) .
								'</span></a></li>' .
								/*--------------------*/
								'<li>' .		
								'<a title="' .
								__( 'Set your data & preferences', 'vca-theme' ) .
								'" href="' .
								get_bloginfo( 'url' ) . '/profil' .
								'"/>' .
								__( 'Your Profile', 'vca-theme' ) .
								'<br /><span>' .
								__( 'Settings', 'vca-theme' ) .
								'</span></a></li>';
									
							if( in_array( 'administrator', $current_user->roles ) ||
								in_array( 'content_admin', $current_user->roles ) ||
								in_array( 'activities', $current_user->roles ) ||
								in_array( 'education', $current_user->roles ) ||
								in_array( 'network', $current_user->roles ) ||
								in_array( 'head_of', $current_user->roles ) ) {
								
								echo '<li>' .
									'<a title="' .
									__( 'Manage content of your region', 'vca-theme' ) .
									'" href="' .
									get_bloginfo( 'url' ) . '/wp-admin/' .
									'"/>' .
									__( 'Admin Area', 'vca-theme' ) .
									'<br /><span>' .
									__( 'Manage', 'vca-theme' ) .
									'</span></a></li>';
							}
							echo '</div></div>';
						}
					?>
				</div>
			</div>
		</header>

		<div class="grid-container content-container">