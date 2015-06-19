<div class="grid-row">
	<div class="col6">
		<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

			<?php $template->the_action_template_message( 'lostpassword' ); ?>
			<?php $template->the_errors(); ?>

			<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'lostpassword' ); ?>" method="post">

				<div class="form-row">
					<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username or E-mail:', 'vca-theme' ); ?></label>
					<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
				</div>

				<?php do_action( 'lostpassword_form' ); ?>

				<div class="form-row">
					<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Get New Password', 'vca-theme' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
					<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
					<input type="hidden" name="action" value="lostpassword" />
				</div>

			</form>

			<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>

		</div>
	</div>
	<div class="col6 last">
		<h1><?php _e( 'Welcome', 'vca-theme' ); ?></h1>
		<h3><?php _e( '...to our Supporter Pool!', 'vca-theme' ); ?></h3>
		<p><?php _e( 'Via the Pool - our supporter database - you can stay up-to-date about all Viva con Agua news & activities in your region. Also you&apos;ll get know everything about our festivals and can sign up to be a cup hunter/huntress. Viva con Agua is delighted about your support for clean water access worldwide!', 'vca-theme' ); ?></p>
	</div>
</div>