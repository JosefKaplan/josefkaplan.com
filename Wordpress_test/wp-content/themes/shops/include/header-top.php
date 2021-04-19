<?php
// Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Header Top
 *
 */
function shops_header () {
	if(get_theme_mod('activate_before_header')) {
?>
		<div class="before-header">
			<?php if (get_theme_mod('header_email')) { ?>
				<div class="h-email" itemprop="email"><span class="dashicons dashicons-email-alt"> </span> <?php echo esc_html(get_theme_mod('header_email')); ?></div>
			<?php } ?>
			<?php if (get_theme_mod('header_address')) { ?>
				<div class="h-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span class="dashicons dashicons-location"> </span> <?php echo esc_html(get_theme_mod('header_address')); ?></div>
			<?php } ?>
			<?php if (get_theme_mod('header_phone')) { ?>
				<div class="h-phone" itemprop="telephone"><span class="dashicons dashicons-phone"> </span> <?php echo esc_html(get_theme_mod('header_phone')); ?></div>
			<?php } ?>
			<?php if (get_theme_mod('activate_before_header_search')) { ?>
			<div class="search-top">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
					<label>
					<button class="button-primary button-search"><i class="dashicons dashicons-search"></i><span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'shops' ) ?></span></button>
						<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'shops' ) ?></span>
						<input type="search" class="search-field"
							placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'shops' ) ?>"
							value="<?php echo get_search_query() ?>" name="s"
							title="<?php echo esc_attr_x( 'Search for:', 'label', 'shops' ) ?>" />
					</label>
					<input type="submit" class="search-submit"
						value="<?php echo esc_attr_x( 'Search', 'submit button', 'shops' ) ?>" />
				</form>
			</div>
			<?php } ?>
		<?php } ?>
		
			
			
			
			
		</div>
<header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<button id="s-button-menu"><img src="<?php echo esc_url(get_template_directory_uri() ) . '/images/mobile.jpg'; ?>"/></button>
			<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'shops' ); ?></button>
					<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					) ); ?>
			</nav><!-- #site-navigation -->
			<?php if ( function_exists( 'the_custom_logo' ) ) { ?>
			<div class="seos-logo" itemprop="logo" itemscope itemtype="http://schema.org/Brand">
				<?php the_custom_logo(); ?>
			</div>
			<?php } ?>


						<!-- Site Navigation  -->

	<div class="all-header">
		<?php if (!get_theme_mod('shops_header_overlay')) { ?>
		<?php } ?>
    	<div class="s-shadow"></div>
		<?php if (get_theme_mod( 'header_image_position' ) == 'default' ) { ?>
		<img id="masthead" class="header-image" src='<?php echo esc_url(get_template_directory_uri() ) . '/images/header.png'; ?>' alt="<?php esc_attr_e( 'header image','shops' ); ?>"/>	
		<?php } ?>
		<?php if (get_theme_mod( 'header_image_position' ) == 'real' ) { ?>
		<img id="masthead" class="header-image" src='<?php if ( !is_home() and has_post_thumbnail() and get_post_meta( get_the_ID(), 'shops_value_header_image', true ) ) { the_post_thumbnail_url(); } else { header_image(); } ?>' alt="<?php esc_attr_e( 'header image','shops' ); ?>"/>	
		<?php } else { ?>
		<div id="masthead" class="header-image" style="background-image: url( '<?php if (  !is_home() and has_post_thumbnail() and get_post_meta( get_the_ID(), 'shops_value_header_image', true ) ) { the_post_thumbnail_url(); } else { header_image(); } ?>' );"></div>
		<?php } ?>

		<div class="site-branding">
			<span class="ml15">
			<?php
			
			if ( is_front_page() && is_home() ) :
				?>
					<h1 class="site-title" itemscope itemtype="http://schema.org/Brand">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span <?php if( !get_theme_mod( 'shops_activate_letter_effect_title' ) ) { ?>class="ml6"<?php } ?>>
						<?php bloginfo( 'name' ); ?></span>
					</a></h1>

					<?php
				else :
					?>
					<p class="site-title" itemscope itemtype="http://schema.org/Brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span <?php if( !get_theme_mod( 'shops_activate_letter_effect_title' ) ) { ?>class="ml6"<?php } ?>><?php bloginfo( 'name' ); ?></span></a></p>
					
					<?php
				endif;
				$shops_description = esc_html(get_bloginfo( 'description', 'display' ) );
				if ( $shops_description || is_customize_preview() ) :
					?>    
					<p class="site-description" itemprop="headline">
						<span <?php if( !get_theme_mod( 'shops_activate_letter_effect_title' ) ) { ?>class="ml2"<?php } ?>><?php echo esc_html($shops_description); ?></span>
					</p>

				<?php endif; ?>	
			</span>
			

		
		</div>
	</div>

	
	<!-- Recent Posts Slider  -->
	<?php if (( is_front_page() or is_home()) and  get_theme_mod('shops_activate_conveyor_ticker_home')) { 
	 echo esc_html(shops_slider_sticky ()); 
	 } ?>
	 <?php if (( !is_front_page() or !is_home()) and  get_theme_mod('shops_activate_conveyor_ticker_all')) { 
	 echo esc_html(shops_slider_sticky ()); 
	 } ?>

		 
</header>
<?php }