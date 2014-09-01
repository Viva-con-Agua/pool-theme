<div class="user-panel" id="theme-my-login<?php $template->the_instance(); ?>">

		<h4><?php _e( 'Moin', 'vca-theme' ); ?>,</h4>
		<h2><a title="<?php __( 'Your Profile', 'vca-theme' ) ?>" href="<?php bloginfo( 'url' ) ?>/login/?action=profile"/>
			<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>
		</a></h2>
		<?php $this->the_user_links(); ?>
		<?php do_action_ref_array( 'tml_user_panel', array( $template ) ); ?>

</div>