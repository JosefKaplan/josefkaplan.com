<?php
/**
 * The header for our theme.
 *
 * @package scrollme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}?> 
<div class="scrollme-preloader"></div>
	
	<div class="header-wrapper">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'scrollme' ); ?></a>
		<header id="masthead" class="site-header">
			<div class="container clearfix">
				<div class="site-branding">
					<div class="scroll-logo">
					<?php $logo = get_theme_mod( 'scrollme_logo' );
						if( $logo ) :
					?>
	                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_html(get_bloginfo('title')); ?>"/></a>
	                <?php 
	                else: ?>
	                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	                    <h2 class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'description' ); ?></a></h2>
					<?php endif; ?>
					</div>
				</div><!-- .site-branding -->

				<button class="btn-transparent-toggle">
				<div class="toggle-nav">
					<span></span>
				</div>
				</button>

				<?php if( is_active_sidebar('scrollme-header-socialicon') ): ?>
	    			<div class="social-icons">
	    				<?php dynamic_sidebar('scrollme-header-socialicon'); ?>
	    			</div>
				<?php endif; ?>		
			</div>
		</header><!-- #masthead -->

	</div>

	<div id="content" class="site-content">