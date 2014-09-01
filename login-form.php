<div class="grid-row"><div class="col6"><div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" class="stand-alone-form" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<h2><?php _ex( 'Login', 'Login Widget Title', 'vca-theme' ); ?></h2>
		<?php $template->the_action_template_message( 'login' );
		if( ! empty( $GLOBALS['vca_asm_login_errors'] ) ) {
			echo $GLOBALS['vca_asm_login_errors'];
			unset( $GLOBALS['vca_asm_login_errors'] );
		} else {
			$template->the_errors();
		} ?>
		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'vca-theme' ) ?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</div><div class="form-row">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'vca-theme' ) ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" />
		</div>
<?php
do_action( 'login_form' ); // Wordpress hook
do_action_ref_array( 'tml_login_form', array( &$template ) ); // TML hook
?>
<!--		<div class="form-row check-row column-row">
			<span class="box-test"></span><input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
			<label for="rememberme<?php $template->the_instance(); ?>"><span class="box"></span><?php _e( 'Remember Me', 'vca-theme' ); ?></label>
		</div>-->
		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( 'Log In', 'vca-theme' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
			<input type="hidden" name="testcookie" value="1" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		</div>
	<ul class="tml-action-links">
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/register"><?php _e( 'Register', 'vca-theme' ) ?></a></li>
		<li><a rel="nofollow" href="<?php bloginfo( 'url' ) ?>/login/?action=lostpassword"><?php _e( 'Lost Password', 'vca-theme' ) ?></a></li>
	</ul>
	</form>
</div>
</div><div class="col6 last">
<h1>Willkommen</h1>
<h3>...in unserem Supporter-Pool!</h3>
<p>Mit dem Pool, unserer Supporterdatenbank, bleibst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere (Festival-) Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!</p>
</div></div>