<?php
/**
 * Builds our main Layout meta box.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'admin_enqueue_scripts', 'kurma_enqueue_meta_box_scripts' );
/**
 * Adds any scripts for this meta box.
 *
 *
 * @param string $hook The current admin page.
 */
function kurma_enqueue_meta_box_scripts( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		$post_types = get_post_types( array( 'public' => true ) );
		$screen = get_current_screen();
		$post_type = $screen->id;

		if ( in_array( $post_type, ( array ) $post_types ) ) {
			wp_enqueue_style( 'kurma-layout-metabox', get_template_directory_uri() . '/css/admin/meta-box.css', array(), KURMA_VERSION );
		}
	}
}

add_action( 'add_meta_boxes', 'kurma_register_layout_meta_box' );
/**
 * Generate the layout metabox
 *
 */
function kurma_register_layout_meta_box() {
	if ( ! current_user_can( apply_filters( 'kurma_metabox_capability', 'edit_theme_options' ) ) ) {
		return;
	}

	if ( ! defined( 'KURMA_LAYOUT_META_BOX' ) ) {
		define( 'KURMA_LAYOUT_META_BOX', true );
	}

	$post_types = get_post_types( array( 'public' => true ) );
	foreach ($post_types as $type) {
		if ( 'attachment' !== $type ) {
			add_meta_box (
				'kurma_layout_options_meta_box',
				esc_html__( 'Layout', 'kurma' ),
				'kurma_do_layout_meta_box',
				$type,
				'normal',
				'high'
			);
		}
	}
}

/**
 * Build our meta box.
 *
 *
 * @param object $post All post information.
 */
