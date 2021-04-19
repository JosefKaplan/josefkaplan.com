<?php
/**
 * Quality Construction Theme Customizer
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 require get_template_directory() . '/inc/customizer/customizer-pro/class-customize.php';
if (!function_exists('quality_construction_customize_register')) :
    function quality_construction_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

        /*default variable used in setting*/
        $default = quality_construction_get_default_theme_options();

        /**
         * Customizer setting
         */

        require get_template_directory() . '/inc/customizer-core.php';
        require get_template_directory() . '/inc/customizer/quality-construction-customizer-function.php';
        require get_template_directory() . '/inc/customizer/quality-construction-sanitize.php';
        require get_template_directory() . '/inc/customizer/customizer.php';
        require get_template_directory() . '/inc/customizer/quality-construction-copy-right.php';
        require get_template_directory() . '/inc/customizer/quality-construction-theme-options.php';
        require get_template_directory() . '/inc/customizer/quality-construction-header-info-section.php';
        require get_template_directory() . '/inc/customizer/quality-construction-layout-design-options.php';


    }
    add_action('customize_register', 'quality_construction_customize_register');
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

if (!function_exists('quality_construction_customize_preview_js')) :
    function quality_construction_customize_preview_js()
    {
        wp_enqueue_script('quality-construction-customizer', get_template_directory_uri() . 'assets/js/customizer.js', array('customize-preview'), '1.0.1', true);
    }

    add_action('customize_preview_init', 'quality_construction_customize_preview_js');

endif;



