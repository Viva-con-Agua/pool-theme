</div><!-- .content-wrap-wrap -->
</div><!-- .content-wrap -->
</div><!-- .content-container -->
<div class="push"></div>
</div><!-- .wrapper -->

<footer>
	<div class="grid-container">
		<div class="grid-row">
			<div class="col6">
				<p class="screen-talign-left">
					<a title="<?php _e( 'Read the Terms of Use', 'vca-theme' ); ?>" href="<?php bloginfo('url') ?>/nutzungsbedingungen/"><?php _e( 'Terms of Use', 'vca-theme' ); ?></a><br /><span class="nav-break"></span><a title="<?php _e( 'Read the Privacy Policy', 'vca-theme' ); ?>" href="<?php bloginfo('url') ?>/datenschutzerklaerung/"><?php _e( 'Privacy Policy', 'vca-theme' ); ?></a><br /><span class="nav-break"></span><a title="<?php _e( 'To the Imprint', 'vca-theme' ); ?>" href="<?php
						if ( 'ch' === p1_current_country() ) {
							echo 'http://vivaconagua.ch/index.htm?impressum';
						} else {
							echo 'http://vivaconagua.org/index.htm?impressum';
						}
					?>"><?php _e( 'Imprint', 'vca-theme' ); ?></a>
				</p>
			</div><div class="col6 last">
				<p class="screen-talign-right">Pool v1.5, Viva con Agua de Sankt Pauli e.V., 2012-2014</p>
			</div>
		</div>
	</div>
</footer>

<!--<script>window.jQuery || document.write('<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.7.min.js"><\/script>')</script>-->
<script>var jQuery = jQuery.noConflict();</script>

<?php wp_footer(); ?>

<script>
var _gaq=[['_setAccount','UA-32144492-1'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>
</html>