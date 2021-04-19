<?php
/**
 * Block Color Settings
 *
 * @package GT Ambition
 */

/**
 * Adds all Block Color settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function gt_ambition_customize_register_block_color_settings( $wp_customize ) {

	// Add Section for Block Colors.
	$wp_customize->add_section( 'gt_ambition_section_block_colors', array(
		'title'    => esc_html__( 'Block Colors', 'gt-ambition' ),
		'priority' => 10,
		'panel'    => 'gt_ambition_options_panel',
	) );

	// Get Default Colors from settings.
	$default = gt_ambition_default_options();

	// Add Primary Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[primary_color]', array(
		'default'           => $default['primary_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[primary_color]', array(
			'label'    => esc_html_x( 'Primary', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[primary_color]',
			'priority' => 10,
		)
	) );

	// Add Secondary Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[secondary_color]', array(
		'default'           => $default['secondary_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[secondary_color]', array(
			'label'    => esc_html_x( 'Secondary', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[secondary_color]',
			'priority' => 20,
		)
	) );

	// Add Accent Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[accent_color]', array(
		'default'           => $default['accent_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[accent_color]', array(
			'label'    => esc_html_x( 'Accent', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[accent_color]',
			'priority' => 30,
		)
	) );

	// Add Highlight Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[highlight_color]', array(
		'default'           => $default['highlight_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[highlight_color]', array(
			'label'    => esc_html_x( 'Highlight', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[highlight_color]',
			'priority' => 40,
		)
	) );

	// Add Light Gray Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[light_gray_color]', array(
		'default'           => $default['light_gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[light_gray_color]', array(
			'label'    => esc_html_x( 'Light Gray', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[light_gray_color]',
			'priority' => 50,
		)
	) );

	// Add Gray Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[gray_color]', array(
		'default'           => $default['gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[gray_color]', array(
			'label'    => esc_html_x( 'Gray', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[gray_color]',
			'priority' => 60,
		)
	) );

	// Add Dark Gray Color setting.
	$wp_customize->add_setting( 'gt_ambition_theme_options[dark_gray_color]', array(
		'default'           => $default['dark_gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'gt_ambition_theme_options[dark_gray_color]', array(
			'label'    => esc_html_x( 'Dark Gray', 'Color Option', 'gt-ambition' ),
			'section'  => 'gt_ambition_section_block_colors',
			'settings' => 'gt_ambition_theme_options[dark_gray_color]',
			'priority' => 70,
		)
	) );
}
add_action( 'customize_register', 'gt_ambition_customize_register_block_color_settings' );
