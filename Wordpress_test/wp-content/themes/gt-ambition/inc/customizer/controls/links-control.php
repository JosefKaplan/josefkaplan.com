<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package GT Ambition
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class GT_Ambition_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'gt-ambition' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/themes/gt-ambition/', 'gt-ambition' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=gt-ambition&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'gt-ambition' ); ?>
					</a>
				</p>

				<p>
					<a href="https://demo.germanthemes.de/?demo=gt-ambition&utm_source=customizer&utm_campaign=gt-ambition" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'gt-ambition' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/docs/gt-ambition-documentation/', 'gt-ambition' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=gt-ambition&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'gt-ambition' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/gt-ambition/reviews/', 'gt-ambition' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'gt-ambition' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
