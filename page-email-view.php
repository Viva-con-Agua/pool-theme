<?php
/**
 * Template Name: Email
 *
 * @todo move into shortcode, this isn't theme territory! (half done, was worse)
 * (hint: http://wordpress.stackexchange.com/questions/3396/create-custom-page-templates-with-plugins)
 */

global $current_user, $wpdb,
	$vca_asm_geography, $vca_asm_mailer, $vca_asm_utilities;

function pool_email_view_scripts() {
	wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'pool_email_view_scripts' );

$message_placeholder = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer turpis lacus, posuere id porttitor et, ultrices a nisl. In euismod, tortor nec aliquam sodales, dolor turpis tincidunt neque, sed pharetra tellus mauris vitae erat. In ut convallis tellus. Nunc porttitor luctus sem, in varius eros cursus nec. Etiam in purus quam. Curabitur eleifend facilisis orci quis cursus. Fusce consectetur urna quis nulla pharetra ac suscipit eros accumsan. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus quis leo nisi, quis dignissim leo. Aliquam ullamcorper metus semper urna rhoncus imperdiet. Morbi elementum orci enim, et fermentum lacus.</p><p>Nam vulputate neque at urna porta scelerisque. Morbi sollicitudin leo sed tellus vestibulum facilisis. Praesent eleifend nunc et enim semper eu porta lorem consectetur. Sed lacinia pharetra ultricies. Fusce rutrum, dolor quis suscipit mattis, dui erat dapibus eros, at consequat elit nisl sit amet dolor. Nulla non suscipit sapien. Donec sollicitudin lacus at risus scelerisque dignissim. Nullam tristique tincidunt metus non porttitor. Etiam egestas arcu et enim euismod lacinia. Donec rhoncus iaculis arcu vitae pellentesque.</p><p>Fusce porta leo dictum eros tempor varius. Donec magna nibh, condimentum quis mollis vel, laoreet quis magna. Cras sit amet dolor eu est rhoncus consequat. Morbi vel porta mauris. Donec pretium metus sed velit ultricies mattis. Vivamus euismod dolor non risus bibendum viverra. Pellentesque ut elit at enim tempus iaculis. Donec varius lobortis metus, in dignissim odio lobortis in. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quis mi ligula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
$subject_placeholder = 'Newsletter';

