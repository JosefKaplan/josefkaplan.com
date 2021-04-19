<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'business-architect' ); ?></a>
<?php
business_architect_wp_body_open();
if(get_theme_mod("box_layout_mode", false))	echo '<div class="box-layout-style">'; 
?>
<div id="page" class="site">
	<div class="site-inner">		

		<?php get_template_part( 'templates/top', 'banner' ); ?>
		
		<header id="masthead" class="site-header" role="banner" >

			<?php 
			get_template_part( 'templates/contact', 'section' );
			
			$business_architect_header = get_theme_mod('header_layout', business_architect_default_settings('header_layout'));
			
			if ($business_architect_header == 0) {
				do_action('business_architect_default_header');
				//woocommerce layout
			} else if($business_architect_header == 1 && class_exists('WooCommerce')){
				do_action('business_architect_store_header'); 
				//list layout
			} else if ($business_architect_header == 2){
				do_action('business_architect_burger_header');
			} else {
				//default layout
				//echo '<div id="site-header-main" class="site-header-main">';
				do_action('business_architect_default_header');
			}
			
			if(is_front_page()){
				get_template_part( 'templates/top', 'shortcode' );
			}
			
			/* end header div in default header layouts 
			if ($business_architect_header == 0) {
				echo '</div><!-- .site-header-main -->';
			}*/
			?>		

		</header><!-- .site-header -->
		
		<?php if(is_front_page()  && get_theme_mod('slider_in_home_page' , 1)): ?>
			<?php get_template_part('templates/top', 'slider' ); ?>
		<?php endif; ?>

<div id="site-content">		
