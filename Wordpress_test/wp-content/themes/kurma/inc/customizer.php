<?php
/**
 * Builds our Customizer controls.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'kurma_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 */
function kurma_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'kurma_customize_register' ) ) {
	add_action( 'customize_register', 'kurma_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function kurma_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = kurma_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control('blogdescription')->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control('blogname')->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}

		// Add control types so controls can be built using JS
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Kurma_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Kurma_Range_Slider_Control' );
		}

		// Add upsell section type
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'Kurma_Upsell_Section' );
		}

		// Add selective refresh to site title and description
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.main-title a',
				'render_callback' => 'kurma_customize_partial_blogname',
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'render_callback' => 'kurma_customize_partial_blogdescription',
			) );
		}

		// Remove title
		$wp_customize->add_setting(
			'kurma_settings[hide_title]',
			array(
				'default' => $defaults['hide_title'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kurma_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'kurma' ),
				'section' => 'title_tagline',
				'priority' => 2
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'kurma_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kurma_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'kurma' ),
				'section' => 'title_tagline',
				'priority' => 4
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[retina_logo]',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'kurma_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'kurma' ),
					'section' => 'title_tagline',
					'settings' => 'kurma_settings[retina_logo]',
					'active_callback' => 'kurma_has_custom_logo_callback'
				)
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[side_inside_color]', array(
				'default' => $defaults['side_inside_color'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kurma_settings[side_inside_color]',
				array(
					'label' => __( 'Inside padding', 'kurma' ),
					'section' => 'colors',
					'settings' => 'kurma_settings[side_inside_color]',
					'active_callback' => 'kurma_is_side_padding_active',
				)
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kurma_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'kurma' ),
					'section' => 'colors',
					'settings' => 'kurma_settings[text_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kurma_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'kurma' ),
					'section' => 'colors',
					'settings' => 'kurma_settings[link_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kurma_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'kurma' ),
					'section' => 'colors',
					'settings' => 'kurma_settings[link_color_hover]'
				)
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kurma_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'kurma' ),
					'section' => 'colors',
					'settings' => 'kurma_settings[link_color_visited]'
				)
			)
		);

		if ( ! function_exists( 'kurma_colors_customize_register' ) && ! defined( 'KURMA_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Kurma_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'colors',
						'type' => 'addon',
						'label' => __( 'More info', 'kurma' ),
						'description' => __( 'More colors are available in Kurma premium version. Visit wpkoi.com for more info.', 'kurma' ),
						'url' => esc_url( KURMA_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'kurma_layout_panel' ) ) {
				$wp_customize->add_panel( 'kurma_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'kurma' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'kurma_layout_container',
			array(
				'title' => __( 'Container', 'kurma' ),
				'priority' => 10,
				'panel' => 'kurma_layout_panel'
			)
		);

		// Container width
		$wp_customize->add_setting(
			'kurma_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_integer',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control(
			new Kurma_Range_Slider_Control(
				$wp_customize,
				'kurma_settings[container_width]',
				array(
					'type' => 'kurma-range-slider',
					'label' => __( 'Container Width', 'kurma' ),
					'section' => 'kurma_layout_container',
					'settings' => array(
						'desktop' => 'kurma_settings[container_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 700,
							'max' => 2000,
							'step' => 5,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 0,
				)
			)
		);

		// Add Top Bar section
		$wp_customize->add_section(
			'kurma_top_bar',
			array(
				'title' => __( 'Top Bar', 'kurma' ),
				'priority' => 15,
				'panel' => 'kurma_layout_panel',
			)
		);

		// Add Top Bar width
		$wp_customize->add_setting(
			'kurma_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'kurma_settings[top_bar_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Width', 'kurma' ),
				'section' => 'kurma_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'kurma' ),
					'contained' => __( 'Contained', 'kurma' )
				),
				'settings' => 'kurma_settings[top_bar_width]',
				'priority' => 5,
				'active_callback' => 'kurma_is_top_bar_active',
			)
		);

		// Add Top Bar inner width
		$wp_customize->add_setting(
			'kurma_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'kurma_settings[top_bar_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Inner Width', 'kurma' ),
				'section' => 'kurma_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'kurma' ),
					'contained' => __( 'Contained', 'kurma' )
				),
				'settings' => 'kurma_settings[top_bar_inner_width]',
				'priority' => 10,
				'active_callback' => 'kurma_is_top_bar_active',
			)
		);

		// Add top bar alignment
		$wp_customize->add_setting(
			'kurma_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[top_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Alignment', 'kurma' ),
				'section' => 'kurma_top_bar',
				'choices' => array(
					'left' => __( 'Left', 'kurma' ),
					'center' => __( 'Center', 'kurma' ),
					'right' => __( 'Right', 'kurma' )
				),
				'settings' => 'kurma_settings[top_bar_alignment]',
				'priority' => 15,
				'active_callback' => 'kurma_is_top_bar_active',
			)
		);

		// Add Header section
		$wp_customize->add_section(
			'kurma_layout_header',
			array(
				'title' => __( 'Header', 'kurma' ),
				'priority' => 20,
				'panel' => 'kurma_layout_panel'
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'kurma_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'kurma_settings[header_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Width', 'kurma' ),
				'section' => 'kurma_layout_header',
				'choices' => array(
					'fluid-header' => __( 'Full', 'kurma' ),
					'contained-header' => __( 'Contained', 'kurma' )
				),
				'settings' => 'kurma_settings[header_layout_setting]',
				'priority' => 5
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'kurma_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'kurma_settings[header_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Header Width', 'kurma' ),
				'section' => 'kurma_layout_header',
				'choices' => array(
					'contained' => __( 'Contained', 'kurma' ),
					'full-width' => __( 'Full', 'kurma' )
				),
				'settings' => 'kurma_settings[header_inner_width]',
				'priority' => 6
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[header_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Alignment', 'kurma' ),
				'section' => 'kurma_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'kurma' ),
					'center' => __( 'Center', 'kurma' ),
					'right' => __( 'Right', 'kurma' )
				),
				'settings' => 'kurma_settings[header_alignment_setting]',
				'priority' => 10
			)
		);

		$wp_customize->add_section(
			'kurma_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'kurma' ),
				'priority' => 30,
				'panel' => 'kurma_layout_panel'
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Width', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'fluid-nav' => __( 'Full', 'kurma' ),
					'contained-nav' => __( 'Contained', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_layout_setting]',
				'priority' => 15
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Navigation Width', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'contained' => __( 'Contained', 'kurma' ),
					'full-width' => __( 'Full', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_inner_width]',
				'priority' => 16
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Alignment', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'kurma' ),
					'center' => __( 'Center', 'kurma' ),
					'right' => __( 'Right', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_alignment_setting]',
				'priority' => 20
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => ( '' !== kurma_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Location', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'nav-below-header' => __( 'Below Header', 'kurma' ),
					'nav-above-header' => __( 'Above Header', 'kurma' ),
					'nav-float-right' => __( 'Float Right', 'kurma' ),
					'nav-float-left' => __( 'Float Left', 'kurma' ),
					'nav-left-sidebar' => __( 'Left Sidebar', 'kurma' ),
					'nav-right-sidebar' => __( 'Right Sidebar', 'kurma' ),
					'' => __( 'No Navigation', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_position_setting]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_dropdown_type]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Dropdown', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'hover' => __( 'Hover', 'kurma' ),
					'click' => __( 'Click - Menu Item', 'kurma' ),
					'click-arrow' => __( 'Click - Arrow', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_dropdown_type]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kurma_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kurma_settings[nav_search]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Search', 'kurma' ),
				'section' => 'kurma_layout_navigation',
				'choices' => array(
					'enable' => __( 'Enable', 'kurma' ),
					'disable' => __( 'Disable', 'kurma' )
				),
				'settings' => 'kurma_settings[nav_search]',
				'priority' => 23
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'kurma_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kurma_settings[content_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content Layout', 'kurma' ),
				'section' => 'kurma_layout_container',
				'choices' => array(
					'separate-containers' => __( 'Separate Containers', 'kurma' ),
					'one-container' => __( 'One Container', 'kurma' )
				),
				'settings' => 'kurma_settings[content_layout_setting]',
				'priority' => 25
			)
		);

		$wp_customize->add_section(
			'kurma_layout_sidecontent',
			array(
				'title' => __( 'Fixed Side Content', 'kurma' ),
				'priority' => 39,
				'panel' => 'kurma_layout_panel'
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[fixed_side_content]',
			array(
				'default' => $defaults['fixed_side_content'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[fixed_side_content]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Fixed Side Content', 'kurma' ),
				'description'=> __( 'Content that You want to display fixed on the left.', 'kurma' ),
				'section'    => 'kurma_layout_sidecontent',
				'settings'   => 'kurma_settings[fixed_side_content]',
			)
		);

		$wp_customize->add_section(
			'kurma_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'kurma' ),
				'priority' => 40,
				'panel' => 'kurma_layout_panel'
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kurma_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kurma_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Sidebar Layout', 'kurma' ),
				'section' => 'kurma_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kurma' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kurma' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kurma' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kurma' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kurma' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kurma' )
				),
				'settings' => 'kurma_settings[layout_setting]',
				'priority' => 30
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kurma_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kurma_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'kurma' ),
				'section' => 'kurma_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kurma' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kurma' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kurma' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kurma' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kurma' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kurma' )
				),
				'settings' => 'kurma_settings[blog_layout_setting]',
				'priority' => 35
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kurma_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kurma_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'kurma' ),
				'section' => 'kurma_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kurma' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kurma' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kurma' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kurma' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kurma' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kurma' )
				),
				'settings' => 'kurma_settings[single_layout_setting]',
				'priority' => 36
			)
		);

		$wp_customize->add_section(
			'kurma_layout_footer',
			array(
				'title' => __( 'Footer', 'kurma' ),
				'priority' => 50,
				'panel' => 'kurma_layout_panel'
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kurma_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kurma_settings[footer_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Width', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'fluid-footer' => __( 'Full', 'kurma' ),
					'contained-footer' => __( 'Contained', 'kurma' )
				),
				'settings' => 'kurma_settings[footer_layout_setting]',
				'priority' => 40
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kurma_settings[footer_widgets_inner_width]',
			array(
				'default' => $defaults['footer_widgets_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kurma_settings[footer_widgets_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Widgets Width', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'kurma' ),
					'full-width' => __( 'Full', 'kurma' )
				),
				'settings' => 'kurma_settings[footer_widgets_inner_width]',
				'priority' => 41
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kurma_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kurma_settings[footer_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Width', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'kurma' ),
					'full-width' => __( 'Full', 'kurma' )
				),
				'settings' => 'kurma_settings[footer_inner_width]',
				'priority' => 41
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'kurma_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'kurma_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				),
				'settings' => 'kurma_settings[footer_widget_setting]',
				'priority' => 45
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'kurma_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'kurma_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'left' => __( 'Left','kurma' ),
					'center' => __( 'Center','kurma' ),
					'right' => __( 'Right','kurma' )
				),
				'settings' => 'kurma_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'kurma_is_footer_bar_active'
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'kurma_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_choices'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kurma_settings[back_to_top]',
			array(
				'type' => 'select',
				'label' => __( 'Back to Top Button', 'kurma' ),
				'section' => 'kurma_layout_footer',
				'choices' => array(
					'enable' => __( 'Enable', 'kurma' ),
					'' => __( 'Disable', 'kurma' )
				),
				'settings' => 'kurma_settings[back_to_top]',
				'priority' => 50
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'kurma_blog_section',
			array(
				'title' => __( 'Blog', 'kurma' ),
				'priority' => 55,
				'panel' => 'kurma_layout_panel'
			)
		);

		$wp_customize->add_setting(
			'kurma_settings[blog_header_image]',
			array(
				'default' => $defaults['blog_header_image'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'kurma_settings[blog_header_image]',
				array(
					'label' => __( 'Blog Header image', 'kurma' ),
					'section' => 'kurma_blog_section',
					'settings' => 'kurma_settings[blog_header_image]',
					'description' => __( 'Recommended size: 1920*900px', 'kurma' )
				)
			)
		);

		// Blog header texts
		$wp_customize->add_setting(
			'kurma_settings[blog_header_title]',
			array(
				'default' => $defaults['blog_header_title'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[blog_header_title]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header title', 'kurma' ),
				'section'    => 'kurma_blog_section',
				'settings'   => 'kurma_settings[blog_header_title]',
				'description' => __( 'HTML allowed.', 'kurma' )
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[blog_header_text]',
			array(
				'default' => $defaults['blog_header_text'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[blog_header_text]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header text', 'kurma' ),
				'section'    => 'kurma_blog_section',
				'settings'   => 'kurma_settings[blog_header_text]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[blog_header_button_text]',
			array(
				'default' => $defaults['blog_header_button_text'],
				'type' => 'option',
				'sanitize_callback' => 'esc_html',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[blog_header_button_text]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button text', 'kurma' ),
				'section'    => 'kurma_blog_section',
				'settings'   => 'kurma_settings[blog_header_button_text]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[blog_header_button_url]',
			array(
				'default' => $defaults['blog_header_button_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[blog_header_button_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button url', 'kurma' ),
				'section'    => 'kurma_blog_section',
				'settings'   => 'kurma_settings[blog_header_button_url]',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kurma_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_blog_excerpt'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'kurma' ),
				'section' => 'kurma_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'kurma' ),
					'excerpt' => __( 'Excerpt', 'kurma' )
				),
				'settings' => 'kurma_settings[post_content]',
				'priority' => 10
			)
		);

		if ( ! function_exists( 'kurma_blog_customize_register' ) && ! defined( 'KURMA_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Kurma_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'kurma_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'kurma' ),
						'description' => __( 'More options are available for this section in our premium version.', 'kurma' ),
						'url' => esc_url( KURMA_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'kurma_general_section',
			array(
				'title' => __( 'General', 'kurma' ),
				'priority' => 99
			)
		);

		if ( ! apply_filters( 'kurma_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'kurma_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'kurma_sanitize_checkbox'
				)
			);

			$wp_customize->add_control(
				'kurma_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'kurma' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'kurma' ),
					'section' => 'kurma_general_section',
					'settings' => 'kurma_settings[font_awesome_essentials]',
				)
			);
		}

		// Add Socials section
		$wp_customize->add_section(
			'kurma_socials_section',
			array(
				'title' => __( 'Socials', 'kurma' ),
				'priority' => 99
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_display_side]',
			array(
				'default' => $defaults['socials_display_side'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_display_side]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Display on fixed side', 'kurma' ),
				'section' => 'kurma_socials_section'
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_display_top]',
			array(
				'default' => $defaults['socials_display_top'],
				'type' => 'option',
				'sanitize_callback' => 'kurma_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_display_top]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Display on top bar', 'kurma' ),
				'section' => 'kurma_socials_section'
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_facebook_url]',
			array(
				'default' => $defaults['socials_facebook_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_facebook_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Facebook url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_facebook_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_twitter_url]',
			array(
				'default' => $defaults['socials_twitter_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_twitter_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Twitter url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_twitter_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_google_url]',
			array(
				'default' => $defaults['socials_google_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_google_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Google url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_google_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_tumblr_url]',
			array(
				'default' => $defaults['socials_tumblr_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_tumblr_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Tumblr url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_tumblr_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_pinterest_url]',
			array(
				'default' => $defaults['socials_pinterest_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_pinterest_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Pinterest url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_pinterest_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_youtube_url]',
			array(
				'default' => $defaults['socials_youtube_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_youtube_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Youtube url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_youtube_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_linkedin_url]',
			array(
				'default' => $defaults['socials_linkedin_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_linkedin_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Linkedin url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_linkedin_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_linkedin_url]',
			array(
				'default' => $defaults['socials_linkedin_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_linkedin_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Linkedin url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_linkedin_url]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_1]',
			array(
				'default' => $defaults['socials_custom_icon_1'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_1]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 1', 'kurma' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'kurma' ), 'https://fontawesome.com/icons' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_1]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_url_1]',
			array(
				'default' => $defaults['socials_custom_icon_url_1'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_url_1]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 1 url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_url_1]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_2]',
			array(
				'default' => $defaults['socials_custom_icon_2'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_2]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 2', 'kurma' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'kurma' ), 'https://fontawesome.com/icons' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_2]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_url_2]',
			array(
				'default' => $defaults['socials_custom_icon_url_2'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_url_2]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 2 url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_url_2]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_3]',
			array(
				'default' => $defaults['socials_custom_icon_3'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_3]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 3', 'kurma' ),
				'description'=> sprintf( __( 'You can add icon code for Your button.<br>Example: <code>fa-file-pdf-o</code>.<br>Use the codes from <a href="%s" target="_blank">Font Awesome</a>):', 'kurma' ), 'https://fontawesome.com/icons' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_3]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_custom_icon_url_3]',
			array(
				'default' => $defaults['socials_custom_icon_url_3'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_custom_icon_url_3]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Custom icon 3 url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_custom_icon_url_3]',
			)
		);
		
		$wp_customize->add_setting(
			'kurma_settings[socials_mail_url]',
			array(
				'default' => $defaults['socials_mail_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'kurma_settings[socials_mail_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'E-mail url', 'kurma' ),
				'section'    => 'kurma_socials_section',
				'settings'   => 'kurma_settings[socials_mail_url]',
			)
		);

		// Add Kurma Premium section
		if ( ! defined( 'KURMA_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new Kurma_Upsell_Section( $wp_customize, 'kurma_upsell_section',
					array(
						'pro_text' => __( 'Get Premium for more!', 'kurma' ),
						'pro_url' => esc_url( KURMA_THEME_URL ),
						'capability' => 'edit_theme_options',
						'priority' => 555,
						'type' => 'kurma-upsell-section',
					)
				)
			);
		}
	}
}

if ( ! function_exists( 'kurma_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'kurma_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 */
	function kurma_customizer_live_preview() {
		wp_enqueue_script( 'kurma-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), KURMA_VERSION, true );
	}
}
