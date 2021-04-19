<?php
/**
 * Functions for rendering meta boxes in post area
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'add_meta_boxes', 'mantranews_metaboxes', 10, 2 );
function mantranews_metaboxes( $type, $post ) {
    add_meta_box(
        'mantranews_post_sidebar',
        esc_html__( 'Sidebar Position', 'mantranews' ),
        'mantranews_sidebar_callback',
        'post',
        'side',
        'default'
    );
    add_meta_box(
        'mantranews_post_sidebar',
        esc_html__( 'Sidebar Position', 'mantranews' ),
        'mantranews_sidebar_callback',
        'page',
        'side',
        'default'
    );
}

function mantranews_sidebar_callback( $post ) {

    // Setup our options.
    $mantranews_page_sidebar_option = array(
    'default-sidebar' => array(
        'id'        => 'default-sidebar',
        'value'     => 'default_sidebar',
        'label'     => esc_html__( 'Default Layout', 'mantranews' ),
        ),
    'right-sidebar' => array(
        'id'        => 'rigth-sidebar',
        'value'     => 'right_sidebar',
        'label'     => esc_html__( 'Right Sidebar', 'mantranews' ),
        ),
    'left-sidebar' => array(
        'id'        => 'left-sidebar',
        'value'     => 'left_sidebar',
        'label'     => esc_html__( 'Left Sidebar', 'mantranews' ),
        ),
    'no-sidebar-full-width' => array(
        'id'        => 'no-sidebar',
        'value'     => 'no_sidebar',
        'label'     => esc_html__( 'No Sidebar Full Width', 'mantranews' ),
        ),
    'no-sidebar-content-centered' => array(
        'id'        => 'no-sidebar-center',
        'value'     => 'no_sidebar_center',
        'label'     => esc_html__( 'No Sidebar Content Centered', 'mantranews' ),
        ),
    );

    // Check for previously set.
    $location = get_post_meta( $post->ID, 'mantranews_sidebar_location', true );
    // If it is then we use it otherwise set to default.
    $location = ( $location ) ? $location : 'default_sidebar';

    // Create our nonce field.
    wp_nonce_field( 'mantranews_nonce_' . basename( __FILE__ ) , 'mantranews_sidebar_location_nonce' );
    foreach ( $mantranews_page_sidebar_option as $field ) {
    ?>
        <div class="meta-radio-wrap">
            <input id="<?php echo esc_attr( $field['id'] ); ?>" type="radio" name="mantranews_sidebar_location" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $location ); ?>/>
            <label for="<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
        </div>
    <?php
    }
}

add_action( 'save_post', 'mantranews_save_post_meta' );
function mantranews_save_post_meta( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['mantranews_sidebar_location_nonce'] ) && wp_verify_nonce( wp_unslash($_POST['mantranews_sidebar_location_nonce']), 'mantranews_nonce_' . basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    // Check for out input value.
    if ( isset( $_POST['mantranews_sidebar_location'] ) ) {
        // We validate making sure that the option is something we can expect.
        $value = in_array( wp_unslash($_POST['mantranews_sidebar_location']), array( 'no_sidebar', 'left_sidebar', 'right_sidebar', 'no_sidebar_center', 'default_sidebar' ) ) ? wp_unslash($_POST['mantranews_sidebar_location']) : 'default_sidebar';
        // We update our post meta.
        update_post_meta( $post_id, 'mantranews_sidebar_location', sanitize_text_field(wp_unslash ($value)));
    }
}
