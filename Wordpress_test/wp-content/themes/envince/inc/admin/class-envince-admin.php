<?php
/**
 * Envince Admin Class.
 *
 * @author  ThemeGrill
 * @package Envince
 * @since   1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Envince_Admin' ) ) :

	/**
	 * Envince_Admin Class.
	 */
	class Envince_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'envince-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), ENVINCE_THEME_VERSION );

			wp_enqueue_script( 'envince-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), ENVINCE_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&envince-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'envince' ),
				'nonce'    => wp_create_nonce( 'envince_demo_import_nonce' ),
			);

			wp_localize_script( 'envince-plugin-install-helper', 'envinceRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new Envince_Admin();
