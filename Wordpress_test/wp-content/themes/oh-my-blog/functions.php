<?php

require get_stylesheet_directory() . '/sections/homepage-featured-posts.php';
require get_stylesheet_directory() . '/customizer/blog-settings.php';

add_action( 'wp_enqueue_scripts', 'oh_my_blog_chld_thm_parent_css' );
function oh_my_blog_chld_thm_parent_css() {

    $oh_my_blog_theme = wp_get_theme();
    $theme_version = $oh_my_blog_theme->get( 'Version' );

    wp_enqueue_style( 
    	'oh_my_blog_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	),
        $theme_version
    );
    
}

add_filter( 'bizberg_sticky_sidebar_margin_top_status', function(){
    return 30;
});

add_filter( 'bizberg_top_header_status', function(){
    return false;
});

add_action( 'customize_register', 'oh_my_blog_customizer_options', 100 );
function oh_my_blog_customizer_options( $wp_customize ){

    /**
    * Remove sections/panels/control of parent theme
    */
    
    $wp_customize->remove_section("transparent_header");
    $wp_customize->remove_section("progress_bar");

    $wp_customize->remove_control("header_menu_color_hover_sticky_menu");
    $wp_customize->remove_control("header_menu_separator_sticky_menu");
    $wp_customize->remove_control("header_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_2_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_1_sticky_menu");
    $wp_customize->remove_control("header_site_tagline_color_sticky_menu");
    $wp_customize->remove_control("header_site_title_color_sticky_menu");
    $wp_customize->remove_control("header_sticky_menu_options_heading");
    $wp_customize->remove_control("header_menu_child_menu_background_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_border_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_hover_sticky_menu");
    $wp_customize->remove_control("header_button_border_color_sticky_menu");
    $wp_customize->remove_control("header_menu_slide_in_animation");

}

add_filter( 'bizberg_header_2_spacing', 'oh_my_blog_header_2_spacing' );
function oh_my_blog_header_2_spacing(){
    return [
        'padding-top'     => '10px',
        'padding-bottom'  => '30px'
    ];
}

add_filter( 'bizberg_background_color_1', 'oh_my_blog_top_bar_background_1' );
add_filter( 'bizberg_background_color_2', 'oh_my_blog_top_bar_background_1' );
function oh_my_blog_top_bar_background_1(){
    return '#000';
}

add_filter( 'bizberg_top_bar_border_bottom_color', 'oh_my_blog_top_bar_border_bottom_color' );
function oh_my_blog_top_bar_border_bottom_color(){
    return '#2f2f2f';
}

add_filter( 'bizberg_sticky_header_status', 'oh_my_blog_sticky_header_status' );
function oh_my_blog_sticky_header_status(){
    return 'false';
}

add_filter( 'bizberg_homepage_blog_title_font_weight', 'oh_my_blog_homepage_blog_title_font_weight' );
function oh_my_blog_homepage_blog_title_font_weight(){
    return 300;
}

add_filter( 'bizberg_homepage_title_font_size_desktop', 'oh_my_blog_homepage_title_font_size_desktop' );
function oh_my_blog_homepage_title_font_size_desktop(){
    return 45;
}

add_filter( 'bizberg_homepage_title_font_size_tablet', 'oh_my_blog_homepage_title_font_size_tablet' );
function oh_my_blog_homepage_title_font_size_tablet(){
    return 40;
}

add_filter( 'bizberg_homepage_title_font_size_mobile', 'oh_my_blog_homepage_title_font_size_mobile' );
function oh_my_blog_homepage_title_font_size_mobile(){
    return 35;
}

/**
* Change the theme color
*/
add_filter( 'bizberg_theme_color', 'oh_my_blog_change_theme_color' );
function oh_my_blog_change_theme_color(){
    return '#dd3333';
}

/**
* Change the theme background
*/
add_filter( 'bizberg_body_background_image', 'oh_my_blog_body_background_image' );
function oh_my_blog_body_background_image(){
    return [
        'background-color'      => '#000',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ];
}

add_filter( 'bizberg_theme_text_color', 'oh_my_blog_theme_text_color' );
function oh_my_blog_theme_text_color(){
    return '#fff';
}

