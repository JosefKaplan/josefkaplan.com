<?php if( ! defined( 'ABSPATH' ) ) exit;

function shops_customize_register_content( $wp_customize ) {
		
/**
 * Recent Posts
 */
		$wp_customize->add_section( 'seos_content_section' , array(
			'title'       => __( 'Content Options', 'shops' ),
			'priority'    => 2,	
			//'description' => __( 'Social media buttons', 'seos-white' ),
		) ); 
		
 		$wp_customize->add_setting( 'content_max_width', array (
            'default' => 1210,		
			'sanitize_callback' => 'absint',
		) );
				
		 $wp_customize->add_control( 'content_max_width', array(
		  'type' => 'range',
		  'section' => 'seos_content_section',
		  'settings' => 'content_max_width',
		  'label' => __( 'Content max width', 'shops' ),
		  'input_attrs' => array(
			'min' => 1210,
			'max' => 2000,
			'step' => 1,
		  ),
		) );
 
 		$wp_customize->add_setting( 'content_padding', array (
            'default' => 0,		
			'sanitize_callback' => 'absint',
		) );
				
		 $wp_customize->add_control( 'content_padding', array(
		  'type' => 'range',
		  'section' => 'seos_content_section',
		  'settings' => 'content_padding',
		  'label' => __( 'Content Padding', 'shops' ),
		  'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		  ),
		) );

 		$wp_customize->add_setting( 'hide_home_content', array (
            'default' => '',		
			'sanitize_callback' => 'shops_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hide_home_content', array(
			'label'    => __( 'Hide sidebar and content on home page', 'shops' ),
			'section'  => 'seos_content_section',
			'priority'    => 1,				
			'settings' => 'hide_home_content',
			'type' => 'checkbox',
		) ) );		
}
add_action( 'customize_register', 'shops_customize_register_content' );


/********************************************
* Content Styles
*********************************************/ 	

function shops_content_styles () {

        $content_max_width = esc_attr(get_theme_mod( 'content_max_width' ) );
        $hide_home_content = esc_attr(get_theme_mod( 'hide_home_content' ) );
        $content_padding = esc_attr(get_theme_mod( 'content_padding' ) );
        $homepage_columns = esc_attr(get_theme_mod( 'homepage_columns' ) );

		if( $content_max_width ) { $content_max_width_style = "#content,.h-center {max-width: {$content_max_width}px !important;}";} else {$content_max_width_style ="";}
		if( $hide_home_content and (is_home() or is_front_page() ) ) { $hide_home_content_style = "#content #primary, body #content #secondary {display: none !important;}";} else {$hide_home_content_style ="";}
		if( $content_padding ) { $content_padding_style = "#content,.h-center {padding: {$content_padding}px !important;}";} else {$content_padding_style ="";}


		
        wp_add_inline_style( 'shops-style-css', 
		$content_max_width_style.$hide_home_content_style.$content_padding_style
		);
}
add_action( 'wp_enqueue_scripts', 'shops_content_styles' );