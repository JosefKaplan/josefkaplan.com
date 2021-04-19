<?php
/**
 * Reset Option
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_reset_option
 *
 */
if (!function_exists('quality_construction_reset_option')) :
    function quality_construction_reset_option()
    {
        $quality_construction_reset_option = array(
            'do-not-reset' 	=> esc_html__( 'Do Not Reset','quality-construction'),
            'reset-all' 	=> esc_html__( 'Reset All','quality-construction'),
        );
        return apply_filters('quality_construction_reset_option', $quality_construction_reset_option);
    }
endif;


/**
 * Breadcrumb  display option options
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_show_breadcrumb_option
 *
 */
if (!function_exists('quality_construction_show_breadcrumb_option')) :
    function quality_construction_show_breadcrumb_option()
    {
        $quality_construction_show_breadcrumb_option = array(
            'enable' => esc_html__('Enable', 'quality-construction'),
            'disable' => esc_html__('Disable', 'quality-construction')
        );
        return apply_filters('quality_construction_show_breadcrumb_option', $quality_construction_show_breadcrumb_option);
    }
endif;


/**
 * Top Header Section Hide/Show  options
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_show_top_header_section_option
 *
 */
if (!function_exists('quality_construction_show_top_header_section_option')) :
    function quality_construction_show_top_header_section_option()
    {
        $quality_construction_show_top_header_section_option = array(
            'show' => esc_html__('Show', 'quality-construction'),
            'hide' => esc_html__('Hide', 'quality-construction')
        );
        return apply_filters('quality_construction_show_top_header_section_option', $quality_construction_show_top_header_section_option);
    }
endif;


/**
 * Show/Hide Feature Image  options
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_show_feature_image_option
 *
 */
if (!function_exists('quality_construction_show_feature_image_option')) :
    function quality_construction_show_feature_image_option()
    {
        $quality_construction_show_feature_image_option = array(
            'show' => esc_html__('Show', 'quality-construction'),
            'hide' => esc_html__('Hide', 'quality-construction')
        );
        return apply_filters('quality_construction_show_feature_image_option', $quality_construction_show_feature_image_option);
    }
endif;


/**
 * Slider  options
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_slider_option
 *
 */
if (!function_exists('quality_construction_slider_option')) :
    function quality_construction_slider_option()
    {
        $quality_construction_slider_option = array(
            'show' => esc_html__('Show', 'quality-construction'),
            'hide' => esc_html__('Hide', 'quality-construction')
        );
        return apply_filters('quality_construction_slider_option', $quality_construction_slider_option);
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_sidebar_layout
 *
 */
if (!function_exists('quality_construction_sidebar_layout')) :
    function quality_construction_sidebar_layout()
    {
        $quality_construction_sidebar_layout = array(
            'right-sidebar' => esc_html__('Right Sidebar', 'quality-construction'),
            'left-sidebar' => esc_html__('Left Sidebar', 'quality-construction'),
            'no-sidebar' => esc_html__('No Sidebar', 'quality-construction'),
        );
        return apply_filters('quality_construction_sidebar_layout', $quality_construction_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return array $quality_construction_blog_excerpt
 *
 */
if (!function_exists('quality_construction_blog_excerpt')) :
    function quality_construction_blog_excerpt()
    {
        $quality_construction_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'quality-construction'),
            'content' => esc_html__('Content', 'quality-construction'),

        );
        return apply_filters('quality_construction_blog_excerpt', $quality_construction_blog_excerpt);
    }
endif;



