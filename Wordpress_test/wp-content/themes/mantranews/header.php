<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
do_action( 'wp_body_open' );
do_action('mantranews_before_page'); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'mantranews'); ?></a>
    <header id="masthead" class="site-header">
        <?php do_action('mantranews_before_header_content'); ?>
        <?php get_template_part('template-parts/header/header', 'image'); ?>
        <?php do_action('mantranews_news_ticker'); ?>
        <?php do_action('mantranews_top_header_section'); ?>
        <?php do_action('mantranews_logo_ads_section'); ?>
        <?php do_action('mantranews_after_header_content'); ?>

        <div id="mb-menu-wrap" class="bottom-header-wrapper clearfix">
            <div class="mb-container">
                <div class="home-icon"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"> <i
                                class="fa fa-home"> </i> </a></div>
                <a href="javascript:void(0)" class="menu-toggle"> <i class="fa fa-navicon"> </i> </a>
                <nav id="site-navigation" class="main-navigation">
                    <?php wp_nav_menu(array('theme_location' => 'primary',
                        'container_class' => 'menu',
                        'items_wrap' => '<ul>%3$s</ul>'
                    )); ?>
                </nav><!-- #site-navigation -->
                <div class="header-search-wrapper">
                    <span class="search-main"><i class="fa fa-search"></i></span>
                    <div class="search-form-main clearfix">
                        <?php get_search_form(); ?>
                    </div>
                </div><!-- .header-search-wrapper -->
            </div><!-- .mb-container -->
        </div><!-- #mb-menu-wrap -->


    </header><!-- #masthead -->
    <?php do_action('mantranews_after_header'); ?>
    <?php do_action('mantranews_before_main'); ?>

    <div id="content" class="site-content">
        <div class="mb-container">
