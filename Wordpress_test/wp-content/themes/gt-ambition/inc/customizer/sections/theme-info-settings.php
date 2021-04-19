<?php
/**
 * Theme Info Settings
 *
 * Register Theme Info Settings
 *
 * @package GT Ambition
 */

/**
 * Adds all Theme Info settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_ambition_customize_register_theme_info_settings( $wp_customize ) {

	// Add Section for Theme Fonts.
	$wp_customize->add_section( 'gt_ambition_section_theme_info', array(
		'title'    => esc_html__( 'Theme Info', 'gt-ambition' ),
		'priority' => 200,
		'panel'    => 'gt_ambition_options_panel',
	) );

	// Add Theme Links control.
	$wp_customize->add_control( new GT_Ambition_Customize_Links_Control(
		$wp_customize, 'gt_ambition_theme_links', array(
			'section'  => 'gt_ambition_section_theme_info',
			'settings' => array(),
			'priority' => 10,
		)
	) );
}
add_action( 'customize_register', 'gt_ambition_customize_register_theme_info_settings' );
