<?php
/**
 * Customizer function
 * Remained just for folks
 *
 * @ Theme: Manduca - focus on accessibility
 *
 **/
 
 class Customizer {
		
	function __construct() {
		
		// Customizer setup
		add_action( 'customize_register', array( $this,  'customize_register' ) );
		
		// Enqueue Javascript postMessage handlers for the Customizer.
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		
		}
		
	function sanitize_text_input( $input ) {
		$output = strip_tags( stripslashes( $input ) );  
    return $output;
				} 
			
	function customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
		// Move theme option to the customizer
		$wp_customize->add_setting( 'manduca_copyright_text', array(
			'default' => get_bloginfo(),
			'sanitize_callback' => 'manduca_sanitize_text_input'
			) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'manduca_options', array(
			'label'        =>  __( 'Copyright text', 'manduca' ),
			'section'    => 'title_tagline',
			'settings'   => 'manduca_copyright_text',
		) ) );
	}
		
		 
		function customize_preview_js() {
			wp_enqueue_script( 'manduca-customizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
		}
		
	
}