add_filter( 'bizberg_link_color', 'oh_my_blog_link_color' );
function oh_my_blog_link_color(){
    return '#fff';
}

add_filter( 'bizberg_link_color_hover', 'oh_my_blog_link_color_hover' );
function oh_my_blog_link_color_hover(){
    return '#dd3333';
}

add_filter( 'bizberg_blog_listing_border', 'oh_my_blog_blog_listing_border' );
function oh_my_blog_blog_listing_border(){
    return '#121213';
}

add_filter( 'bizberg_blog_listing_background', 'oh_my_blog_blog_listing_background' );
function oh_my_blog_blog_listing_background(){
    return '#121213';
}

add_filter( 'bizberg_blog_listing_box_shadow', 'oh_my_blog_blog_listing_box_shadow' );
function oh_my_blog_blog_listing_box_shadow(){
    return '#121213';
}

add_filter( 'bizberg_blog_listing_meta_divider_color', 'oh_my_blog_blog_listing_meta_divider_color' );
function oh_my_blog_blog_listing_meta_divider_color(){
    return '#262626';
}

add_filter( 'bizberg_blog_listing_pagination_border', 'oh_my_blog_blog_listing_pagination_border' );
function oh_my_blog_blog_listing_pagination_border(){
    return '#fff';
}

add_filter( 'bizberg_blog_listing_pagination_text', 'oh_my_blog_blog_listing_pagination_text' );
function oh_my_blog_blog_listing_pagination_text(){
    return '#fff';
}

add_filter( 'bizberg_blog_listing_pagination_active_hover_color', 'oh_my_blog_blog_listing_pagination_active_hover_color' );
function oh_my_blog_blog_listing_pagination_active_hover_color(){
    return '#dd3333';
}

add_filter( 'bizberg_sidebar_widget_link_color', 'oh_my_blog_sidebar_widget_link_color' );
function oh_my_blog_sidebar_widget_link_color(){
    return '#fff';
}

add_filter( 'bizberg_sidebar_widget_link_color_hover', 'oh_my_blog_sidebar_widget_link_color_hover' );
function oh_my_blog_sidebar_widget_link_color_hover(){
    return '#dd3333';
}

add_filter( 'bizberg_sidebar_widget_background_color', 'oh_my_blog_sidebar_widget_background_color' );
function oh_my_blog_sidebar_widget_background_color(){
    return '#000';
}

add_filter( 'bizberg_sidebar_widget_border_color', 'oh_my_blog_sidebar_widget_border_color' );
function oh_my_blog_sidebar_widget_border_color(){
    return '#000';
}

add_filter( 'bizberg_sidebar_widget_title_color', 'oh_my_blog_sidebar_widget_title_color' );
function oh_my_blog_sidebar_widget_title_color(){
    return '#dd3333';
}

add_filter( 'bizberg_sidebar_widget_link_separator', 'oh_my_blog_sidebar_widget_link_separator' );
function oh_my_blog_sidebar_widget_link_separator(){
    return '#303030';
}

add_filter( 'bizberg_sidebar_widget_select_color', 'oh_my_blog_sidebar_widget_select_color' );
function oh_my_blog_sidebar_widget_select_color(){
    return '#000';
}

add_filter( 'bizberg_primary_header_layout', 'oh_my_blog_primary_header_layout' );
function oh_my_blog_primary_header_layout(){
    return 'center';
}

add_filter( 'bizberg_site_title_font', 'oh_my_blog_site_title_font' );
function oh_my_blog_site_title_font(){
    return [
        'font-family'    => 'Dancing Script',
        'variant'        => 'regular',
        'font-size'      => '80px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'text-align'     => 'center',
    ];
}

add_filter( 'bizberg_site_tagline_font', 'oh_my_blog_site_tagline_font' );
function oh_my_blog_site_tagline_font(){
    return [
        'font-family'    => 'Open Sans',
        'variant'        => 'regular',
        'font-size'      => '17px',
        'line-height'    => '1.8',
        'letter-spacing' => '2',
        'text-transform' => 'uppercase',
        'text-align'     => 'center',
    ];
}

