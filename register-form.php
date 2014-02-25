<div class="grid-row"><div class="col6">
<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

	<p class="message"><?php _e( 'Register to the Pool', 'vca-theme' )  ?></p>
	<?php $template->the_errors(); ?>

    <form name="registerform" id="registerform<?php $template->the_instance(); ?>" class="stand-alone-form" action="<?php $template->the_action_url( 'register' ); ?>" method="post">

		<div class="form-row">
            <label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ) ?></label>
            <input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div><div class="form-row">
            <label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ) ?></label>
            <input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
        </div><div class="form-row pass-row">
<?php
do_action( 'register_form' ); // Wordpress hook
do_action_ref_array( 'tml_register_form', array( &$template ) ); //TML hook
?>
		</div><div class="form-row check-row column-row">
			<span class="box-test"></span><input name="terms_conditions" type="checkbox" id="terms_conditions" value="agreed" />
			<label for="terms_conditions"><span class="box"></span><?php _e( 'I agree to and have read the terms &amp; conditions.', 'vca-theme' ); ?></label>
		</div><div class="form-row">
			<input type="submit" onclick="
				if( ! jQuery('#terms_conditions').is(':checked') ) {
					alert('<?php _e( 'Please confirm that you agree to the terms &amp; conditions.', 'vca-theme' ); ?>');
					return false;
				}
			" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( 'Register', 'theme-my-login' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		</div>
	<?php $template->the_action_links( array( 'register' => false ) ); ?>
    </form>
</div>
</div><div class="col6 last">
<h1>Willkommen</h1>
<h3>...in unserem Supporter-Pool!</h3>
<p>Mit dem Pool, unserer Supporterdatenbank, bleibst du über Viva con Agua Neuigkeiten und Aktivitäten in deiner Region auf dem laufenden. Ausserdem erfährst du alles über unsere (Festival-) Aktivitäten und kannst dich z.B. als Becherjäger_in bewerben – Viva con Agua freut sich auf dich und dein Engagement für sauberes Trinkwasser und sanitäre Versorgung weltweit!</p>
</div></div>