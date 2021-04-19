<?php if( ! defined( 'ABSPATH' ) ) exit;

/*******************************
* Enqueue scripts and styles.
********************************/
 
function shops_anima_scripts() {
	//if(get_theme_mod('shops_activate_letter_effect')) {
		wp_enqueue_script( 'shops-anima-js', get_template_directory_uri() . '/js/anime.min.js', array( 'jquery' ), true);
		wp_enqueue_script( 'shops-anime-custom-js', get_template_directory_uri() . '/js/anime-custom.js', array( 'jquery' ), '', true);
	//}
		
}

add_action( 'wp_enqueue_scripts', 'shops_anima_scripts' );




function shops_animations_letter( $wp_customize ) {	

		
		$wp_customize->add_setting( 'shops_activate_letter_effect_title', array (
			'default' => false,
			'sanitize_callback' => 'shops_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shops_activate_letter_effect_title', array(
			'label'    => __( 'Deactivate Letter Effect - Header:', 'shops' ),
			'section'  => 'header_image',
			'priority'    => 3,
			'settings' => 'shops_activate_letter_effect_title',
			'type' => 'checkbox',
		) ) );
		
}
add_action( 'customize_register', 'shops_animations_letter' );