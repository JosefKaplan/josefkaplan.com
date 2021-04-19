<?php

/**
 * Enqueue style for custom customize control.
 */

add_action( 'customize_controls_enqueue_scripts', 'bizberg_custom_customize_enqueue' );
function bizberg_custom_customize_enqueue() {
	wp_enqueue_style( 'bizberg-customize-controls', get_template_directory_uri() . '/inc/sections/customizer.css' );	
	wp_enqueue_script('bizberg-customize-controls-js2', get_template_directory_uri() . '/inc/sections/customizer-control.js', array('customize-controls'));
}

add_action( 'customize_register', 'bizberg_upgrade_to_pro_msg' );
function bizberg_upgrade_to_pro_msg( $wp_customize ){

	wp_enqueue_style( 'bizberg-customize-controls-init', get_template_directory_uri() . '/inc/sections/customizer-init.css' );

	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/sections/controls.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Bizberg_Customize_Section' );

	// Register sections.
	$wp_customize->add_section(
		new Bizberg_Customize_section(
			$wp_customize,
			'theme_upsell',
			array(
				'priority' => 1,
			)
		)
	);

	$wp_customize->get_section('title_tagline')->panel = 'navigation';
	$wp_customize->get_section('title_tagline')->priority = 10;
	$wp_customize->get_section('static_front_page')->panel = 'general-settings';
	$wp_customize->get_section('static_front_page')->priority = 10;

}

add_action( 'init' , 'bizberg_kirki_fields' );
function bizberg_kirki_fields(){

	/**
	* Navigation
	*/

	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/primary-header.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/primary-menu.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/progress-bar.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/footer-settings.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/mobile-menu.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/top-bar.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/navigation/transparent-header.php';

	/**
	* Hero Section
	*/

	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/hero/front-page-hero.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/hero/inner-pages-hero.php';

	/**
	* General Settings
	*/

	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/typography/base-typography/base-typography.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/typography/headings/headings.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/site-identity.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/colors.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/container.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/general-settings/homepage-settings.php';

	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/blog-settings.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/detail-page-settings.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/breadcrumb.php';

	if ( class_exists( 'WooCommerce' ) ):
		require_once trailingslashit( get_template_directory() ) . '/inc/customizer/woocommerce/product-catalog.php';
		require_once trailingslashit( get_template_directory() ) . '/inc/customizer/woocommerce/header.php';
		require_once trailingslashit( get_template_directory() ) . '/inc/customizer/woocommerce/floating-menu.php';
	endif;

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_section( 'typography', array(
	    'title'          => esc_html__( 'Typography', 'bizberg' ),
	    'panel'          => 'general-settings',
	    'priority'       => 10
	) );

	Kirki::add_section( 'container', array(
	    'title'          => esc_html__( 'Container', 'bizberg' ),
	    'panel'          => 'general-settings',
	    'priority'       => 10
	) );

	Kirki::add_section( 'base-typography', array(
	    'title'          => esc_html__( 'Base Typography', 'bizberg' ),
	    'section'          => 'typography',
	    'priority'       => 10
	) );

	Kirki::add_section( 'headings', array(
	    'title'          => esc_html__( 'Headings', 'bizberg' ),
	    'section'          => 'typography',
	    'priority'       => 10
	) );

	/**
	* Logo Settings
	*/

	Kirki::add_panel( 'navigation', array(
	    'title'       => esc_html__( 'Navigation', 'bizberg' ),
	    'priority' => 5
	) );

	Kirki::add_panel( 'hero', array(
	    'title'       => esc_html__( 'Hero', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'priority' => 6
	) );

	Kirki::add_section( 'breadcrumb', array(
	    'title'          => esc_html__( 'Breadcrumb', 'bizberg' ),
	    'priority'       => 7,
	) );

	/**
	* Top Header
	*/

	Kirki::add_section( 'top-header', array(
	    'title'          => esc_html__( 'Top Bar', 'bizberg' ),
	    'panel'          => 'navigation',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'transparent_header', array(
	    'title'          => esc_html__( 'Transparent Header', 'bizberg' ),
	    'panel'          => 'navigation',
	    'capability'     => 'edit_theme_options',
	) );

	/**
	* General Settings
	*/

	Kirki::add_panel( 'general-settings', array(
	    'title'          => esc_html__( 'General Settings', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'theme_colors', array(
	    'title'          => esc_html__( 'Colors', 'bizberg' ),
	    'panel'          => 'general-settings',
	    'priority'       => 100,
	) );

	Kirki::add_section( 'progress_bar', array(
	    'title'          => esc_html__( 'Progress Bar', 'bizberg' ),
	    'panel'          => 'navigation',
	    'capability'     => 'edit_theme_options',
	    'priority' => 20
	) );

	Kirki::add_config( 'bizberg', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_section( 'primary_header', array(
	    'title'          => esc_html__( 'Primary Header', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'navigation'
	) );

	Kirki::add_section( 'header', array(
	    'title'          => esc_html__( 'Primary Menu', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'navigation'
	) );

	Kirki::add_section( 'mobile_menu', array(
	    'title'          => esc_html__( 'Mobile Menu', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'navigation'
	) );

	Kirki::add_section( 'homepage', array(
	    'title'          => esc_html__( 'Blog Settings', 'bizberg' ),
	    'capability'     => 'edit_theme_options'
	) );

	Kirki::add_section( 'front_page_hero', array(
	    'title'          => esc_html__( 'Front Page Hero', 'bizberg' ),
	    'panel'          => 'hero',
	) );

	Kirki::add_section( 'inner_pages_hero', array(
	    'title'          => esc_html__( 'Inner Pages Hero', 'bizberg' ),
	    'panel'          => 'hero',
	) );

	Kirki::add_field( 'bizberg', [
		'type'        => 'custom',
		'settings'    => 'bizberg_blank_setting',
		'section'     => 'hero',
		'default'     => ''
	] );

	Kirki::add_section( 'footer_settings', array(
	    'title'          => esc_html__( 'Footer Settings', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'panel' => 'navigation',
	    'priority'    => 40,

	) );

	Kirki::add_section( 'detail_page', array(
	    'title'          => esc_html__( 'Detail Page Settings', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30
	) );

	Kirki::add_section( '404_settings', array(
	    'title'          => esc_html__( '404 Page Settings', 'bizberg' ),
	    'capability'     => 'edit_theme_options',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'bizberg', array(
		'type'        => 'image',
		'settings'    => '404_background_image',
		'label'       => esc_html__( 'Background Image', 'bizberg' ),
		'section'     => '404_settings',
		'default'     => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'transport' => 'postMessage',
	    'js_vars'   => array(
			array(
				'element'  => '.error-section',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'output' => array(
			array(
				'element'  => '.error-section',
				'property' => 'background-image'
			)
		),
	) );

}