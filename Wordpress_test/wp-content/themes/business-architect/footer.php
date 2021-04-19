<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after
 * 
 */
?>
</div> <!--end of site content-->

		<footer id="colophon" class="site-footer footer-text" role="contentinfo" >
		
		<div class="container">
		<div class="row">
		
		<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'business-architect' ); ?>">
			<?php
			if ( is_active_sidebar( 'footer-sidebar-1' ) ) {
			?>
				<div class="col-md-3 col-sm-3 footer-widget">
					<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
				</div>
			<?php
			}
			if ( is_active_sidebar( 'footer-sidebar-2' ) ) {
			?>
				<div class="col-md-3 col-sm-3 footer-widget">
					<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				</div>			
			<?php
			}
			if ( is_active_sidebar( 'footer-sidebar-3' ) ) {
			?>
				<div class="col-md-3 col-sm-3 footer-widget">
					<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				</div>
			<?php
			}
			if ( is_active_sidebar( 'footer-sidebar-4' ) ) {
			?>
				<div class="col-md-3 col-sm-3 footer-widget">
					<?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
				</div>
			<?php }	?>
		</aside><!-- .widget-area -->
		
		</div>
		
		<div class="row footer-info vertical-center">

			<div class="<?php if ( has_nav_menu( 'social' ) ) { echo 'col-md-6 col-sm-6';} else {echo 'col-md-12 col-sm-12';} ?>">
				<div class="site-info">
						<div><a href="http://wpbusinessthemes.com"><?php echo esc_html(get_theme_mod('footer_text', esc_html__('Theme: By Theme Space','business-architect')) ); ?></a></div>
				</div><!-- .site-info -->
			</div>
					
			<?php if ( has_nav_menu( 'social' ) ) : ?>
			<div class="col-md-6 col-sm-6 footer-social-menu">		
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'business-architect' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								)
							);
						?>
					</nav><!-- .social-navigation -->
							
			</div>
			<?php endif; ?>
			
			</div>
		</div>	
		<a href="#" class="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->
</div><!-- box layout style-->
<?php wp_footer(); ?>
</body>
</html>
