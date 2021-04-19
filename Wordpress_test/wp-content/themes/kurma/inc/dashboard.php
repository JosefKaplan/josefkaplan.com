<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kurma_create_menu' ) ) {
	add_action( 'admin_menu', 'kurma_create_menu' );
	/**
	 * Adds our "Kurma" dashboard menu item
	 *
	 */
	function kurma_create_menu() {
		$kurma_page = add_theme_page( 'Kurma', 'Kurma', apply_filters( 'kurma_dashboard_page_capability', 'edit_theme_options' ), 'kurma-options', 'kurma_settings_page' );
		add_action( "admin_print_styles-$kurma_page", 'kurma_options_styles' );
	}
}

if ( ! function_exists( 'kurma_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Kurma dashboard page
	 *
	 */
	function kurma_options_styles() {
		wp_enqueue_style( 'kurma-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), KURMA_VERSION );
	}
}

if ( ! function_exists( 'kurma_settings_page' ) ) {
	/**
	 * Builds the content of our Kurma dashboard page
	 *
	 */
	function kurma_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="kurma-masthead clearfix">
					<div class="kurma-container">
						<div class="kurma-title">
							<a href="<?php echo esc_url(KURMA_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Kurma', 'kurma' ); ?></a> <span class="kurma-version"><?php echo KURMA_VERSION; ?></span>
						</div>
						<div class="kurma-masthead-links">
							<?php if ( ! defined( 'KURMA_PREMIUM_VERSION' ) ) : ?>
								<a class="kurma-masthead-links-bold" href="<?php echo esc_url(KURMA_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'kurma' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(KURMA_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'kurma' ); ?></a>
                            <a href="<?php echo esc_url(KURMA_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'kurma' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * kurma_dashboard_after_header hook.
				 *
				 */
				 do_action( 'kurma_dashboard_after_header' );
				 ?>

				<div class="kurma-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * kurma_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'kurma_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'kurma-settings-group' ); ?>
									<?php do_settings_sections( 'kurma-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="kurma_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'kurma' )
										);
										?>
									</div>

									<?php
									/**
									 * kurma_inside_options_form hook.
									 *
									 */
									 do_action( 'kurma_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => KURMA_THEME_URL,
									),
									'Blog' => array(
											'url' => KURMA_THEME_URL,
									),
									'Colors' => array(
											'url' => KURMA_THEME_URL,
									),
									'Copyright' => array(
											'url' => KURMA_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => KURMA_THEME_URL,
									),
									'Demo Import' => array(
											'url' => KURMA_THEME_URL,
									),
									'Hooks' => array(
											'url' => KURMA_THEME_URL,
									),
									'Import / Export' => array(
											'url' => KURMA_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => KURMA_THEME_URL,
									),
									'Page Header' => array(
											'url' => KURMA_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => KURMA_THEME_URL,
									),
									'Spacing' => array(
											'url' => KURMA_THEME_URL,
									),
									'Typography' => array(
											'url' => KURMA_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => KURMA_THEME_URL,
									)
								);

								if ( ! defined( 'KURMA_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox kurma-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'kurma' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated kurma-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'kurma' ); ?></a>
													</div>
												</div>
												<div class="kurma-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * kurma_options_items hook.
								 *
								 */
								do_action( 'kurma_options_items' );
								?>
							</div>

							<div class="kurma-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="kurma_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'kurma' )
									);
									?>
								</div>

								<?php
								/**
								 * kurma_admin_right_panel hook.
								 *
								 */
								 do_action( 'kurma_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Kurma documentation', 'kurma' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'kurma' ); ?></p>
                                    <a href="<?php echo esc_url(KURMA_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Kurma documentation', 'kurma' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'kurma' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'kurma' ); ?></p>
                                    <a href="<?php echo esc_url(KURMA_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'kurma' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'kurma' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Kurma theme, show it to the world with Your review. Your feedback helps a lot.', 'kurma' ); ?></p>
                                    <a href="<?php echo esc_url(KURMA_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'kurma' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'kurma_admin_errors' ) ) {
	add_action( 'admin_notices', 'kurma_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function kurma_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_kurma-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'kurma-notices', 'true', esc_html__( 'Settings saved.', 'kurma' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'kurma-notices', 'imported', esc_html__( 'Import successful.', 'kurma' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'kurma-notices', 'reset', esc_html__( 'Settings removed.', 'kurma' ), 'updated' );
		}

		settings_errors( 'kurma-notices' );
	}
}
