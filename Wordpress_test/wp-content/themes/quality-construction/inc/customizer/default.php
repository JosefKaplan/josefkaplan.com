<?php
/**
 * Quality Construction default theme options.
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */

if ( !function_exists('quality_construction_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function quality_construction_get_default_theme_options()
    {

        $default = array();

        // Homepage Slider Section
        $default['quality_construction_homepage_slider_option'] = 'hide';
        $default['quality_construction_slider_cat_id'] = 0;
        $default['quality_construction_no_of_slider'] = 3;
        $default['quality_construction_slider_get_started_txt'] = esc_html__('Get Started!', 'quality-construction');
        $default['quality_construction_slider_view_more_txt'] = esc_html__('View More', 'quality-construction');
        $default['quality_construction_slider_get_started_link'] = '#';

        // footer copyright.
        $default['quality_construction_copyright'] = esc_html__('Copyright All Rights Reserved', 'quality-construction');

        // Home Page Top header Info.
        $default['quality_construction_top_header_section'] = 'hide';
        $default['quality_construction_top_header_section_phone_number_icon'] = 'fa-phone';
        $default['quality_construction_top_header_phone_no'] = '';
        $default['quality_construction_email_icon'] = 'fa-envelope-o';
        $default['quality_construction_top_header_email'] = '';
        $default['quality_construction_social_link_hide_option'] = 0;

        // Blog.
        $default['quality_construction_sidebar_layout_option'] = 'right-sidebar';
        $default['quality_construction_blog_title_option'] = esc_html__('Latest Blog', 'quality-construction');
        $default['quality_construction_blog_excerpt_option'] = 'excerpt';
        $default['quality_construction_description_length_option'] = 40;
        $default['quality_construction_exclude_cat_blog_archive_option'] = '';
        $default['quality_construction_read_more_text_blog_archive_option'] = esc_html__('Read More', 'quality-construction');

        // Details page.
        $default['quality_construction_show_feature_image_single_option'] = 'show';

        // Color Option.
        $default['quality_construction_primary_color'] = '#EEB500';
        $default['quality_construction_top_header_background_color'] = '#ffffff';
        $default['quality_construction_top_footer_background_color'] = '#1A1E21';
        $default['quality_construction_bottom_footer_background_color'] = '#111315';
        $default['quality_construction_front_page_hide_option'] = 0;
        $default['quality_construction_breadcrumb_setting_option'] = 'enable';
        $default['quality_construction_post_search_placeholder_option'] = esc_html__('Search', 'quality-construction');
        $default['quality_construction_hide_breadcrumb_front_page_option'] = 1;
        $default['quality_construction_color_reset_option'] = 'do-not-reset';
        $default['quality_construction_remove_stikcy_menu'] = 0;
        // Pass through filter.
        $default = apply_filters( 'quality_construction_get_default_theme_options', $default );
        return $default;
    }
endif;
