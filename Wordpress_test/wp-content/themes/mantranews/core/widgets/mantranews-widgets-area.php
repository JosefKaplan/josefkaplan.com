<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */
function mantranews_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mantranews' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This sidebar will appear only if you choose right sidebar.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'mantranews' ),
		'id'            => 'mantranews_left_sidebar',
		'description'   => esc_html__( 'This sidebar will appear only if you choose left sidebar.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'mantranews' ),
		'id'            => 'mantranews_header_ads_area',
		'description'   => esc_html__( 'This sidebar will appear on header section of a page.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Slider Area', 'mantranews' ),
		'id'            => 'mantranews_home_slider_area',
		'description'   => esc_html__( 'This sidebar will appear below header(after menu) section of News Home Page Template.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Content Area', 'mantranews' ),
		'id'            => 'mantranews_home_content_area',
		'description'   => esc_html__( 'This sidebar will appear below Home Page Slider section of News Home Page Template. ', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'HomePage Sidebar', 'mantranews' ),
		'id'            => 'mantranews_home_sidebar',
		'description'   => esc_html__( 'Home page sidebar of News Home Page Template.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1st Column', 'mantranews' ),
		'id'            => 'mantranews_footer_one',
		'description'   => esc_html__( 'First column of footer section. Appear only if at least one column footer widget area selected from customizer footer settings.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2nd Column', 'mantranews' ),
		'id'            => 'mantranews_footer_two',
		'description'   => esc_html__( 'Second column of footer section. Appear only if at least two column footer widget area selected from customizer footer settings.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3rd Column', 'mantranews' ),
		'id'            => 'mantranews_footer_three',
		'description'   => esc_html__( 'Third column of footer section. Appear only if at least three column footer widget area selected from customizer footer settings.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4th Column', 'mantranews' ),
		'id'            => 'mantranews_footer_four',
		'description'   => esc_html__( 'Fourth column of footer section. Appear only if at least four column footer widget area selected from customizer footer settings.', 'mantranews' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

}

add_action( 'widgets_init', 'mantranews_widgets_init' );


/**
 * Load widgets files
 */
require get_template_directory() . '/core/widgets/mantranews-widget-fields.php';
require get_template_directory() . '/core/widgets/mantranews-featured-slider.php';
require get_template_directory() . '/core/widgets/mantranews-post-carousel.php';
require get_template_directory() . '/core/widgets/mantranews-block-grid.php';
require get_template_directory() . '/core/widgets/mantranews-block-column.php';
require get_template_directory() . '/core/widgets/mantranews-block-layout.php';
require get_template_directory() . '/core/widgets/mantranews-posts-list.php';
require get_template_directory() . '/core/widgets/mantranews-block-list.php';

