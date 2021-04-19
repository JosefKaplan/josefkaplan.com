<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */


if ( ! function_exists( 'purea_magazine_customizer_preloader_register' ) ) :
function purea_magazine_customizer_preloader_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'purea_magazine_preloader_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Preloader Settings', 'purea-magazine' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_preloader_settings_title', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_preloader_settings_title', 
		array(
		    'label'       => esc_html__( 'Preloader Settings', 'purea-magazine' ),
		    'section'     => 'purea_magazine_preloader_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_preloader_settings_title',
		) 
	));

	// Add an option to enable the preloader
	$wp_customize->add_setting( 
		'purea_magazine_enable_preloader', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_preloader', 
		array(
		    'label'       => esc_html__( 'Show Preloader', 'purea-magazine' ),
		    'section'     => 'purea_magazine_preloader_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_preloader',
		) 
	));

}
endif;

add_action( 'customize_register', 'purea_magazine_customizer_preloader_register' );