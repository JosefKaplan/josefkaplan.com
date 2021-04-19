<?php
/**
 * Quality Construction sidebar layout options
 *
 * @since Quality Construction  1.0.0
 *
 * @param null
 * @return array
 *
 */
if (!function_exists('quality_construction_sidebar_layout_options')) :
    function quality_construction_sidebar_layout_options() {
        $quality_construction_sidebar_layout_options = array(
            'default-sidebar' => array(
                'value' => 'default-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/default-sidebar.png'
            ),
            'left-sidebar' => array(
                'value' => 'left-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/left-sidebar.png'
            ),
            'right-sidebar' => array(
                'value' => 'right-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/right-sidebar.png'
            ),
            'no-sidebar' => array(
                'value' => 'no-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/no-sidebar.png'
            )
        );
        return apply_filters('quality_construction_sidebar_layout_options', $quality_construction_sidebar_layout_options);
    }
endif;

/**
 * Custom Metabox
 *
 * @since Quality Construction  1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('quality_construction__add_metabox')):
    function quality_construction_add_metabox()
    {
        add_meta_box(
            'quality_construction_sidebar_layout', // $id
            esc_html__('Sidebar Layout', 'quality-construction'), // $title
            'quality_construction_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'low'
        ); // $priority

        add_meta_box(
            'quality_construction_sidebar_layout', // $id
            __('Sidebar Layout', 'quality-construction'), // $title
            'quality_construction_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'low'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'quality_construction_add_metabox');


/**
 * Callback function for metabox
 *
 * @since Quality Construction  1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('quality_construction_sidebar_layout_callback')) :
    function quality_construction_sidebar_layout_callback()
    {
        global $post;
        $quality_construction_sidebar_layout_options = quality_construction_sidebar_layout_options();
        $quality_construction_sidebar_layout = 'default-sidebar';
        $quality_construction_sidebar_meta_layout = get_post_meta( $post->ID, 'quality_construction_sidebar_layout', true);
        if ( !empty( $quality_construction_sidebar_meta_layout ) ) {
            $quality_construction_sidebar_layout = $quality_construction_sidebar_meta_layout;
        }
        wp_nonce_field(basename(__FILE__), 'quality_construction_sidebar_layout_nonce');
        ?>

        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php esc_html_e('Choose Sidebar Template', 'quality-construction'); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($quality_construction_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper qc_radio_button">
                            <input id="<?php echo $field['value']; ?>" type="radio"
                                   name="quality_construction_sidebar_layout"
                                   value="<?php echo $field['value']; ?>" <?php checked($field['value'], $quality_construction_sidebar_layout); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url($field['thumbnail']); ?>" alt=""/>
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <em class="f13"><?php esc_html_e('You can set up the sidebar content', 'quality-construction'); ?>
                        <a href="<?php echo esc_url( admin_url('/widgets.php')); ?>">
                            <?php esc_html_e('here', 'quality-construction'); ?>
                        </a>
                    </em>
                </td>
            </tr>

        </table>

    <?php }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Quality Construction  1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('quality_construction_save_sidebar_layout')) :
    function quality_construction_save_sidebar_layout( $post_id )
    {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset($_POST['quality_construction_sidebar_layout_nonce']) ||
            !wp_verify_nonce($_POST['quality_construction_sidebar_layout_nonce'], basename(__FILE__)) || /*Protecting against unwanted requests*/
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || /*Dealing with autosaves*/
            !current_user_can('edit_post', $post_id)/*Verifying access rights*/
        ) {
            return;
        }

        //Execute this saving function
        if ( isset( $_POST['quality_construction_sidebar_layout'] ) ) {
            $old = get_post_meta( $post_id, 'quality_construction_sidebar_layout', true);
            $new = sanitize_text_field ($_POST['quality_construction_sidebar_layout'] );
            if ( $new && $new != $old ) {
                update_post_meta($post_id, 'quality_construction_sidebar_layout', $new);
            } elseif ( '' == $new && $old ) {
                delete_post_meta( $post_id, 'quality_construction_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'quality_construction_save_sidebar_layout');

