<?php 
$business_architect_email= get_theme_mod('header_email', '');
$business_architect_address= get_theme_mod('header_address', '');
$business_architect_tel= get_theme_mod('header_telephone', '');

if ($business_architect_email !='' || $business_architect_address !='' || $business_architect_tel !='' || (has_nav_menu( 'social' )) )  {
?>
<div class="contact-ribbon col-xs-12">
 <div class="container">
	<div class="row">
	
		<div class="col-sm-8 contact-info-container">
		
			<div class="contact-info">

			  	<?php if($business_architect_tel): ?>
			  	<span class="phone">
				<i class="fa fa-phone"></i>				
				<span><?php echo esc_html($business_architect_tel); ?></span>
				</span>	
				<?php endif; ?>

			  	<?php if($business_architect_address): ?>
			  	<span class="address col-xs-hide">				
				<i class="fa fa-map-marker"></i>
				<span><?php echo esc_html($business_architect_address); ?></span>
			  	</span>				
				<?php endif; ?>
				
			  	<?php if($business_architect_email): ?>
			  	<span class="email">				
				<i class="fa fa-envelope-o"></i>
				
				<a class="tel-link" href="mailto:<?php echo esc_attr( antispambot( $business_architect_email ) ); ?>" ><?php echo esc_html($business_architect_email); ?></a>
			 	</span>					
				<?php endif; ?>
				
			</div>
		</div>
		
				
		<div class="col-sm-4 col-xs-12 social-navigation-container">
		
		
			<?php if ( has_nav_menu( 'social' ) ) : ?>
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
			<?php endif; ?>
		</div>
	  </div>
	</div>
</div>

<?php
}