function kurma_do_layout_meta_box( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'kurma_layout_nonce' );
	$stored_meta = (array) get_post_meta( $post->ID );
	$stored_meta['_kurma-sidebar-layout-meta'][0] = ( isset( $stored_meta['_kurma-sidebar-layout-meta'][0] ) ) ? $stored_meta['_kurma-sidebar-layout-meta'][0] : '';
	$stored_meta['_kurma-footer-widget-meta'][0] = ( isset( $stored_meta['_kurma-footer-widget-meta'][0] ) ) ? $stored_meta['_kurma-footer-widget-meta'][0] : '';
	$stored_meta['_kurma-full-width-content'][0] = ( isset( $stored_meta['_kurma-full-width-content'][0] ) ) ? $stored_meta['_kurma-full-width-content'][0] : '';
	$stored_meta['_kurma-disable-headline'][0] = ( isset( $stored_meta['_kurma-disable-headline'][0] ) ) ? $stored_meta['_kurma-disable-headline'][0] : '';
	$stored_meta['_kurma-transparent-header'][0] = ( isset( $stored_meta['_kurma-transparent-header'][0] ) ) ? $stored_meta['_kurma-transparent-header'][0] : '';

	$tabs = apply_filters( 'kurma_metabox_tabs',
		array(
			'sidebars' => array(
				'title' => esc_html__( 'Sidebars', 'kurma' ),
				'target' => '#kurma-layout-sidebars',
				'class' => 'current',
			),
			'footer_widgets' => array(
				'title' => esc_html__( 'Footer Widgets', 'kurma' ),
				'target' => '#kurma-layout-footer-widgets',
				'class' => '',
			),
			'disable_elements' => array(
				'title' => esc_html__( 'Disable Elements', 'kurma' ),
				'target' => '#kurma-layout-disable-elements',
				'class' => '',
			),
			'container' => array(
				'title' => esc_html__( 'Page Builder Container', 'kurma' ),
				'target' => '#kurma-layout-page-builder-container',
				'class' => '',
			),
			'transparent_header' => array(
				'title' => esc_html__( 'Transparent Header', 'kurma' ),
				'target' => '#kurma-layout-transparent-header',
				'class' => '',
			),
		)
	);
	?>
	<script>
		jQuery(document).ready(function($) {
			$( '.kurma-meta-box-menu li a' ).on( 'click', function( event ) {
				event.preventDefault();
				$( this ).parent().addClass( 'current' );
				$( this ).parent().siblings().removeClass( 'current' );
				var tab = $( this ).attr( 'data-target' );

				// Page header module still using href.
				if ( ! tab ) {
					tab = $( this ).attr( 'href' );
				}

				$( '.kurma-meta-box-content' ).children( 'div' ).not( tab ).css( 'display', 'none' );
				$( tab ).fadeIn( 100 );
			});
		});
	</script>
	<div id="kurma-meta-box-container">
		<ul class="kurma-meta-box-menu">
			<?php
			foreach ( ( array ) $tabs as $tab => $data ) {
				echo '<li class="' . esc_attr( $data['class'] ) . '"><a data-target="' . esc_attr( $data['target'] ) . '" href="#">' . esc_html( $data['title'] ) . '</a></li>';
			}

			do_action( 'kurma_layout_meta_box_menu_item' );
			?>
		</ul>
		<div class="kurma-meta-box-content">
			<div id="kurma-layout-sidebars">
				<div class="kurma_layouts">
					<label for="meta-kurma-layout-global" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-global" value="" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'kurma' );?>
					</label>

					<label for="meta-kurma-layout-one" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Right Sidebar', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-one" value="right-sidebar" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'right-sidebar' ); ?>>
						<?php esc_html_e( 'Content', 'kurma' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong>
					</label>

					<label for="meta-kurma-layout-two" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Left Sidebar', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-two" value="left-sidebar" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'left-sidebar' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong> / <?php esc_html_e( 'Content', 'kurma' );?>
					</label>

					<label for="meta-kurma-layout-three" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'No Sidebars', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-three" value="no-sidebar" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'no-sidebar' ); ?>>
						<?php esc_html_e( 'Content (no sidebars)', 'kurma' );?>
					</label>

					<label for="meta-kurma-layout-four" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-four" value="both-sidebars" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'both-sidebars' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong> / <?php esc_html_e( 'Content', 'kurma' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong>
					</label>

					<label for="meta-kurma-layout-five" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars on Left', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-five" value="both-left" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'both-left' ); ?>>
						<strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong> / <?php esc_html_e( 'Content', 'kurma' );?>
					</label>

					<label for="meta-kurma-layout-six" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( 'Both Sidebars on Right', 'kurma' );?>">
						<input type="radio" name="_kurma-sidebar-layout-meta" id="meta-kurma-layout-six" value="both-right" <?php checked( $stored_meta['_kurma-sidebar-layout-meta'][0], 'both-right' ); ?>>
						<?php esc_html_e( 'Content', 'kurma' );?> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong> / <strong><?php echo esc_html_x( 'Sidebar', 'Short name for meta box', 'kurma' ); ?></strong>
					</label>
				</div>
			</div>
			<div id="kurma-layout-footer-widgets" style="display: none;">
				<div class="kurma_footer_widget">
					<label for="meta-kurma-footer-widget-global" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-global" value="" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-zero" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '0 Widgets', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-zero" value="0" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '0' ); ?>>
						<?php esc_html_e( '0 Widgets', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-one" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '1 Widget', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-one" value="1" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '1' ); ?>>
						<?php esc_html_e( '1 Widget', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-two" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '2 Widgets', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-two" value="2" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '2' ); ?>>
						<?php esc_html_e( '2 Widgets', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-three" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '3 Widgets', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-three" value="3" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '3' ); ?>>
						<?php esc_html_e( '3 Widgets', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-four" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '4 Widgets', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-four" value="4" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '4' ); ?>>
						<?php esc_html_e( '4 Widgets', 'kurma' );?>
					</label>

					<label for="meta-kurma-footer-widget-five" style="display:block;margin-bottom:3px;" title="<?php esc_attr_e( '5 Widgets', 'kurma' );?>">
						<input type="radio" name="_kurma-footer-widget-meta" id="meta-kurma-footer-widget-five" value="5" <?php checked( $stored_meta['_kurma-footer-widget-meta'][0], '5' ); ?>>
						<?php esc_html_e( '5 Widgets', 'kurma' );?>
					</label>
				</div>
			</div>
			<div id="kurma-layout-page-builder-container" style="display: none;">
				<p class="page-builder-content" style="color:#666;font-size:13px;margin-top:0;">
					<?php esc_html_e( 'Choose your page builder content container type. Both options remove the content padding for you.', 'kurma' ) ;?>
				</p>

				<p class="kurma_full_width_template">
					<label for="default-content" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-full-width-content" id="default-content" value="" <?php checked( $stored_meta['_kurma-full-width-content'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'kurma' );?>
					</label>

					<label id="full-width-content" for="_kurma-full-width-content" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-full-width-content" id="_kurma-full-width-content" value="true" <?php checked( $stored_meta['_kurma-full-width-content'][0], 'true' ); ?>>
						<?php esc_html_e( 'Full Width', 'kurma' );?>
					</label>

					<label id="kurma-remove-padding" for="_kurma-remove-content-padding" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-full-width-content" id="_kurma-remove-content-padding" value="contained" <?php checked( $stored_meta['_kurma-full-width-content'][0], 'contained' ); ?>>
						<?php esc_html_e( 'Contained', 'kurma' );?>
					</label>
				</p>
			</div>
			<div id="kurma-layout-transparent-header" style="display: none;">
				<p class="transparent-header-content" style="color:#666;font-size:13px;margin-top:0;">
					<?php esc_html_e( 'Switch to transparent header if You want to put content behind the header.', 'kurma' ) ;?>
				</p>

				<p class="kurma_transparent_header">
					<label for="default" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-transparent-header" id="default" value="" <?php checked( $stored_meta['_kurma-transparent-header'][0], '' ); ?>>
						<?php esc_html_e( 'Default', 'kurma' );?>
					</label>

					<label id="transparent" for="_kurma-transparent-header" style="display:block;margin-bottom:10px;">
						<input type="radio" name="_kurma-transparent-header" id="transparent" value="true" <?php checked( $stored_meta['_kurma-transparent-header'][0], 'true' ); ?>>
						<?php esc_html_e( 'Transparent', 'kurma' );?>
					</label>
				</p>
			</div>
			<div id="kurma-layout-disable-elements" style="display: none;">
				<?php if ( ! defined( 'KURMA_DE_VERSION' ) ) : ?>
					<div class="kurma_disable_elements">
						<label for="meta-kurma-disable-headline" style="display:block;margin: 0 0 1em;" title="<?php esc_attr_e( 'Content Title', 'kurma' );?>">
							<input type="checkbox" name="_kurma-disable-headline" id="meta-kurma-disable-headline" value="true" <?php checked( $stored_meta['_kurma-disable-headline'][0], 'true' ); ?>>
							<?php esc_html_e( 'Content Title', 'kurma' );?>
						</label>

						<?php if ( ! defined( 'KURMA_PREMIUM_VERSION' ) ) : ?>
							<span style="display:block;padding-top:1em;border-top:1px solid #EFEFEF;">
								<a href="<?php echo KURMA_THEME_URL; // WPCS: XSS ok, sanitization ok. ?>" target="_blank"><?php esc_html_e( 'Premium module available', 'kurma' ); ?></a>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php do_action( 'kurma_layout_disable_elements_section', $stored_meta ); ?>
			</div>
			<?php do_action( 'kurma_layout_meta_box_content', $stored_meta ); ?>
		</div>
	</div>
    <?php
}

