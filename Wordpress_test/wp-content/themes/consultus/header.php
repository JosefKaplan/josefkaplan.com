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
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'consultus' ); ?></a>
<?php 
consultus_wp_body_open(); 
if(get_theme_mod("box_layout_mode", false))	echo '<div class="box-layout-style">'; 
?>
<div id="page" class="site">
	<div class="site-inner">	
		
		<header id="masthead" class="site-header" role="banner" >
		
			<?php if(get_theme_mod("breadcrumb_enable", false)): ?>
			<div class="overlay">
			<?php endif; ?>
			
			<?php do_action('consultus_header');	?>
			
			<?php 
			if(get_theme_mod("breadcrumb_enable", false) && !is_front_page()) {
				  get_template_part( 'templates/main', 'breadcrumb' );
				  echo "<div>";
			}
			?>
			</div>
		</header><!-- .site-header -->
		
		<?php do_action('consultus_home_slider');  ?>
		
		

<div id="site-content">		
