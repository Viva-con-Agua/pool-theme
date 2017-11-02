<style>
    .membership-agreement-button {
        width: 550px;
    }
    .membership-agreement-accept {
        #color: green !important;
    }
    .membership-agreement-decline {
        #color: red !important;
    }
</style>
<div class="login profile grid-row" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">
		<div class="col12">
			<div class="island island-cut-off">

				<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
				<input type="hidden" name="from" value="profile" />
				<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
                <input type="hidden" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" />
                <input type="hidden" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" />

				<h2>Aktualisierung der Mitgliedschaft</h2>

                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

                <input class="membership-agreement-button membership-agreement-accept" type="submit" value="Mitgliedschaft zustimmen" name="vca-membership-accept" id="vca-membership-accept"/>
                <input class="membership-agreement-button membership-agreement-decline" type="submit" value="Mitgliedschaft ablehnen" name="vca-membership-decline" id="vca-membership-decline"/>
                <br/>
                <br/>

			</div>
		</div>
	</form>
</div>
<?php get_footer(); ?>