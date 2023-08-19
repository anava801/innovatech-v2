		<!-- footer -->
		<footer class="footer" role="contentinfo">

			<!-- copyright -->
			<div class="left">
				<?php
					printf( '<p class="copyright">' . __( '&copy; %1$s <strong>INNOVATECH</strong>', 'html5blank' ) . '</p>',
						date( 'Y'),
						esc_html( get_bloginfo( 'name' ) ),
						'//wordpress.org',
						'//html5blank.com'
					);
				?>
				<!-- /copyright -->

				<ul>
					<li><a href="https://www.instagram.com/innova.tech.solutions/" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/InstagramBlack.svg" alt=""></a></li>
					<li><a href="https://www.linkedin.com/company/innovatech-products/" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/LinkedinBlack.svg" alt=""></a></li>
					<li><a href="https://www.youtube.com/@innovatech-ccu" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/YoutubeBlack.svg" alt=""></a></li>
				</ul>
			</div>

			<div class="newsletter">
				<div class="label">Stay Informed</div>
				<?php //gravity_form( 2, false, false, false, '', true ); ?>
				<?php echo apply_shortcodes( '[gravityform id="2" title="false" description="false"  ajax="true"]' ); ?>
			</div>

		</footer>
		<!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-SPM1ZB7KQF"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-SPM1ZB7KQF');
		</script>
		
		<!-- <script>(function(d){var s = d.createElement("script");s.setAttribute("data-account", "G5354E4972");s.setAttribute("src", "https://cdn.userway.org/widget.js");(d.body || d.head).appendChild(s);})(document)</script><noscript>Please ensure Javascript is enabled for purposes of <a href=https://userway.org>website accessibility</a></noscript>
		<style>
			body .uwy.userway_p1 .uai {
				bottom: 13px !important;
				right: auto;
				top: auto !important;
				left: calc(100vw - 21px);
				transform: translate(-100%);
			}
		</style> -->

		<!-- <script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script> -->
	</body>
</html>
