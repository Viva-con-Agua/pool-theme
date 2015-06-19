<div class="grid-row">
	<div class="col6">
		<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

			<!-- <h2><?php _ex( 'Login', 'Login Widget Title', 'vca-theme' ); ?></h2> -->

			<?php //$template->the_action_template_message( 'login' ); ?>
			<?php $template->the_errors(); ?>

			<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">

				<div class="form-row">
					<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'vca-theme' ); ?></label>
					<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
				</div>

				<div class="form-row">
					<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'vca-theme' ); ?></label>
					<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
				</div>

				<?php do_action( 'login_form' ); ?>

<!--
				<div class="form-row check-row column-row forgetmenot">
					<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
					<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'vca-theme' ); ?></label>
				</div>
-->

				<div class="form-row">
					<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'vca-theme' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
					<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
					<input type="hidden" name="action" value="login" />
				</div>

			</form>

			<?php $template->the_action_links( array( 'login' => false ) ); ?>

		</div>
	</div>
	<div class="col6 last">
		<h1><?php _e( 'Welcome', 'vca-theme' ); ?></h1>
		<h3><?php _e( '...to our Supporter Pool!', 'vca-theme' ); ?></h3>
		<p><?php _e( 'Via the Pool - our supporter database - you can stay up-to-date about all Viva con Agua news & activities in your region. Also you&apos;ll get know everything about our festivals and can sign up to be a cup hunter/huntress. Viva con Agua is delighted about your support for clean water access worldwide!', 'vca-theme' ); ?></p>
	</div>
</div>