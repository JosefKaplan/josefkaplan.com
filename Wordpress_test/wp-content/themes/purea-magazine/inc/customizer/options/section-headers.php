<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */



function purea_magazine_customizer_headers_register( $wp_customize ) {
	
	$wp_customize->add_section(
        'purea_magazine_headers_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Header Settings', 'purea-magazine' ),
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_header_styles_title', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_header_styles_title', 
		array(
		    'label'       => esc_html__( 'Choose Header Styles', 'purea-magazine' ),
		    'section'     => 'purea_magazine_headers_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_header_styles_title',
		) 
	));

	// Header Style
    $wp_customize->add_setting(
        'purea_magazine_header_menu_style',
        array(
            'default'			=> 'style1',
            'type'				=> 'theme_mod',
            'transport'         => 'refresh',
            'capability'		=> 'edit_theme_options',
            'sanitize_callback'	=> 'purea_magazine_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new Purea_Magazine_Radio_Image_Control( $wp_customize,'purea_magazine_header_menu_style',
            array(
                'settings'		=> 'purea_magazine_header_menu_style',
                'section'		=> 'purea_magazine_headers_settings',
                'label'			=> esc_html__( 'Header Style', 'purea-magazine' ),
                'choices'		=> array(
                    'style1'	        => PUREA_MAGAZINE_DIR_URI . '/inc/customizer/assets/images/style1.png',
                    'style2'            => PUREA_MAGAZINE_DIR_URI . '/inc/customizer/assets/images/style2.png',
                )
            )
        )
    );

    $wp_customize->add_setting( 
        'purea_magazine_label_header_styles_info_settings', 
        array(
            'sanitize_callback' => 'purea_magazine_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_label_header_styles_info_settings', 
        array(
            'label'       => esc_html__( "If you do not see any changes in preview after changing header styles then click on publish button and then refresh the page again. ", 'purea-magazine' ),
            'section'     => 'purea_magazine_headers_settings',
            'type'        => 'title',
            'settings'    => 'purea_magazine_label_header_styles_info_settings',
        ) 
    ));
}


add_action( 'customize_register', 'purea_magazine_customizer_headers_register' );