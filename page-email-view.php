<?php
/**
 * Template Name: Email
 *
 * @todo move into shortcode, this isn't theme territory!
 */

global $current_user, $wpdb, $vca_asm_geography;

$message_placeholder = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer turpis lacus, posuere id porttitor et, ultrices a nisl. In euismod, tortor nec aliquam sodales, dolor turpis tincidunt neque, sed pharetra tellus mauris vitae erat. In ut convallis tellus. Nunc porttitor luctus sem, in varius eros cursus nec. Etiam in purus quam. Curabitur eleifend facilisis orci quis cursus. Fusce consectetur urna quis nulla pharetra ac suscipit eros accumsan. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus quis leo nisi, quis dignissim leo. Aliquam ullamcorper metus semper urna rhoncus imperdiet. Morbi elementum orci enim, et fermentum lacus.</p><p>Nam vulputate neque at urna porta scelerisque. Morbi sollicitudin leo sed tellus vestibulum facilisis. Praesent eleifend nunc et enim semper eu porta lorem consectetur. Sed lacinia pharetra ultricies. Fusce rutrum, dolor quis suscipit mattis, dui erat dapibus eros, at consequat elit nisl sit amet dolor. Nulla non suscipit sapien. Donec sollicitudin lacus at risus scelerisque dignissim. Nullam tristique tincidunt metus non porttitor. Etiam egestas arcu et enim euismod lacinia. Donec rhoncus iaculis arcu vitae pellentesque.</p><p>Fusce porta leo dictum eros tempor varius. Donec magna nibh, condimentum quis mollis vel, laoreet quis magna. Cras sit amet dolor eu est rhoncus consequat. Morbi vel porta mauris. Donec pretium metus sed velit ultricies mattis. Vivamus euismod dolor non risus bibendum viverra. Pellentesque ut elit at enim tempus iaculis. Donec varius lobortis metus, in dignissim odio lobortis in. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quis mi ligula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
$subject_placeholder = 'Newsletter';
$pool_link = '<a onclick="preventIt(event)" title="' . __( 'To the Pool!', 'vca-theme' ) . '" href="' . get_option( 'siteurl' ) . '">' . __( 'Pool', 'vca-theme' ) . '</a>';
if( isset( $_POST['receipient'] ) && 'act' === substr( $_POST['receipient'], 0, 3 ) ) {
	$reason = str_replace( '%POOL%', $pool_link, __( 'You are getting this message because are registered to the %POOL% and have applied to or are participating in an activity.', 'vca-theme' ) );
} else {
	$reason = str_replace( '%POOL%', $pool_link, __( 'You are getting this message because are registered to the %POOL% and have chosen to receive newsletters.<br />You can change your newsletter preferences on your &quot;Profile &amp; Settings&quot; page.', 'vca-theme' ) );
}
$message_append = '<hr style="margin-top:0;margin-right:0;margin-bottom:21px;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;"><p style="margin-top:0;margin-right:0;margin-bottom:21px;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:13px;line-height:21px;font-family:Verdana,Geneva,Arial,Helvetica,sans-serif;">' .
		__( 'Is this email not easily readable or otherwise obscured?', 'vca-theme' ) . '<br />' .
		'<a onclick="preventIt(event)" title="' . __( 'Read the mail in your browser', 'vca-theme' ) . '" href="' . get_option( 'siteurl' ) . '/email">' .
			__( 'Read it in your browser.', 'vca-theme' ) .
		'</a>' .
	'</p><p style="margin-top:0;margin-right:0;margin-bottom:21px;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:13px;line-height:21px;font-family:Verdana,Geneva,Arial,Helvetica,sans-serif;">' .
		$reason .
	'</p>';

