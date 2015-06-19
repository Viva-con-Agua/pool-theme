<div class="grid-row narrow">
	<div class="col12 last">
		<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

			<?php $template->the_action_template_message( 'resetpass' ); ?>
			<?php $template->the_errors(); ?>

			<form name="resetpasswordform" id="resetpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'resetpass' ); ?>" method="post">

				<div class="form-row">
					<label for="pass1<?php $template->the_instance(); ?>"><?php _e( 'New password', 'vca-theme' ); ?></label>
					<input autocomplete="off" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
				</div>

				<div class="form-row">
					<label for="pass2<?php $template->the_instance(); ?>"><?php _e( 'Confirm new password', 'vca-theme' ); ?></label>
					<input autocomplete="off" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
				</div>

				<div id="pass-strength-result" class="hide-if-no-js"><?php _e( 'Strength indicator', 'vca-theme' ); ?></div>

				<div class="form-row">
					<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'vca-theme' ); ?></p>
				</div>

				<?php do_action( 'resetpassword_form' ); ?>

				<div class="form-row">
					<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Reset Password', 'theme-my-login' ); ?>" />
				</div>

				<input type="hidden" id="user_login" value="<?php echo esc_attr( $GLOBALS['rp_login'] ); ?>" autocomplete="off" />
				<input type="hidden" name="rp_key" value="<?php echo esc_attr( $GLOBALS['rp_key'] ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="resetpass" />

			</form>

			<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>

		</div>
	</div>
</div>