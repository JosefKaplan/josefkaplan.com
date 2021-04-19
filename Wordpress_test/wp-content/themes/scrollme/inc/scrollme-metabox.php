<?php
/**
 * Scrollme Custom Metabox
 *
 * @package scrollme
 */

add_action('add_meta_boxes', 'scrollme_add_metabox');
function scrollme_add_metabox()
{
    add_meta_box(
        'scrollme_sidebar_layout', // $id
        'Sidebar Layout', // $title
        'scrollme_sidebar_layout_callback', // $callback
        'post', // $page
        'normal', // $context
        'high'); // $priority

    add_meta_box(
        'scrollme_sidebar_layout', // $id
        'Sidebar Layout', // $title
        'scrollme_sidebar_layout_callback', // $callback
        'page', // $page
        'normal', // $context
        'high'); // $priority

}


$scrollme_sidebar_layout = array(
    'right-sidebar' => array(
        'value' => 'right_sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
    ),
    'left-sidebar' => array(
        'value'     => 'left_sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no_sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
    )

);

function scrollme_sidebar_layout_callback()
{
    global $post , $scrollme_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'scrollme_sidebar_layout_nonce' );
    ?>

    <table class="form-table page-meta-box">
        <tr>
            <td colspan="4"><?php esc_html_e( 'Choose Sidebar Template', 'scrollme' ); ?></td>
        </tr>

        <tr>
            <td>
                <?php
                foreach ($scrollme_sidebar_layout as $field) {
                    $scrollme_sidebar_metalayout = get_post_meta( $post->ID, 'scrollme_sidebar_layout', true ); 
                    if(!$scrollme_sidebar_metalayout){
                        $scrollme_sidebar_metalayout = 'right_sidebar';
                    }
                    ?>

                    <div style="float:left; margin-right:30px;">
                        <label>
                            <input id="<?php echo esc_attr($field['value']); ?>" type="radio" name="scrollme_sidebar_layout" value="<?php echo esc_attr($field['value']); ?>" <?php checked($field['value'], $scrollme_sidebar_metalayout ); ?>/>
                        
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function scrollme_save_sidebar_layout( $post_id ) {
    global $scrollme_sidebar_layout, $post;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'scrollme_sidebar_layout_nonce' ] ) || !wp_verify_nonce( sanitize_text_field(wp_unslash($_POST[ 'scrollme_sidebar_layout_nonce' ])), basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
        return;

    if ( isset( $_POST['post_type'] ) && 'page' == sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
        if (!current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }


    foreach ($scrollme_sidebar_layout as $field) {
        //Execute this saving function
        $old = get_post_meta( $post_id, 'scrollme_sidebar_layout', true);
        $new = isset( $_POST['scrollme_sidebar_layout'] ) ? sanitize_text_field( wp_unslash( $_POST['scrollme_sidebar_layout'] ) ) : '';
        if ($new && $new != $old) {
            update_post_meta($post_id, 'scrollme_sidebar_layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'scrollme_sidebar_layout', $old);
        }
    } // end foreach

}
add_action('save_post', 'scrollme_save_sidebar_layout');