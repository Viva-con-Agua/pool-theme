<?php

$GLOBALS['current_user'] = $current_user = wp_get_current_user();
$GLOBALS['profileuser'] = $profileuser = get_user_to_edit( $current_user->ID );

$user_can_edit = false;
foreach ( array( 'posts', 'pages' ) as $post_cap ) {
	$user_can_edit |= current_user_can( "edit_$post_cap" );
}

global $current_user;
get_currentuserinfo();

if( ( is_array( $current_user->roles ) && in_array( 'head_of', $current_user->roles ) ) || ( ! is_array( $current_user->roles ) && 'head_of' == $current_user->roles ) ) {
	$head_of_switch = true;
	$disable_field = ' disabled="disabled"';
} else {
	$head_of_switch = false;
	$disable_field = '';
}
?>

<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" class="stand-alone-form" action="" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ) ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		<?php do_action( 'personal_options', $profileuser ); ?>
		<?php do_action( 'profile_personal_options', $profileuser ); ?>
		
		<h2><?php _e( 'Supporter Profile', 'vca-theme' ) ?></h2>
		
		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>		

		<h3><?php _e( 'Name', 'theme-my-login' ) ?></h3>

		<div class="form-row">
			<label for="user_login"><?php _e( 'Username', 'theme-my-login' ); ?> <span class="tip" onmouseover="tooltip('<?php _e( 'Your username cannot be changed.', 'vca-theme' ); ?>');" onmouseout="exit();">?</span></label>
			<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" />
		</div><div class="form-row">
			<label for="first_name"><?php _e( 'First name', 'theme-my-login' ) ?></label>
			<input type="text" name="first_name" id="first_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" />
		</div><div class="form-row">
			<label for="last_name"><?php _e( 'Last name', 'theme-my-login' ) ?></label>
			<input type="text" name="last_name" id="last_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" />
		</div>
		
		<!--<div class="form-row">
			<label for="nickname"><?php //_e( 'Nickname', 'theme-my-login' ); ?> <span class="description"><?php //_e( '(required)', 'theme-my-login' ); ?></span></label>
			<input type="text" name="nickname" id="nickname" value="<?php //echo esc_attr( $profileuser->nickname ) ?>" class="regular-text" />
		</div>
		<div class="form-row">		
			<label for="display_name"><?php //_e( 'Display name publicly as', 'theme-my-login' ) ?></label>
			<select name="display_name" id="display_name">
				<?php /*
					$public_display = array();
					$public_display['display_nickname']  = $profileuser->nickname;
					$public_display['display_username']  = $profileuser->user_login;
					if ( !empty( $profileuser->first_name ) )
						$public_display['display_firstname'] = $profileuser->first_name;
					if ( !empty( $profileuser->last_name ) )
						$public_display['display_lastname'] = $profileuser->last_name;
					if ( !empty( $profileuser->first_name ) && !empty( $profileuser->last_name ) ) {
						$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
						$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
					}
					if ( !in_array( $profileuser->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
						$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
					$public_display = array_map( 'trim', $public_display );
					foreach ( $public_display as $id => $item ) {
						$selected = ( $profileuser->display_name == $item ) ? ' selected="selected"' : '';
				?>
						<option id="<?php echo $id; ?>" value="<?php echo esc_attr( $item ); ?>"<?php echo $selected; ?>><?php echo $item; ?></option>
				<?php } */ ?>
				</select>
		</div>-->

		<h3><?php _e( 'Contact Info', 'theme-my-login' ) ?></h3>

		<div class="form-row">
			<label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
			<input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" />
		</div>
		
		<?php
			do_action( 'show_user_profile', $profileuser );
		?>
		
		<?php
		$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
		if ( $show_password_fields ) :
		?>
			<h3><?php _e( 'New Password', 'theme-my-login' ); ?></h3>
			<div class="form-row">
				<p class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'vca-theme' ); ?></p>
				<label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?> <span class="tip" onmouseover="tooltip('<?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols.', 'vca-theme' ); ?>');" onmouseout="exit();">?</span></label>
				<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" />
			</div><div class="form-row">
				<label for="pass1"><?php _e( 'Repeat Password', 'vca-theme' ); ?></label>
				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" />
			</div><div class="form-row">
				<div id="pass-strength-result"><?php _e( 'Strength indicator', 'theme-my-login' ); ?></div>
			</div>
		<?php endif; ?>
		<?php if( ! isset( $head_of_switch ) || $head_of_switch === false ) { ?>
		<div class="form-row check-row column-row">
			<span class="box-test"></span><input name="deleteme" type="checkbox" id="deleteme" value="forever" />
			<label for="deleteme" class="warning"><span class="box"></span><?php _e( 'Delete my account permanently', 'vca-theme' ); ?></label>
		</div>
		<?php } ?>
		<div class="form-row">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" onclick="
				if( jQuery('#deleteme').is(':checked') ) {
					if( confirm('<?php _e( "Do you really want to delete your account? This will be permanent and cannot be undone!", 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#region').val() == 'please_select' ) {
					alert('<?php _e( 'Please select a region. Thank you.', 'vca-theme' ); ?>');
					return false;
				} else if( jQuery('#birthday-year').val() <= <?php echo( (intval(date('Y')) - 100) ); ?> ) {
					if( confirm('<?php _e( 'Are you really a hundred years old???.', 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#birthday-year').val() == 1970 && jQuery('#birthday-month').val() == 1 && jQuery('#birthday-day').val() == 1 ) {
					if( confirm('<?php _e( 'Have you really been born on January 1st, 1970?.', 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				}
			" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" />
		</div>
	</form>
</div>
