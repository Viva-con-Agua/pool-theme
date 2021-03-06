<div class="grid-row">
	<div class="col6">
		<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

			<p class="message"><?php _e( 'Register to the Pool', 'vca-theme' )  ?></p>

			<?php //$template->the_action_template_message( 'register' ); ?>
			<?php $template->the_errors(); ?>

			<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">

				<div class="form-row">
					<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'vca-theme' ); ?></label>
					<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
				</div>

				<div class="form-row">
					<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'vca-theme' ); ?></label>
					<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
				</div>

				<div class="form-row pass-row">
					<?php do_action( 'register_form' ); ?>

					<!-- <p id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'A password will be e-mailed to you.', 'theme-my-login' ) ); ?></p> -->
				</div>

				<div class="form-row check-row column-row">
					<span class="box-test"></span><input name="terms_conditions" type="checkbox" id="terms_conditions" value="agreed" />
					<label for="terms_conditions"><span class="box"></span><?php _e( 'I agree to and have read the terms &amp; conditions.', 'vca-theme' ); ?></label>
				</div>

				<div class="form-row">
					<input type="submit" onclick="
							if( ! jQuery('#terms_conditions').is(':checked') ) {
								alert('<?php _e( 'Please confirm that you agree to the terms &amp; conditions.', 'vca-theme' ); ?>');
								return false;
							}
					" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'vca-theme' ); ?>" />
				</div>

				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="register" />

			</form>

			<?php $template->the_action_links( array( 'register' => false ) ); ?>

		</div>
	</div>
	<div class="col6 last">
		<h1><?php _e( 'Welcome', 'vca-theme' ); ?></h1>
		<h3><?php _e( '...to our Supporter Pool!', 'vca-theme' ); ?></h3>
		<p><?php _e( 'Via the Pool - our supporter database - you can stay up-to-date about all Viva con Agua news & activities in your region. Also you&apos;ll get know everything about our festivals and can sign up to be a cup hunter/huntress. Viva con Agua is delighted about your support for clean water access worldwide!', 'vca-theme' ); ?></p>
	</div>
</div>