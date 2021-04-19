<?php
// Do not allow direct access to the file.
if(  ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'shops_before' );
 
function shops_before( $wp_customize ) {
	
		$wp_customize->add_section( 'shops_before_header' , array(
			'title'       => __( 'Header Options', 'shops' ),
			'priority'    => 1,			) );
			
		$wp_customize->add_setting( 'activate_before_header', array (
            'default' => '',		
			'sanitize_callback' => 'shops_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'activate_before_header', array(
			'label'    => __( 'Activate Section - Before Header', 'shops' ),
			'section'  => 'shops_before_header',
			'priority'    => 3,				
			'settings' => 'activate_before_header',
			'type' => 'checkbox',
		) ) );
		
 	    $wp_customize->add_setting( 'header_email', array (
			'sanitize_callback' => 'sanitize_email',
		) );
			
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_email', array(
			'label'    => __( 'E-mail', 'shops' ),
			'priority'    => 3,
			'section'  => 'shops_before_header',
			'settings' => 'header_email',
			'type' => 'email',
		) ) );

 	    $wp_customize->add_setting( 'header_address', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
			
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_address', array(
			'label'    => __( 'Address', 'shops' ),
			'priority'    => 3,
			'section'  => 'shops_before_header',
			'settings' => 'header_address',
			'type' => 'text',
		) ) );

 	    $wp_customize->add_setting( 'header_phone', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
			
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_phone', array(
			'label'    => __( 'Phone', 'shops' ),
			'priority'    => 3,
			'section'  => 'shops_before_header',
			'settings' => 'header_phone',
			'type' => 'text',
		) ) );


		$wp_customize->add_setting( 'activate_before_header_search', array (
            'default' => '',		
			'sanitize_callback' => 'shops_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'activate_before_header_search', array(
			'label'    => __( 'Activate Search', 'shops' ),
			'section'  => 'shops_before_header',
			'priority'    => 3,				
			'settings' => 'activate_before_header_search',
			'type' => 'checkbox',
		) ) );
		
}



function shops_before_styles() {
        $before_background = esc_attr(get_theme_mod( 'before_background' ) );
        $before_color = esc_attr(get_theme_mod( 'before_color' ) );
        $before_search = esc_attr(get_theme_mod( 'before_search' ) );
## Colors Styles
		if( $before_background) { $style1 = ".before-header {background: {$before_background};}";} else {$style1 ="";}
		if( $before_search) { $style3 = ".before-header input, .before-header .button-search {background: {$before_search} !important;}";} else {$style3 ="";}
		if( $before_color) { $style2 = ".before-header .h-email, .before-header .h-phone,.before-header .search-form input, .before-header .cart-contents .dashicons-cart, .before-header .h-address, .before-header .dashicons-email-alt,.before-header .dashicons , .before-header .dashicons-location,.before-header .right-top a, .before-header .dashicons-phone {color: {$before_color};}";} else {$style2 ="";}
        wp_add_inline_style( 'shops-style-css', 
		$style1.$style2.$style3
		);
}
add_action( 'wp_enqueue_scripts', 'shops_before_styles' );