<div class="grid-row"><div class="col6">
<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'lostpassword' ); ?>
	<?php $template->the_errors(); ?>
	<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" class="stand-alone-form" action="<?php $template->the_action_url( 'lostpassword' ); ?>" method="post">
		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username or E-mail:', 'vca-theme' ) ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>

		<?php do_action( 'lostpassword_form' ); ?>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Get New Password', 'vca-theme' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</div>
		<?php //$template->the_action_links( array( 'lostpassword' => false ) ); ?>
	<ul class="tml-action-links">
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/login"><?php _e( 'Login', 'vca-theme' ) ?></a></li>
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/register"><?php _e( 'Register', 'vca-theme' ) ?></a></li>
	</ul>
	</form>
</div>
</div><div class="col6 last">
<h1>Willkommen</h1>
<h3>...in unserem Supporter-Pool!</h3>
<p>Mit dem Pool, unserer Supporterdatenbank, bleibst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere (Festival-) Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!</p>
</div></div>