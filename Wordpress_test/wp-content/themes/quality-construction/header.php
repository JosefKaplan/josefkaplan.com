<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
  if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'quality-construction'); ?></a>
        <?php get_template_part('section-parts/section', 'top-header'); ?>
        <?php 
        // Custom image.
        global $header_imagem,$header_style;
        $header_image = get_header_image();
     
        if( $header_image ){
            $header_style = 'style="background-image: url('.esc_url( $header_image ).');background-size: cover;background-attachment: fixed;"';                 

        } else{

            $header_style = '';
        }

        ?>
   <header id="header" class="head" role="banner">
        <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-menu" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'quality-construction'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="site-branding">
                        <?php
                        if (has_custom_logo()) { ?>
                            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php the_custom_logo(); ?>
                            </a>
                        <?php } else {
                            if (is_front_page() && is_home()) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </p>
                                <?php
                            endif;
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                <?php
                            endif;
                        } ?>
                    </div><!-- .site-branding -->

                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeIn">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'depth' => 4,
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse',
                                'container_id' => 'bs-example-navbar-collapse-1',
                                'menu_class' => 'nav navbar-nav navbar-right',
                                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                'walker' => new WP_Bootstrap_Navwalker()
                            )
                        );
                    }
                    ?>
                </div>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

	