if( isset( $_POST['mail_submit'] ) && __( 'Preview', 'vca-theme' ) === $_POST['mail_submit'] ) {
	$subject = empty( $_POST['subject'] ) ? $subject_placeholder :  $_POST['subject'];
	$message = empty( $_POST['message'] ) ? $message_placeholder . $message_append :  $_POST['message'] . $message_append;
	$time = time();
	if( ! in_array( 'city', $current_user->roles ) && ! in_array( 'head_of', $current_user->roles ) ) {
		$from = trim( $current_user->first_name . ' ' . $current_user->last_name );
		$mail_nation = $vca_asm_geography->get_alpha_code( get_user_meta( $current_user->ID, 'nation', true ) );
	} else {
		$region_id = get_user_meta( $current_user->ID, 'region', true );
		$region_name = $vca_asm_geography->get_name( $region_id );
		$from = $vca_asm_geography->get_status( $region_id ) . ' ' . $region_name;
		$mail_nation = $vca_asm_geography->get_alpha_code( get_user_meta( $current_user->ID, 'nation', true ) );
	}
	if( 2 == $_POST['membership'] ) {
		if ( ! empty( $_POST['receipient'] ) && is_numeric( $_POST['receipient'] ) ) {
			$for = sprintf( __( 'Active Members from %s', 'vca-theme' ), $vca_asm_geography->get_name( $_POST['receipient'] ) );
		} else {
			$for = __( 'Active Members', 'vca-theme' );
		}
	} elseif( 'act' === substr( $_POST['receipient'], 0, 3 ) ) {
		$name = get_the_title( substr( $_POST['receipient'], 7 ) );
		$name = empty( $name ) ? __( 'Activity', 'vca-theme' ) : $name;
		if( 'app' === substr( $_POST['receipient'], 3, 3 ) ) {
			$for = sprintf( __( 'Applicants to &quot;%s&quot;', 'vca-theme' ), $name );
		} elseif( 'part' === substr( $_POST['receipient'], 3, 4 ) ) {
			$for = sprintf( __( 'Participants of &quot;%s&quot;', 'vca-theme' ), $name );
		} elseif( 'wait' == substr( $_POST['receipient'], 3, 4 ) ) {
			$for = sprintf( __( 'Waiting List of &quot;%s&quot;', 'vca-theme' ), $name );
		}
	} elseif( 'single' == substr( $_POST['receipient'], 0, 6 ) ) {
		$for = trim( get_user_meta( substr( $_POST['receipient'], 6 ), 'first_name', true ) . ' ' . get_user_meta( substr( $_POST['receipient'], 6 ), 'last_name', true ) );
		$for = empty( $for ) ? __( 'Single Supporter', 'vca-theme' ) : $for;
	} elseif( 'tm' == $_POST['receipient'] ) {
		$for = __( 'Test E-Mail', 'vca-theme' );
	} elseif( 'admins' == $_POST['receipient'] ) {
		$for = __( 'Office / Administrators', 'vca-theme' );
	} elseif( 'ho' == $_POST['receipient'] ) {
		$for = __( 'All Head Ofs', 'vca-theme' );
	} elseif( ! empty( $_POST['receipient'] ) && is_numeric( $_POST['receipient'] ) ) {
		$for = sprintf( __( 'Supporters from %s', 'vca-theme' ), $vca_asm_geography->get_name( $_POST['receipient'] ) );
	} else {
		$for = __( 'Supporters', 'vca-theme' );
	}
} elseif ( isset( $_GET['id'] ) ) {
	$email_query = $wpdb->get_results(
		"SELECT id, subject, message, time, sent_by, receipient_group, receipient_id FROM " . $wpdb->prefix."vca_asm_emails" .
		" WHERE id = " . $_GET['id'] . " LIMIT 1", ARRAY_A
	);
	$email = ! empty( $email_query ) ? $email_query[0] : array();

	$sender_nation = $vca_asm_geography->has_nation( get_user_meta( $email['sent_by'], 'region', true ) );
	if ( $sender_nation ) {
		$mail_nation = $vca_asm_geography->get_alpha_code( $sender_nation );
	} else {
		$mail_nation = 'de';
	}

	if(
			$current_user->has_cap( 'vca_asm_view_emails_global' ) ||
	   (
			$current_user->has_cap( 'vca_asm_view_emails_nation' ) &&
			$vca_asm_geography->has_nation( get_user_meta( $current_user->ID, 'region', true ) ) &&
			$sender_nation &&
			$sender_nation === $vca_asm_geography->has_nation( get_user_meta( $current_user->ID, 'region', true ) )
		) ||
		(
			$current_user->has_cap( 'vca_asm_view_emails' ) && $current_user->ID == $email['sent_by']
		) ||
			md5( $email['time'] ) == $_GET['hash'] ||
			$email['id'] == 1
	) {
		$message = empty( $email['message'] ) ? $message_placeholder : $email['message'];
		$subject = empty( $email['subject'] ) ? $subject_placeholder : $email['subject'];
		$time = empty( $email['time'] ) ? time() : $email['time'];
		$from = empty( $email['sent_by'] ) ? 'Viva con Agua' : $email['sent_by'];
		if( is_numeric( $from ) ) {
			$user = new WP_User( $email['sent_by'] );
			if( ! in_array( 'city', $user->roles ) ) {
				$from = trim( $user->first_name . ' ' . $user->last_name );
			} else {
				$region_id = get_user_meta( $user->ID, 'region', true );
				$region_name = $vca_asm_geography->get_name( $region_id );
				$from = $vca_asm_geography->get_status( $region_id ) . ' ' . $region_name;
			}
		}
		if( isset( $email['membership'] ) && 2 == $email['membership'] ) {
			if ( 'region' == $email['receipient_group'] ) {
				$for = sprintf( __( 'Active Members from %s', 'vca-theme' ), $vca_asm_geography->get_name( $email['receipient_id'] ) );
			} else {
				$for = __( 'Active Members', 'vca-theme' );
			}
		} elseif( 'applicants' === $email['receipient_group'] ||
			'waiting' === $email['receipient_group'] ||
			'participants' === $email['receipient_group']
		) {
			$name = get_the_title( $email['receipient_id'] );
			$name = empty( $name ) ? __( 'Activity', 'vca-theme' ) : $name;
			if( 'app' === substr( $_POST['receipient'], 3, 3 ) ) {
				$for = sprintf( __( 'Applicants to &quot;%s&quot;', 'vca-theme' ), $name );
			} elseif( 'part' === substr( $_POST['receipient'], 3, 4 ) ) {
				$for = sprintf( __( 'Participants of &quot;%s&quot;', 'vca-theme' ), $name );
			} elseif( 'wait' == substr( $_POST['receipient'], 3, 4 ) ) {
				$for = sprintf( __( 'Waiting List of &quot;%s&quot;', 'vca-theme' ), $name );
			}
		} elseif( 'single' == $email['receipient_group'] ) {
			$for = trim( get_user_meta( $email['receipient_id'], 'first_name', true ) . ' ' . get_user_meta( $email['receipient_id'], 'last_name', true ) );
			$for = empty( $for ) ? __( 'Single Supporter', 'vca-theme' ) : $for;
		} elseif( 'self' == $email['receipient_group'] ) {
			$for = __( 'Test E-Mail', 'vca-theme' );
		} elseif( 'admins' == $email['receipient_group'] ) {
			$for = __( 'Office / Administrators', 'vca-theme' );
		} elseif( 'ho' == $email['receipient_group'] ) {
			$for = __( 'All Head Ofs', 'vca-theme' );
		} elseif( 'region' == $email['receipient_group'] ) {
			$for = sprintf( __( 'Supporters from %s', 'vca-theme' ), $vca_asm_geography->get_name( $email['receipient_id'] ) );
		} else {
			$for = __( 'Supporters', 'vca-theme' );
		}
	} else {
		$message = $message_placeholder;
		$subject = $subject_placeholder;
		$time = time();
		$from = 'Viva con Agua';
		$for = __( 'Supporter', 'vca-theme' );
	}
} else {
	$message = $message_placeholder;
	$subject = $subject_placeholder;
	$time = time();
	$from = 'Viva con Agua';
	$for = __( 'Supporter', 'vca-theme' );
	$mail_nation = 'de';
}

