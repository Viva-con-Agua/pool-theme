<div class="login island island-cut-off" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'resetpass' ); ?>
	<?php $template->the_errors(); ?>
	<form name="resetpasswordform" id="resetpasswordform<?php $template->the_instance(); ?>" class="stand-alone-form" action="<?php $template->the_action_url( 'resetpass' ); ?>" method="post">
		<div class="form-row">
			<label for="pass1<?php $template->the_instance(); ?>"><?php _e( 'New password', 'theme-my-login' );?></label>
			<input autocomplete="off" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
		</div><div class="form-row">
			<label for="pass2<?php $template->the_instance(); ?>"><?php _e( 'Confirm new password', 'theme-my-login' );?></label>
			<input autocomplete="off" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
		</div><div class="form-row">
			<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', 'theme-my-login' ); ?></div>
		</div><div class="form-row">
		<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'vca-theme' ); ?></p>
		</div>
<?php
do_action( 'resetpassword_form' ); // Wordpress hook
do_action_ref_array( 'tml_resetpassword_form', array( $template ) ); // TML hook
?>
		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Reset Password', 'theme-my-login' ); ?>" />
			<input type="hidden" name="key" value="<?php $template->the_posted_value( 'key' ); ?>" />
			<input type="hidden" name="login" id="user_login" value="<?php $template->the_posted_value( 'login' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		</div>
	<?php //$template->the_action_links( array( 'lostpassword' => false ) ); ?>
	<ul class="tml-action-links">
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/login"><?php _e( 'Login', 'vca-theme' ) ?></a></li>
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/register"><?php _e( 'Register', 'vca-theme' ) ?></a></li>
	</ul>
	</form>
</div>