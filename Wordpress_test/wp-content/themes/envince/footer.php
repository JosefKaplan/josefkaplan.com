
	</div><!-- .row -->
		</div><!-- .container -->

			</div><!-- #main -->

		<footer class="site-footer" <?php hybrid_attr( 'footer' ); ?>>

		<?php
		if( is_active_sidebar( 'footer1' ) || is_active_sidebar( 'footer2' ) || is_active_sidebar( 'footer3' ) || is_active_sidebar( 'footer4' ) ) { ?>

			<div class="footer-widget">

					<div class="container">
						<div class="row">

							<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>
						</div>
					</div>

				</div>

		<?php } ?>

			<div class="container">
				<div class="row">

					<div class="footer-menu col-md-6 col-sm-12 pull-right">

						<?php hybrid_get_menu( 'social-footer' ); // Loads the menu/social-footer.php template. ?>

					</div>

					<div class="footer-copyright col-md-6 col-sm-12 pull-left">

						<p class="copyright">
							<?php printf(
								/* Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link. */
								__( 'Copyright &#169; %1$s %2$s. All rights reserved.Theme: %4$s by ThemeGrill. Powered by %3$s', 'envince' ),
								date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
							); ?>
						</p><!-- .copyright -->

					</div>

					<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
				</div>
			</div>

	</footer>

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>
