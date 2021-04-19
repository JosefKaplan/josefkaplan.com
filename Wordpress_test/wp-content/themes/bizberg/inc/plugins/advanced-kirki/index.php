<?php

/**
* Plugin Name: Advanced Kirki
* Author: ravisakya
* Version: 0.
* License: GPL2+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require plugin_dir_path( __FILE__ ) . '/inc/desktop_tablet_mobile.php';

add_action( 'customize_controls_enqueue_scripts', 'bizberg_advanced_kirki_customizer_enqueue' );
function bizberg_advanced_kirki_customizer_enqueue(){
	wp_enqueue_style( 'bizberg_advanced_kirki_customizer_css', get_template_directory_uri() . '/inc/plugins/advanced-kirki/assets/css/customizer.css' );
	wp_enqueue_script( 'bizberg_advanced_kirki_customizer_js', get_template_directory_uri() . '/inc/plugins/advanced-kirki/assets/js/customizer.js' , array( 'jquery' ) );
}