add_action( 'save_post', 'kurma_save_layout_meta_data' );
/**
 * Saves the sidebar layout meta data.
 *
 *
 * @param int Post ID.
 */
function kurma_save_layout_meta_data( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'kurma_layout_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'kurma_layout_nonce' ] ), basename( __FILE__ ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	$sidebar_layout_key   = '_kurma-sidebar-layout-meta';
	$sidebar_layout_value = filter_input( INPUT_POST, $sidebar_layout_key, FILTER_SANITIZE_STRING );

	if ( $sidebar_layout_value ) {
		update_post_meta( $post_id, $sidebar_layout_key, $sidebar_layout_value );
	} else {
		delete_post_meta( $post_id, $sidebar_layout_key );
	}

	$footer_widget_key   = '_kurma-footer-widget-meta';
	$footer_widget_value = filter_input( INPUT_POST, $footer_widget_key, FILTER_SANITIZE_STRING );

	// Check for empty string to allow 0 as a value.
	if ( '' !== $footer_widget_value ) {
		update_post_meta( $post_id, $footer_widget_key, $footer_widget_value );
	} else {
		delete_post_meta( $post_id, $footer_widget_key );
	}

	$page_builder_container_key   = '_kurma-full-width-content';
	$page_builder_container_value = filter_input( INPUT_POST, $page_builder_container_key, FILTER_SANITIZE_STRING );

	if ( $page_builder_container_value ) {
		update_post_meta( $post_id, $page_builder_container_key, $page_builder_container_value );
	} else {
		delete_post_meta( $post_id, $page_builder_container_key );
	}

	$transparent_header_key   = '_kurma-transparent-header';
	$transparent_header_value = filter_input( INPUT_POST, $transparent_header_key, FILTER_SANITIZE_STRING );

	if ( $transparent_header_value ) {
		update_post_meta( $post_id, $transparent_header_key, $transparent_header_value );
	} else {
		delete_post_meta( $post_id, $transparent_header_key );
	}

	// We only need this if the Disable Elements module doesn't exist
	if ( ! defined( 'KURMA_DE_VERSION' ) ) {
		$disable_content_title_key   = '_kurma-disable-headline';
		$disable_content_title_value = filter_input( INPUT_POST, $disable_content_title_key, FILTER_SANITIZE_STRING );

		if ( $disable_content_title_value ) {
			update_post_meta( $post_id, $disable_content_title_key, $disable_content_title_value );
		} else {
			delete_post_meta( $post_id, $disable_content_title_key );
		}
	}

	do_action( 'kurma_layout_meta_box_save', $post_id );
}
