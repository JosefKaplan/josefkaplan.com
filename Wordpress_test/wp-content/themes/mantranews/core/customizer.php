<?php
/**
 * Mantranews Theme Customizer.
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mantranews_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'mantranews_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mantranews_customize_preview_js() {
	global $mantranews_version;
	wp_enqueue_script( 'mantranews_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), esc_attr( $mantranews_version ), true );
}
add_action( 'customize_preview_init', 'mantranews_customize_preview_js' );

/**
 * Customizer Callback functions
 */
function mantranews_related_articles_option_callback( $control ) {
    if ( $control->manager->get_setting( 'mantranews_related_articles_option' )->value() != 'disable' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Load customizer panels
 */
require get_template_directory() . '/core/admin/inc/panels/general-panel.php'; //General settings panel
require get_template_directory() . '/core/admin/inc/panels/header-panel.php'; //header settings panel
require get_template_directory() . '/core/admin/inc/panels/design-panel.php'; //Design Settings panel
require get_template_directory() . '/core/admin/inc/panels/additional-panel.php'; //Additional settings panel
require get_template_directory() . '/core/admin/inc/panels/important-link-panel.php'; //Important Links Panel
