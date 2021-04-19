<?php
/**
 * Customizer settings for Important Link Panel
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'customize_register', 'mantranews_important_link_panel_register' );

function mantranews_important_link_panel_register( $wp_customize ) {

	// Theme important links started
	class Mantranews_Important_Links extends WP_Customize_Control {

		public $type = "mantranews-important-links";

		public function render_content() {
			//Add Theme instruction, Support Forum, Demo Link, Rating Link
			$important_links = array(
				'view-pro'      => array(
					'link' => esc_url( 'https://mantrabrain.com/downloads/mantranews-pro-wordpress-news-theme/?utm_source=free_customizer&utm_medium=mantranews_free&utm_campaign=free_customizer' ),
					'text' => esc_html__( 'View Pro', 'mantranews' ),
				),
				'theme-info'    => array(
					'link' => esc_url( 'https://mantrabrain.com/downloads/mantranews-wordpress-news-theme/?utm_source=free_customizer&utm_medium=mantranews_free&utm_campaign=free_customizer' ),
					'text' => esc_html__( 'Theme Info', 'mantranews' ),
				),
				'support'       => array(
					'link' => esc_url( 'https://mantrabrain.com/support-forum/' ),
					'text' => esc_html__( 'Support', 'mantranews' ),
				),
				'documentation' => array(
					'link' => esc_url( 'https://mantrabrain.com/docs-category/mantranews-wordpress-theme/' ),
					'text' => esc_html__( 'Documentation', 'mantranews' ),
				),
				'demo'          => array(
					'link' => esc_url( 'https://demo.mantrabrain.com/mantranews-wordpress-theme/' ),
					'text' => esc_html__( 'View Demo', 'mantranews' ),
				),
				'rating'        => array(
					'link' => esc_url( 'https://wordpress.org/support/view/theme-reviews/mantranews?filter=5' ),
					'text' => esc_html__( 'Rate this theme', 'mantranews' ),
				),
			);
			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr( $important_link['text'] ) . ' </a></p>';
			}
		}

	}

	$wp_customize->add_section( 'mantranews_important_links', array(
		'priority' => 1,
		'title'    => __( 'Mantranews Important Links', 'mantranews' ),
	) );

	/**
	 * This setting has the dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'mantranews_important_links', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'mantranews_links_sanitize',
	) );

	$wp_customize->add_control( new Mantranews_Important_Links( $wp_customize, 'important_links', array(
		'label'    => __( 'Important Links', 'mantranews' ),
		'section'  => 'mantranews_important_links',
		'settings' => 'mantranews_important_links',
	) ) );
	// Theme Important Links Ended

}