add_filter( 'bizberg_header_site_title_color', 'oh_my_blog_header_site_title_color' );
function oh_my_blog_header_site_title_color(){
    return '#fff';
}

add_filter( 'bizberg_header_site_title_color_sticky_menu', 'oh_my_blog_header_site_title_color_sticky_menu' );
function oh_my_blog_header_site_title_color_sticky_menu(){
    return '#fff';
}

add_filter( 'bizberg_header_site_tagline_color', 'oh_my_blog_header_site_tagline_color' );
function oh_my_blog_header_site_tagline_color(){
    return '#fff';
}

add_filter( 'bizberg_header_site_tagline_color_sticky_menu', 'oh_my_blog_header_site_tagline_color_sticky_menu' );
function oh_my_blog_header_site_tagline_color_sticky_menu(){
    return '#fff';
}

add_filter( 'bizberg_header_navbar_background_1', 'oh_my_blog_header_navbar_background_1' );
function oh_my_blog_header_navbar_background_1(){
    return '#000';
}

add_filter( 'bizberg_header_navbar_background_2', 'oh_my_blog_header_navbar_background_2' );
function oh_my_blog_header_navbar_background_2(){
    return '#000';
}

add_filter( 'bizberg_header_menu_text_color', 'oh_my_blog_header_menu_text_color' );
function oh_my_blog_header_menu_text_color(){
    return '#fff';
}

add_filter( 'bizberg_header_menu_separator', 'oh_my_blog_header_menu_separator' );
function oh_my_blog_header_menu_separator(){
    return '#000';
}

add_filter( 'bizberg_header_menu_color_hover', 'oh_my_blog_header_menu_color_hover' );
function oh_my_blog_header_menu_color_hover(){
    return '#dd3333';
}

add_filter( 'bizberg_primary_header_layout_bottom_border_size', 'oh_my_blog_primary_header_layout_bottom_border_size' );
function oh_my_blog_primary_header_layout_bottom_border_size(){
    return '1';
}

add_filter( 'bizberg_primary_header_layout_top_border_color', 'oh_my_blog_primary_header_layout_top_border_color' );
add_filter( 'bizberg_primary_header_layout_bottom_border_color', 'oh_my_blog_primary_header_layout_top_border_color' );
function oh_my_blog_primary_header_layout_top_border_color(){
    return '#2f2f2f';
}

add_filter( 'bizberg_blog_detail_content_border_color', 'oh_my_blog_blog_detail_content_border_color' );
add_filter( 'bizberg_blog_detail_content_background', 'oh_my_blog_blog_detail_content_border_color' );
function oh_my_blog_blog_detail_content_border_color(){
    return '#121213';
}

add_filter( 'bizberg_blog_detail_meta_divider_color', 'oh_my_blog_blog_detail_meta_divider_color' );
add_filter( 'bizberg_blog_detail_comment_divider_color', 'oh_my_blog_blog_detail_meta_divider_color' );
add_filter( 'bizberg_blog_detail_comment_input_border_color', 'oh_my_blog_blog_detail_meta_divider_color' );
add_filter( 'bizberg_blog_detail_comment_input_background_color', 'oh_my_blog_blog_detail_meta_divider_color' );
function oh_my_blog_blog_detail_meta_divider_color(){
    return '#262626';
}

add_filter( 'bizberg_heading_color', 'oh_my_blog_heading_color' );
function oh_my_blog_heading_color(){
    return '#fff';
}

add_filter( 'bizberg_body_typo_heading_4_status', 'oh_my_blog_body_typo_heading_4_status' );
function oh_my_blog_body_typo_heading_4_status(){
    return true;
}

