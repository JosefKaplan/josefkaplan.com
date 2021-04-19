<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package purea-magazine
 */

?>
	</div>
	<!-- Begin Footer Section -->
	<footer id="footer">
		<div class="container">
			<?php
				if ( has_nav_menu( 'footer' ) ) {
					?>
						<div class="footer-menu">
							<div class="footer-menu-wrapper">
								<?php
									wp_nav_menu( array(                         
	                                'theme_location'    => 'footer',
	                                'depth'             => 2,
	                                'container'         => 'ul',
	                                'container_class'   => 'navigation',
	                                'container_id'      => 'menu-footer',
	                                'menu_class'        => 'navigation',
	                                ));
								?>
							</div>
						</div>
					<?php
				}
			?>
			<div class="row">
				<div class="footer-widgets-wrapper">
	                	<?php get_sidebar( 'footer' ); ?>
	            </div>
	        </div>
	        <?php
		        /**
		         * Hook - purea_magazine_action_footer.
		         *
		         * @hooked purea_magazine_footer_copyrights - 10
		         */
		        do_action( 'purea_magazine_action_footer' );
	        ?>
	    </div>
    </footer>
	<?php wp_footer(); ?>
</body>
</html>