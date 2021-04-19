<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */


if ( ! function_exists( 'purea_magazine_customizer_footer_register' ) ) :
function purea_magazine_customizer_footer_register( $wp_customize ) {
 	
 	$wp_customize->add_section(
        'purea_magazine_footer_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Footer Settings', 'purea-magazine' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_footer_settings_title', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_footer_settings_title', 
		array(
		    'label'       => esc_html__( 'Footer Settings', 'purea-magazine' ),
		    'section'     => 'purea_magazine_footer_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_footer_settings_title',
		) 
	));

	// Copyright text
    $wp_customize->add_setting(
        'purea_magazine_footer_copyright_text',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_textarea_field'
        )
    );

    $wp_customize->add_control(
        'purea_magazine_footer_copyright_text',
        array(
            'settings'      => 'purea_magazine_footer_copyright_text',
            'section'       => 'purea_magazine_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer Copyright Text', 'purea-magazine' ),
            'description'   => esc_html__( 'Copyright text to be displayed in the footer. No HTML allowed.', 'purea-magazine' )
        )
    ); 

}
endif;

add_action( 'customize_register', 'purea_magazine_customizer_footer_register' );