add_filter( 'bizberg_typography_h4', 'oh_my_blog_typography_h4' );
function oh_my_blog_typography_h4(){
    return [
        'font-family'    => 'EB Garamond',
        'variant'        => '500',
        'font-size'      => '32.81px',
        'line-height'    => '1.1',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_theme_container_width', 'oh_my_blog_theme_container_width' );
function oh_my_blog_theme_container_width(){
    return 1270;
}

add_filter( 'bizberg_header_menu_toggle_color_mobile', 'oh_my_blog_header_menu_toggle_color_mobile' );
function oh_my_blog_header_menu_toggle_color_mobile(){
    return '#fff';
}

add_filter( 'bizberg_body_content_typo_status', 'oh_my_blog_body_content_typo_status' );
function oh_my_blog_body_content_typo_status(){
    return true;
}

add_filter( 'bizberg_typography_body_content', 'oh_my_blog_typography_body_content' );
function oh_my_blog_typography_body_content(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '300',
        'font-size'      => '16px',
        'line-height'    => '1.8'
    ];
}

add_filter( 'bizberg_body_typo_heading_3_status', 'oh_my_blog_body_typo_heading_3_status' );
function oh_my_blog_body_typo_heading_3_status(){
    return true;
}

add_filter( 'bizberg_typography_h3', 'oh_my_blog_bizberg_typography_h3' );
function oh_my_blog_bizberg_typography_h3(){
    return [
        'font-family'    => 'EB Garamond',
        'variant'        => '500',
        'font-size'      => '41.02px',
        'line-height'    => '1',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

/**
* For Slider
*/

add_filter( 'bizberg_slider_banner_settings', 'oh_my_blog_slider_banner_settings' );
function oh_my_blog_slider_banner_settings(){
    return 'banner';
}

add_filter( 'bizberg_shape_divider_bottom', 'oh_my_blog_shape_divider_bottom' );
function oh_my_blog_shape_divider_bottom(){
    return 'none';
}

add_filter( 'bizberg_slider_title_font_desktop_tablet', 'oh_my_blog_slider_title_font_desktop_tablet' );
function oh_my_blog_slider_title_font_desktop_tablet(){
    return [
        'font-family'    => 'PT Sans',
        'variant'        => '700',
        'font-size'      => '45px',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
        'color'          => '#fff',
        'text-transform' => 'none',
    ];
}

add_filter( 'bizberg_slider_title_box_highlight_color', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_slider_arrow_background_color', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_read_more_background_color', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_read_more_background_color_2', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_slider_dot_active_color', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_header_button_color', 'oh_my_blog_slider_title_box_highlight_color' );
add_filter( 'bizberg_header_button_color_hover', 'oh_my_blog_slider_title_box_highlight_color' );
function oh_my_blog_slider_title_box_highlight_color(){
    return '#dd3333';
}

add_filter( 'bizberg_slider_read_more_font', 'oh_my_blog_slider_read_more_font' );
function oh_my_blog_slider_read_more_font(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '600',
        'font-size'      => '14px',
        'line-height'    => '1.2',
        'letter-spacing' => '0px',
        'color'          => '#fff',
        'text-transform' => 'capitalize'
    ];
}

add_filter( 'bizberg_arrow_style', 'oh_my_blog_bizberg_arrow_style' );
function oh_my_blog_bizberg_arrow_style(){
    return 'diamond';
}

add_filter( 'bizberg_arrow_size', 'oh_my_blog_arrow_size' );
function oh_my_blog_arrow_size(){
    return 50;
}

add_filter( 'bizberg_slider_gradient_primary_color', 'oh_my_blog_slider_gradient_primary_color' );
function oh_my_blog_slider_gradient_primary_color(){
    return 'rgba(20,0,0,0.30)';
}

add_filter( 'bizberg_slider_gradient_secondary_color', 'oh_my_blog_slider_gradient_secondary_color' );
function oh_my_blog_slider_gradient_secondary_color(){
    return 'rgba(221,51,51,0.3)';
}

add_filter( 'bizberg_header_menu_child_menu_background', 'oh_my_blog_header_menu_child_menu_background' );
add_filter( 'bizberg_header_menu_child_menu_border', 'oh_my_blog_header_menu_child_menu_background' );
function oh_my_blog_header_menu_child_menu_background(){
    return '#121213';
}

add_filter( 'bizberg_header_menu_child_menu_text_color', 'oh_my_blog_header_menu_child_menu_text_color' );
function oh_my_blog_header_menu_child_menu_text_color(){
    return '#fff';
}

add_filter( 'bizberg_header_menu_child_menu_border', 'oh_my_blog_header_menu_child_menu_border' );
function oh_my_blog_header_menu_child_menu_border(){
    return 'rgba(37,37,38,0.57)';
}

add_filter( 'bizberg_header_navbar_background_1_sticky_menu', 'oh_my_blog_header_navbar_background_1_sticky_menu' );
add_filter( 'bizberg_header_navbar_background_2_sticky_menu', 'oh_my_blog_header_navbar_background_1_sticky_menu' );
add_filter( 'bizberg_header_menu_separator_sticky_menu', 'oh_my_blog_header_navbar_background_1_sticky_menu' );
function oh_my_blog_header_navbar_background_1_sticky_menu(){
    return '#dd3333';
}

add_filter( 'bizberg_header_menu_text_color_sticky_menu', 'oh_my_blog_header_menu_text_color_sticky_menu' );
function oh_my_blog_header_menu_text_color_sticky_menu(){
    return '#fff';
}

add_filter( 'bizberg_header_menu_color_hover_sticky_menu', 'oh_my_blog_header_menu_color_hover_sticky_menu' );
function oh_my_blog_header_menu_color_hover_sticky_menu(){
    return '#c71d1d';
}

add_filter( 'bizberg_header_menu_child_menu_background_sticky_menu', 'oh_my_blog_header_menu_child_menu_background_sticky_menu' );
function oh_my_blog_header_menu_child_menu_background_sticky_menu(){
    return '#dd3333';
}

add_filter( 'bizberg_header_menu_child_menu_border_sticky_menu', 'oh_my_blog_header_menu_child_menu_border_sticky_menu' );
function oh_my_blog_header_menu_child_menu_border_sticky_menu(){
    return '#df4343';
}

add_filter( 'bizberg_header_menu_child_menu_text_color_sticky_menu', 'oh_my_blog_header_menu_child_menu_text_color_sticky_menu' );
function oh_my_blog_header_menu_child_menu_text_color_sticky_menu(){
    return '#fff';
}

add_filter( 'bizberg_blog_detail_comment_input_text_color', 'oh_my_blog_blog_detail_comment_input_text_color' );
function oh_my_blog_blog_detail_comment_input_text_color(){
    return '#fff';
}

add_filter( 'bizberg_header_columns_middle_style', 'oh_my_blog_header_columns_middle_style' );
function oh_my_blog_header_columns_middle_style(){
    return 'col-sm-2|col-sm-8|col-sm-2';
}

add_filter( 'bizberg_footer_social_icon_color', 'oh_my_blog_footer_social_icon_color' );
function oh_my_blog_footer_social_icon_color(){
    return '#dd3333';
}

add_filter( 'bizberg_footer_copyright_background', 'oh_my_blog_footer_copyright_background' );
function oh_my_blog_footer_copyright_background(){
    return '#b11a1a';
}

add_filter( 'bizberg_banner_image', 'oh_my_blog_banner_image' );
function oh_my_blog_banner_image(){
    return [
        'background-color'      => 'rgba(20,20,20,.8)',
        'background-image'      => get_stylesheet_directory_uri() . '/images/man-person-black-and-white-people-white-photography-922038-pxhere.com.jpg',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ];
}

add_filter( 'bizberg_banner_spacing', 'oh_my_blog_banner_spacing' );
function oh_my_blog_banner_spacing(){
    return [
        'padding-top'    => '165px',
        'padding-bottom' => '165px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ];
}

add_filter( 'bizberg_banner_text_position', 'oh_my_blog_banner_text_position' );
function oh_my_blog_banner_text_position(){
    return 'left';
}

add_filter( 'bizberg_typography_h1', 'oh_my_blog_typography_h1' );
function oh_my_blog_typography_h1(){
    return [
        'font-family'    => 'EB Garamond',
        'variant'        => '500',
        'font-size'      => '64.09px',
        'line-height'    => '1.1',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_body_typo_heading_2_status', 'oh_my_blog_body_typo_heading_2_status' );
function oh_my_blog_body_typo_heading_2_status(){
    return true;
}

add_filter( 'bizberg_typography_h2', 'oh_my_blog_typography_h2' );
function oh_my_blog_typography_h2(){
    return [
        'font-family'    => 'EB Garamond',
        'variant'        => '500',
        'font-size'      => '51.27px',
        'line-height'    => '1',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_body_typo_heading_1_status', 'oh_my_blog_body_typo_heading_1_status' );
function oh_my_blog_body_typo_heading_1_status(){
    return true;
}

add_filter( 'bizberg_banner_title', 'oh_my_blog_banner_title' );
function oh_my_blog_banner_title(){
    return current_user_can( 'edit_theme_options' ) ? esc_html__( 'Martin Peterson' , 'oh-my-blog' ) : '';
}

add_filter( 'bizberg_banner_subtitle', 'oh_my_blog_banner_subtitle' );
function oh_my_blog_banner_subtitle(){
    return current_user_can( 'edit_theme_options' ) ? esc_html__( "Lorem Ipsum has been the industry's standard dummy" , 'oh-my-blog' ) : '';
}

add_filter( 'bizberg_sidebar_spacing_status', 'oh_my_blog_sidebar_spacing_status' );
function oh_my_blog_sidebar_spacing_status(){
    return '0px';
}

add_filter( 'bizberg_theme_output_css', 'oh_my_blog_theme_output_css' );
function oh_my_blog_theme_output_css( $output ){

    $output[] = array(
        'element'  => '.primary_header_2 a.logo:focus h3,.primary_header_2 a.logo:focus p',
        'property' => 'color'
    );

    $output[] = array(
        'element'  => '.detail-content.single_page a, .bizberg-list .entry-content p a, .comment-list .comment-content a, .widget_text.widget a, #comments ul.comment-item li .comment-header > a:focus',
        'property' => 'color'
    );

    $output[] = array(
        'element'  => '.detail-content.single_page .bizberg_post_date a:after, #comments a:focus code',
        'property' => 'background'
    );

    return $output;

}

add_filter( 'bizberg_recommended_plugins', 'oh_my_blog_recommended_plugins' );
function oh_my_blog_recommended_plugins( $plugins ){

    $plugins = array(

        array(
            'name'     => esc_html__( 'One Click Demo Import', 'oh-my-blog' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name'     => esc_html__( 'Cyclone Demo Importer', 'oh-my-blog' ),
            'slug'     => 'cyclone-demo-importer',
            'required' => false
        )

    );

    return $plugins;

}

add_filter( 'bizberg_plugins', function( $plugins ){

    $plugins = array(
        array(
            'slug' => 'one-click-demo-import/one-click-demo-import.php',
            'zip'  => 'one-click-demo-import'
        ), 
        array(
            'slug' => 'cyclone-demo-importer/index.php',
            'zip'  => 'cyclone-demo-importer'
        )           
    );

    return $plugins;

}, 999 );

add_filter( 'bizberg_sidebar_widget_heading_font_size_status', 'oh_my_blog_sidebar_widget_heading_font_size_status' );
function oh_my_blog_sidebar_widget_heading_font_size_status(){
    return true;
}

add_filter( 'bizberg_number_setting_desktop_sidebar_widget_heading_font_sizes', 'oh_my_blog_number_setting_desktop_sidebar_widget_heading_font_sizes' );
function oh_my_blog_number_setting_desktop_sidebar_widget_heading_font_sizes(){
    return 32.81;
}

add_filter( 'bizberg_number_setting_tablet_sidebar_widget_heading_font_sizes', 'oh_my_blog_number_setting_tablet_sidebar_widget_heading_font_sizes' );
function oh_my_blog_number_setting_tablet_sidebar_widget_heading_font_sizes(){
    return 29.69;
}

add_filter( 'bizberg_number_setting_mobile_sidebar_widget_heading_font_sizes', 'oh_my_blog_number_setting_mobile_sidebar_widget_heading_font_sizes' );
function oh_my_blog_number_setting_mobile_sidebar_widget_heading_font_sizes(){
    return 23.44;
}