if ( ! isset( $mail_nation ) || ! is_string( $mail_nation ) || ! in_array( $mail_nation, array( 'ch', 'at' ) ) ) {
	$mail_nation = 'de';
}

switch ( $mail_nation ) {
	case 'ch':
		$logo = 'logo-ch@2x.gif';
		$link_url = 'http://' . _x( 'vivaconagua.ch', 'utility translation', 'vca-asm' );
		$organization_title = __( 'Viva con Agua Switzerland', 'vca-asm' );
	break;

	case 'at':
		$logo = 'logo@2x.gif';
		$link_url = 'http://' . _x( 'vivaconagua.org', 'utility translation', 'vca-asm' );
		$organization_title = __( 'Viva con Agua de Sankt Pauli e.V.', 'vca-asm' );
	break;

	case 'de':
	default:
		$logo = 'logo@2x.gif';
		$link_url = 'http://' . _x( 'vivaconagua.org', 'utility translation', 'vca-asm' );
		$organization_title = __( 'Viva con Agua de Sankt Pauli e.V.', 'vca-asm' );
	break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $subject; ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/reset.css?ver=1.2" />
		<style>
			html {
				width: 100% !important;
				height: 100% !important;
			}
			body {
				-webkit-tap-highlight-color: rgba(226,0,122,.5);
				-webkit-text-size-adjust: none;
				-ms-text-size-adjust: none;
				width: 100% !important;
				height: 100% !important;
				position: relative;
			}
			.wrapper {
				max-width: 1200px;
				min-height: 500px !important;
				height: 100% !important;
				margin: 0 auto;
				position: relative;
			}
			h1.subject {
				font-size: 2.8em;
				line-height: 1.5;
				margin: 0;
				padding: 0;
				position: absolute;
				top: 42px;
				left: 42px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-weight: bold;
				color: #00586c;
			}
			.message-wrapper {
				-webkit-overflow-scrolling: touch;
				overflow-y: scroll;
				padding: 0;
				margin: 126px 42px 46px 42px;
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				border: 2px solid #00586c;
			}
			.message-wrapper > * {
				-webkit-transform: translateZ(0px);
			}
			p {
				font-size: 14px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				line-height: 1.5;
				margin: 0 0 21px;
			}
			a {
				color: inherit;
				text-decoration: none;
			}
			p a {
				border-bottom: 1px dotted #008fc1;
			}
			.footer a {
				border-bottom: none;
			}
			a:hover,
			a:active,
			a:focus,
			a:hover span,
			a:active span,
			a:focus span,
			a:active span span,
			a:hover span span,
			a:focus span span {
				color: #008fc1;
				text-shadow: 0 0 1px #008fc1;
				border-bottom: 1px dotted #e2007a;
			}
			.header a:active,
			.header a:hover,
			.header a:focus,
			.header a:active span,
			.header a:hover span,
			.header a:focus span,
			.header a:active span span,
			.header a:hover span span,
			.header a:focus span span,
			.footer a:hover,
			.footer a:active,
			.footer a:focus,
			.footer a:hover span,
			.footer a:active span,
			.footer a:focus span,
			.footer a:active span span,
			.footer a:hover span span,
			.footer a:focus span span {
				color: #ffffff;
				text-shadow: 0 0 1px #f1e6cc;
				border-bottom: none;
			}
			.header a:active img,
			.header a:hover img,
			.header a:focus img {
				opacity:0.8;
				filter:alpha(opacity=80);
			}
			::-moz-selection {
				background: #c4e3f0;
				color: #00586c;
				text-shadow: none;
			}
			::selection {
				background: #c4e3f0;
				color: #00586c;
				text-shadow: none;
			}
			@media handheld, only screen and (max-width: 600px) {
				.mobile-hide {
					display: none;
					visibility: hidden;
				}
				.message-wrapper {
					margin: 84px 21px 21px 21px;
				}
				h1.subject {
					font-size: 1.8em;
					line-height: 1.166667;
					top: 21px;
					left: 21px;
				}
			}
			@media handheld, only screen and (max-width: 399px) {
				.mobile-legacy-hide {
					display: none;
					visibility: hidden;
				}
				.header-left[style] {
					padding-top: 12px;
					padding-bottom: 7px;
					padding-left: 12px;
				}
				.header-center[style] {
					padding-top: 12px;
					padding-bottom: 7px;
				}
				.header-right[style] {
					padding-top: 12px;
					padding-bottom: 7px;
					padding-right: 12px;
				}
				.message[style] {
					padding-left: 12px;
					padding-right: 12px;
				}
				.message-wrapper {
					margin: 75px 12px 12px 12px;
				}
				h1.subject {
					top: 12px;
					left: 12px;
				}
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<h1 class="subject"><?php _ex( 'Subject', 'E-Mail', 'vca-theme' ); echo ': ' . $subject; ?></h1>
			<div class="message-wrapper">
				<?php
				$lf = '';
				echo '<table cellspacing="0" border="0" width="100%" style="height:100% !important;width:100% !important;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;"><tbody>' . $lf .
						'<tr>' . $lf .
						'<td valign="top" align="center" bgcolor="#00A8CF" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;background-color:#00a8cf;border-collapse:collapse;vertical-align:top;" class="header">' .
						'<table cellspacing="0" border="0" width="100%" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;background:-moz-linear-gradient(top, #008fc1 0%, #00a8cf 100%);background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#008fc1), color-stop(100%,#00a8cf));background:-webkit-linear-gradient(top, #008fc1 0%,#00a8cf 100%);background:-o-linear-gradient(top, #008fc1 0%,#00a8cf 100%);background:-ms-linear-gradient(top, #008fc1 0%,#00a8cf 100%);background:linear-gradient(to bottom, #008fc1 0%,#00a8cf 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#008fc1\',endColorstr=\'#00a8cf\',GradientType=0);"><tbody>' .
						'<tr>' .
						'<td class="header-left" width="33%" valign="bottom" style="width:33%;text-align:left;padding-top:21px;padding-right:0;padding-bottom:16px;padding-left:21px;border-collapse:collapse;vertical-align:bottom;">' .
							'<p style="font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;color:#ffffff;font-size:13px;line-height:1.230769231;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">' .
								_x( 'from', 'Newsletter', 'vca-theme' ) . ': ' . $from . '<br />' .
								_x( 'to', 'Newsletter', 'vca-theme' ) . ': ' . $for . '<br />' .
								strftime( '%e. %B %G', $time ) .
							'</p>' .
						'</td>' .
						'<td class="header-center mobile-hide" width="34%" valign="middle" style="width:34%;text-align:center;padding-top:21px;padding-right:0;padding-bottom:16px;padding-left:0;border-collapse:collapse;vertical-align:middle;">' .
							'<h1 style="display:block;color:#ffffff;font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;font-weight:bold;font-size:30px;line-height:1;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;"><span style="font-family:\'Gill Sans Condensed\',\'Gill Sans MT Condensed\',\'Gill Sans\',\'Gill Sans MT\',Verdana,Helvetica,Arial,sans-serif;"><img alt="NEWS" src="' . get_option( 'siteurl' ) . '/email_assets/news-logo@2x.gif" align="middle" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;display:block;vertical-align:middle;" height="36" width="153"></span></h1>' .
						'</td>' .
						'<td class="header-right mobile-legacy-hide" width="33%" valign="baseline" style="width:33%;text-align:right;padding-top:21px;padding-right:21px;padding-bottom:16px;padding-left:0;border-collapse:collapse;vertical-align:baseline;">' .
							'<a title="' . __( 'Visit the Viva con Agua website', 'vca-theme' ) . '" href="' . $link_url . '"><h1 style="display:block;color:#ffffff;font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;font-weight:bold;font-size:42px;line-height:1;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;"><span style="font-family:\'Gill Sans Condensed\',\'Gill Sans MT Condensed\',\'Gill Sans\',\'Gill Sans MT\',Verdana,Helvetica,Arial,sans-serif;"><img alt="VcA" src="' . get_option( 'siteurl' ) . '/email_assets/' . $logo . '" align="right" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;display:block;" height="79" width="153"></span></h1></a>' .
						'</td>' .
						'</tr>' .
						'</tbody></table>' .
						'</td>' . $lf .
						'</tr>' . $lf .
						'<!--[if !(mso)]><!--><tr>' . $lf .
						'<td valign="top" align="center" style="min-height:0px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;border-collapse:collapse;vertical-align:top;">' .
							'<div style="width:100%;height:42px;background-image:url(' . get_option( 'siteurl' ) . '/email_assets/edge-top.png);background-repeat:repeat-x;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;">&nbsp;</div>' .
						'</td>' . $lf .
						'</tr><!--<![endif]-->' . $lf .
						'<tr>' . $lf .
						'<td valign="middle" align="center" style="height:80%;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:center;border-collapse:collapse;vertical-align:middle;">' .
							'<table cellspacing="0" border="0" style="display:block;max-width:800px;margin:42px auto 21px;padding-top:0;padding-right:21px;padding-bottom:0;padding-left:21px;"><tbody><tr><td valign="middle" style="max-width:800px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;border-collapse:collapse;">' .
								$message .
							'</td></tr></tbody></table>' .
						'</td>' . $lf .
						'</tr>' . $lf .
						'<!--[if !(mso)]><!--><tr>' . $lf .
						'<td valign="bottom" align="center" style="min-height:0px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;border-collapse:collapse;vertical-align:bottom;">' .
							'<div style="width:100%;height:42px;background-image:url(' . get_option( 'siteurl' ) . '/email_assets/edge-bottom.png);background-reoeat:repeat-x;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;">&nbsp;</div>' .
						'</td>' . $lf .
						'</tr><!--<![endif]-->' . $lf .
						'<tr>' . $lf .
						'<td valign="bottom" align="center" bgcolor="#00A8CF" style="background-color:#00a8cf;text-align:center;border-collapse:collapse;vertical-align:bottom;" class="footer">' .
						'<div style="width:100%;height:auto;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:center;background:-moz-linear-gradient(top, #00a8cf 0%, #008fc1 100%);background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#00a8cf), color-stop(100%,#008fc1));background:-webkit-linear-gradient(top, #00a8cf 0%,#008fc1 100%);background:-o-linear-gradient(top, #00a8cf 0%,#008fc1 100%);background:-ms-linear-gradient(top, #00a8cf 0%,#008fc1 100%);background: linear-gradient(to bottom, #00a8cf 0%,#008fc1 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#00a8cf\',endColorstr=\'#008fc1\',GradientType=0 );">' .
						'<p style="color:#ffffff;font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;font-size:14px;line-height:1;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:21px;padding-right:21px;padding-bottom:21px;padding-left:21px;"><a title="' . __( 'Visit the Viva con Agua website', 'vca-theme' ) . '" href="' . $link_url . '" style="color:#ffffff;font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;font-size:14px;line-height:1;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-decoration:none;"><span style="color:#ffffff;font-family:Verdana,Geneva,Helvetica,Arial,sans-serif;font-size:14px;line-height:1;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-decoration:none;"><span style="font-family:\'Gill Sans Condensed\',\'Gill Sans MT Condensed\',\'Gill Sans\',\'Gill Sans MT\',Verdana,Helvetica,Arial,sans-serif;">' . $organization_title . '</span></a></span></p>' .
						'</div>' .
						'</td>' . $lf .
						'</tr>' . $lf .
					'</tbody></table>';
				?>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function preventIt(e) {
			e.preventDefault();
			alert( '<?php _e( 'These links do not work in Preview-Mode.', 'vca-theme' ) ?>' );
		 }
	</script>
	</html>