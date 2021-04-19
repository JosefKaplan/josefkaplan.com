<?php
/**
 * enqueue Script for admin dashboard.
 */

if (!function_exists('quality_construction_widgets_backend_enqueue')) :
    function quality_construction_widgets_backend_enqueue($hook)
    {
        if ('widgets.php' != $hook) {
            return;
        }

        wp_register_script('quality-construction-custom-widgets', get_template_directory_uri() . '/assets/js/widgets.js', array('jquery'), true);
        wp_enqueue_media();
        wp_enqueue_script('quality-construction-custom-widgets');
    }

    add_action('admin_enqueue_scripts', 'quality_construction_widgets_backend_enqueue');
endif;

/**
 * enqueue Admins style for admin dashboard.
 */

if (!function_exists('quality_construction_admin_css_enqueue')) :
    function quality_construction_admin_css_enqueue($hook)
    {
        if ('post.php' != $hook) {
            return;
        }
        wp_enqueue_style('quality-construction-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
         }
    add_action('admin_enqueue_scripts', 'quality_construction_admin_css_enqueue');
endif;


if (!function_exists('quality_construction_admin_css_enqueue_new_post')) :
    function quality_construction_admin_css_enqueue_new_post($hook)
    {
        if ('post-new.php' != $hook) {
            return;
        }
        wp_enqueue_style('quality-construction-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
    }
    add_action('admin_enqueue_scripts', 'quality_construction_admin_css_enqueue_new_post');
endif;

/**
 * Functions for get_theme_mod()
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */

if (!function_exists('quality_construction_get_option')) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function quality_construction_get_option($key = '')
    {
        if (empty($key)) {
            return;
        }
        $quality_construction_default_options = quality_construction_get_default_theme_options();

        $default = (isset($quality_construction_default_options[$key])) ? $quality_construction_default_options[$key] : '';

        $theme_option = get_theme_mod($key, $default);

        return $theme_option;

    }

endif;

/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('quality_construction_sanitize_multiple_category') ) :

function quality_construction_sanitize_multiple_category( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

endif;


/**
 * Load Metabox file
 * =====================================
 *
 * /**
 * Metabox for Page Layout Option
 */

require get_template_directory() . '/inc/metabox/metabox-defaults.php';

/**
 * Metabox for Fontawesome Class
 */

require get_template_directory() . '/inc/metabox/metabox-icon.php';


/*
* Including Custom Widget Files
=====================================
/**
 * Custom quote Widget
 */
require get_template_directory() . '/inc/widget/quote-widget.php';

/**
 * Custom Welcome Message Widget
 */
require get_template_directory() . '/inc/widget/welcome-msg-widget.php';

/**
 * Custom Feature Widget
 */
require get_template_directory() . '/inc/widget/feature-widget.php';

/**
 * Custom Services Widget
 */
require get_template_directory() . '/inc/widget/services-widget.php';

/**
 * Custom Mission Widget
 */
require get_template_directory() . '/inc/widget/mission-widget.php';

/**
 * Custom Recent Post Widget
 */
require get_template_directory() . '/inc/widget/recent-post-widget.php';

/**
 * Custom Testimonial  Widget
 */
require get_template_directory() . '/inc/widget/testimonial-widget.php';


/**
 * Custom Our Work Widget
 */
require get_template_directory() . '/inc/widget/our-work-widget.php';