if( isset( $_POST['mail_submit'] ) && __( 'Preview', 'vca-theme' ) === $_POST['mail_submit'] ) {

	$subject = empty( $_POST['subject'] ) ? $subject_placeholder : $_POST['subject'];
	$message = empty( $_POST['message'] ) ? $message_placeholder : $_POST['message'];

	$time = time();
	if ( ! in_array( 'city', $current_user->roles ) ) {
		$from = trim( $current_user->first_name . ' ' . $current_user->last_name );
		$mail_nation = $vca_asm_geography->get_alpha_code( get_user_meta( $current_user->ID, 'nation', true ) );
	} else {
		$city_id = get_user_meta( $current_user->ID, 'city', true );
		$city_name = $vca_asm_geography->get_name( $city_id );
		$from = $vca_asm_geography->get_status( $city_id ) . ' ' . $city_name;
		$mail_nation = $vca_asm_geography->get_alpha_code( get_user_meta( $current_user->ID, 'nation', true ) );
	}

	$_POST['receipient'];
	$membership = isset( $_POST['membership'] ) ? $_POST['membership'] : 0;
	$receipient_group = $_POST['receipient-group'];
	$receipient_id = $vca_asm_mailer->receipient_id_from_group( $receipient_group, false );
	$for = $vca_asm_mailer->determine_for_field( $receipient_group, $receipient_id, $membership );
	$type = isset( $_POST['mail_type'] ) ? $_POST['mail_type'] : 'newsletter';

} elseif ( isset( $_GET['id'] ) ) {

	if ( isset( $_GET['auto_action'] ) && in_array( $_GET['auto_action'], array( 'applied', 'accepted', 'denied', 'reg_revoked', 'mem_accepted', 'mem_denied', 'mem_cancelled' ) ) ) {
		$email_query = $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . "vca_asm_auto_responses " .
			"WHERE action = '" . $_GET['auto_action'] . "' LIMIT 1", ARRAY_A
		);
		$email = ! empty( $email_query ) ? $email_query[0] : array();
		if ( empty( $email ) ) {
			$email = $vca_asm_mailer->default_responses[$_GET['auto_action']];
		}
		if ( in_array( $_GET['auto_action'], array( 'applied', 'accepted', 'denied', 'reg_revoked' ) ) ) {
			$email['type'] = 'activity';
			$replacement = get_the_title( $_GET['id'] );
			$replacement = ! empty( $replacement ) ? $replacement : __( 'Activity', 'vca-theme' );
		} else {
			$email['type'] = 'membership';
			$replacement = $vca_asm_geography->get_name( $_GET['id'] );
			$replacement = ! empty( $replacement ) ? $replacement : __( 'Your city', 'vca-theme' );
		}
		if ( ! empty( $_GET['uid'] ) ) {
			$the_user = new WP_User( intval( $_GET['uid'] ) );
			$first_name = isset( $the_user->first_name ) ? $the_user->first_name : '';
			$last_name = isset( $the_user->last_name ) ? $the_user->last_name : '';
			if( ! empty( $first_name ) && ! empty( $last_name ) ) {
				$name = $first_name . " " . $last_name;
			} elseif( ! empty( $first_name ) ) {
				$name = $first_name;
			} elseif( ! empty( $last_name ) ) {
				$name = $last_name;
			} else {
				$name = __( 'Supporter', 'vca-theme' );
			}
		} else {
			$name = __( 'Supporter', 'vca-theme' );
		}
		$placeholders = array( '%event%', '%region%', '%name%' );
		$replacements = array( $replacement, $replacement, $name );

		$email['subject'] = str_replace( $placeholders, $replacements, $email['subject'] );
		$email['message'] = str_replace( $placeholders, $replacements, $email['message'] );

		$email['message'] = '<p>' .
				preg_replace( '#(<br */?>\s*){2,}#i', '<br><br>' , preg_replace( '/[\r|\n]/', '<br>' , $vca_asm_utilities->urls_to_links( $email['message'] ) ) ) .
			'</p>';
	} else {
		$email_query = $wpdb->get_results(
			"SELECT id, subject, message, time, sent_by, receipient_group, receipient_id, type FROM " . $wpdb->prefix."vca_asm_emails" .
			" WHERE id = " . $_GET['id'] . " LIMIT 1", ARRAY_A
		);
		$email = ! empty( $email_query ) ? $email_query[0] : array();
	}
	$email['sent_by'] = isset( $email['sent_by'] ) ? $email['sent_by'] : 0;
	$email['membership'] = isset( $email['membership'] ) ? $email['membership'] : 0;
	$email['receipient_id'] = isset( $email['receipient_id'] ) ? $email['receipient_id'] : 0;
	$email['receipient_group'] = isset( $email['receipient_group'] ) ? $email['receipient_group'] : 0;

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
			md5( $email['time'] ) == $_GET['hash']
		||
		(
			isset( $_GET['auto_action'] ) && in_array( $_GET['auto_action'], array( 'applied', 'accepted', 'denied', 'reg_revoked', 'mem_accepted', 'mem_denied', 'mem_cancelled' ) )
		)
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
				$city_id = get_user_meta( $user->ID, 'region', true );
				$city_name = $vca_asm_geography->get_name( $city_id );
				$from = $vca_asm_geography->get_status( $city_id ) . ' ' . $city_name;
			}
		}
		$for = isset( $_GET['auto_action'] ) ? $name : $vca_asm_mailer->determine_for_field( $email['receipient_group'], $email['receipient_id'], $email['membership'] );
		$type = empty( $email['type'] ) ? 'newsletter' : $email['type'];
	} else {
		$message = $message_placeholder;
		$subject = $subject_placeholder;
		$time = time();
		$from = 'Viva con Agua';
		$for = __( 'Supporter', 'vca-theme' );
		$type = 'newsletter';
	}

} else {

	$message = $message_placeholder;
	$subject = $subject_placeholder;
	$time = time();
	$from = 'Viva con Agua';
	$for = __( 'Supporter', 'vca-theme' );
	$mail_nation = 'de';
	$type = 'newsletter';
}

$template = new VCA_ASM_Email_Html( array(
	'mail_id' => 1,
	'message' => $message,
	'subject' => $subject,
	'reason' => $type,
	'from_name' => $from,
	'time' => $time,
	'mail_nation' => $mail_nation,
	'for' => $for,
	'in_browser' => true
));

echo $template->output();