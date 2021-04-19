<?php
if( !class_exists( 'Quality_Construction_Font_awesome_Class_Metabox') ){
    class Quality_Construction_Font_awesome_Class_Metabox {

        public function __construct()
        {

            add_action( 'add_meta_boxes', array( $this, 'quality_construction_icon_metabox') );

            add_action( 'save_post', array( $this, 'quality_construction_save_icon_value') );
        }


        public function quality_construction_icon_metabox()
        {

            add_meta_box(
                    'quality_construction_icon',
                    esc_html__('Font Awesome class', 'quality-construction'),
                    array(
                            $this, 'quality_construction_generate_icon'),
                    'post',
                    'side',
                    'high'
            );
        }

        public function quality_construction_generate_icon($post)
        {
            $values = get_post_meta( $post->ID, 'quality_construction_icon', true );
            wp_nonce_field( basename(__FILE__), 'quality_construction_fontawesome_fields_nonce');
            ?>
            <input type="text" name="icon" value="<?php echo esc_attr($values) ?>" />
            <?php
        }

        public function quality_construction_save_icon_value($post_id)
        {

            /*
                * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
                *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
                * */
            if (
                !isset($_POST['quality_construction_fontawesome_fields_nonce']) ||
                !wp_verify_nonce($_POST['quality_construction_fontawesome_fields_nonce'], basename(__FILE__)) || /*Protecting against unwanted requests*/
                (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || /*Dealing with autosaves*/
                !current_user_can('edit_post', $post_id)/*Verifying access rights*/
            ) {
                return;
            }

            //Execute this saving function
            if (isset($_POST['icon']) && !empty($_POST['icon'])) {
                $fontawesomeclass = sanitize_text_field( $_POST['icon'] );
                update_post_meta($post_id, 'quality_construction_icon', $fontawesomeclass);
            }
        }
    }
}
$productsMetabox = new Quality_Construction_Font_awesome_Class_Metabox;




