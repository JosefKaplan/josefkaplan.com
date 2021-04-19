<?php
/**
 * Customizer option for Design Settings
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action('customize_register', 'mantranews_design_settings_register');

function mantranews_design_settings_register($wp_customize)
{

    /**
     * Add Design Panel
     */
    $wp_customize->add_panel(
        'mantranews_design_settings_panel',
        array(
            'priority' => 6,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Design Settings', 'mantranews'),
        )
    );

    /*--------------------------------------------------------------------------------*/
    /**
     * Archive page Settings
     */
    $wp_customize->add_section(
        'mantranews_archive_section',
        array(
            'title' => esc_html__('Archive Settings', 'mantranews'),
            'priority' => 10,
            'panel' => 'mantranews_design_settings_panel'
        )
    );

    // Archive page sidebar
    $wp_customize->add_setting(
        'mantranews_archive_sidebar',
        array(
            'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_page_layout_sanitize',
        )
    );

    $wp_customize->add_control(new Mantranews_Image_Radio_Control(
            $wp_customize,
            'mantranews_archive_sidebar',
            array(
                'type' => 'radio',
                'label' => esc_html__('Available Sidebars', 'mantranews'),
                'description' => esc_html__('Select sidebar for whole site archives, categories, search page etc.', 'mantranews'),
                'section' => 'mantranews_archive_section',
                'priority' => 4,
                'choices' => array(
                    'right_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
                    'left_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
                    'no_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
                    'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
                )
            )
        )
    );

    //Archive page layouts
    $wp_customize->add_setting(
        'mantranews_archive_layout',
        array(
            'default' => 'classic',
            'sanitize_callback' => 'mantranews_sanitize_archive_layout',
        )
    );
    $wp_customize->add_control(
        'mantranews_archive_layout',
        array(
            'type' => 'radio',
            'label' => esc_html__('Archive Page Layout', 'mantranews'),
            'description' => esc_html__('Choose available layout for all archive pages.', 'mantranews'),
            'section' => 'mantranews_archive_section',
            'choices' => array(
                'classic' => esc_html__('Classic Layout', 'mantranews'),
                'columns' => esc_html__('Columns Layout', 'mantranews')
            ),
            'priority' => 5
        )
    );

    /*--------------------------------------------------------------------------------*/
    /**
     * Single post Settings
     */
    $wp_customize->add_section(
        'mantranews_single_post_section',
        array(
            'title' => esc_html__('Post Settings', 'mantranews'),
            'priority' => 15,
            'panel' => 'mantranews_design_settings_panel'
        )
    );

    // Archive page sidebar
    $wp_customize->add_setting(
        'mantranews_default_post_sidebar',
        array(
            'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_page_layout_sanitize',
        )
    );

    $wp_customize->add_control(new Mantranews_Image_Radio_Control(
            $wp_customize,
            'mantranews_default_post_sidebar',
            array(
                'type' => 'radio',
                'label' => esc_html__('Available Sidebars', 'mantranews'),
                'description' => esc_html__('Select sidebar for whole single post page.', 'mantranews'),
                'section' => 'mantranews_single_post_section',
                'priority' => 4,
                'choices' => array(
                    'right_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
                    'left_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
                    'no_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
                    'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
                )
            )
        )
    );

    //Author box
    $wp_customize->add_setting(
        'mantranews_author_box_option',
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_show_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_author_box_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Author Option', 'mantranews'),
                'description' => esc_html__('Enable/disable author information at single post page.', 'mantranews'),
                'priority' => 5,
                'section' => 'mantranews_single_post_section',
                'choices' => array(
                    'show' => esc_html__('Show', 'mantranews'),
                    'hide' => esc_html__('Hide', 'mantranews')
                )
            )
        )
    );

    //Related Articles
    $wp_customize->add_setting(
        'mantranews_related_articles_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_related_articles_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Related Articles Option', 'mantranews'),
                'description' => esc_html__('Enable/disable related articles section at single post page.', 'mantranews'),
                'priority' => 7,
                'section' => 'mantranews_single_post_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                )
            )
        )
    );

    //Related articles section title
    $wp_customize->add_setting(
        'mantranews_related_articles_title',
        array(
            'default' => esc_html__('Related Articles', 'mantranews'),
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_related_articles_title',
        array(
            'type' => 'text',
            'label' => esc_html__('Section Title', 'mantranews'),
            'section' => 'mantranews_single_post_section',
            'active_callback' => 'mantranews_related_articles_option_callback',
            'priority' => 8
        )
    );

    // Types of Related articles
    $wp_customize->add_setting(
        'mantranews_related_articles_type',
        array(
            'default' => 'category',
            'sanitize_callback' => 'mantranews_sanitize_related_type',
        )
    );
    $wp_customize->add_control(
        'mantranews_related_articles_type',
        array(
            'type' => 'radio',
            'label' => esc_html__('Types of Related Articles', 'mantranews'),
            'description' => esc_html__('Option to display related articles from category/tags.', 'mantranews'),
            'section' => 'mantranews_single_post_section',
            'choices' => array(
                'category' => esc_html__('by Category', 'mantranews'),
                'tag' => esc_html__('by Tags', 'mantranews')
            ),
            'active_callback' => 'mantranews_related_articles_option_callback',
            'priority' => 9
        )
    );
    /*--------------------------------------------------------------------------------*/
    /**
     * Single page Settings
     */
    $wp_customize->add_section(
        'mantranews_single_page_section',
        array(
            'title' => esc_html__('Page Settings', 'mantranews'),
            'priority' => 20,
            'panel' => 'mantranews_design_settings_panel'
        )
    );

    // Archive page sidebar
    $wp_customize->add_setting(
        'mantranews_default_page_sidebar',
        array(
            'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_page_layout_sanitize',
        )
    );

    $wp_customize->add_control(new Mantranews_Image_Radio_Control(
            $wp_customize,
            'mantranews_default_page_sidebar',
            array(
                'type' => 'radio',
                'label' => esc_html__('Available Sidebars', 'mantranews'),
                'description' => esc_html__('Select sidebar for whole single page.', 'mantranews'),
                'section' => 'mantranews_single_page_section',
                'priority' => 4,
                'choices' => array(
                    'right_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
                    'left_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
                    'no_sidebar' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
                    'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
                )
            )
        )
    );

    // Mantranews Header Style

    $wp_customize->add_section(
        'mantranews_header_style', array(
            'title' => __('Header Style', 'mantranews'),
            'description' => __('Choose header layout style.', 'mantranews'),
            'priority' => 22,
            'panel' => 'mantranews_design_settings_panel',
        )
    );


    /**
     * Parallax Feature for header
     * @package Mantrabrain
     * @subpackage mantranews
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'mantranews_parallax_header',
        array(
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'mantranews_parallax_header',
            array(
                'priority' => 7,
                'label' => esc_html__('Upload image for parallax header', 'mantranews'),
                'description' => esc_html__('Upload background image for header parallax background.', 'mantranews'),
                'section' => 'mantranews_header_style',
                'settings' => 'mantranews_parallax_header',
                'panel' => 'mantranews_design_settings_panel'
            )
        )
    );

    // Hero Parallax Starting

    //Hero Parallax
    $wp_customize->add_setting(
        'mantranews_enable_hero_parallax',
        array(
            'default' => 'disable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_enable_hero_parallax',
            array(
                'type' => 'switch',
                'label' => esc_html__('Enable Hero parallax option', 'mantranews'),
                'description' => esc_html__('Enable/disable hero parallax on header.', 'mantranews'),
                'priority' => 8,
                'section' => 'mantranews_header_style',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                ),
                'active_callback' => 'mantranews_is_parallax_header_enable'
            )
        )
    );


    //Only Show Hero Parallax in Home Page

    $wp_customize->add_setting(
        'mantranews_enable_hero_parallax_on_all_pages',
        array(
            'default' => 'disable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_enable_hero_parallax_on_all_pages',
            array(
                'type' => 'switch',
                'label' => esc_html__('Enable Hero parallax on all pages', 'mantranews'),
                'description' => esc_html__('Enable/disable hero parallax on header on all pages.', 'mantranews'),
                'priority' => 9,
                'section' => 'mantranews_header_style',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                ),
                'active_callback' => 'mantranews_is_parallax_header_enable'
            )
        )
    );

    //Hero Parallax Heading
    $wp_customize->add_setting(
        'mantranews_hero_parallax_heading',
        array(
            'default' => esc_html__('This is hero parallax heading text.', 'mantranews'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_hero_parallax_heading',
        array(
            'type' => 'text',
            'label' => esc_html__('Hero Parallax Heading Title', 'mantranews'),
            'section' => 'mantranews_header_style',
            'active_callback' => 'mantranews_is_hero_parallax_enabled',
            'priority' => 10
        )
    );

    //Hero Parallax SubHeading
    $wp_customize->add_setting(
        'mantranews_hero_parallax_subheading',
        array(
            'default' => esc_html__('This is hero parallax sub heading text.', 'mantranews'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_hero_parallax_subheading',
        array(
            'type' => 'text',
            'label' => esc_html__('Hero Parallax Sub Heading Title', 'mantranews'),
            'section' => 'mantranews_header_style',
            'active_callback' => 'mantranews_is_hero_parallax_enabled',
            'priority' => 11
        )
    );

    //Hero Parallax Button Text
    $wp_customize->add_setting(
        'mantranews_hero_parallax_button_text',
        array(
            'default' => esc_html__('Button Text', 'mantranews'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_hero_parallax_button_text',
        array(
            'type' => 'text',
            'label' => esc_html__('Hero Parallax Button Text', 'mantranews'),
            'section' => 'mantranews_header_style',
            'active_callback' => 'mantranews_is_hero_parallax_enabled',
            'priority' => 12
        )
    );

    //Hero Parallax Button URL
    $wp_customize->add_setting(
        'mantranews_hero_parallax_button_url',
        array(
            'default' => esc_url('https://mantrabrain.com/', 'mantranews'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url',
        )
    );
    $wp_customize->add_control(
        'mantranews_hero_parallax_button_url',
        array(
            'type' => 'text',
            'label' => esc_html__('Hero Parallax Button URL', 'mantranews'),
            'section' => 'mantranews_header_style',
            'active_callback' => 'mantranews_is_hero_parallax_enabled',
            'priority' => 13
        )
    );

    // End of Hero Parallax

    /*--------------------------------------------------------------------------------------------------------*/
    /**
     * Footer widget area
     */
    $wp_customize->add_section(
        'mantranews_footer_widget_section',
        array(
            'title' => esc_html__('Footer Settings', 'mantranews'),
            'priority' => 25,
            'panel' => 'mantranews_design_settings_panel'
        )
    );
    // Footer widget area
    $wp_customize->add_setting(
        'footer_widget_option',
        array(
            'default' => 'column3',
            'sanitize_callback' => 'mantranews_footer_widget_sanitize',
        )
    );
    $wp_customize->add_control(
        'footer_widget_option',
        array(
            'type' => 'radio',
            'priority' => 4,
            'label' => esc_html__('Footer Widget Area', 'mantranews'),
            'description' => esc_html__('Choose option to display number of columns in footer area.', 'mantranews'),
            'section' => 'mantranews_footer_widget_section',
            'choices' => array(
                'column1' => esc_html__('One Column', 'mantranews'),
                'column2' => esc_html__('Two Columns', 'mantranews'),
                'column3' => esc_html__('Three Columns', 'mantranews'),
                'column4' => esc_html__('Four Columns', 'mantranews'),
            ),
        )
    );

    //Copyright text
    $wp_customize->add_setting(
        'mantranews_copyright_text',
        array(
            'default' => esc_html__('2019 mantranews', 'mantranews'),
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_copyright_text',
        array(
            'type' => 'text',
            'label' => esc_html__('Copyright Info', 'mantranews'),
            'section' => 'mantranews_footer_widget_section',
            'priority' => 5
        )
    );

    //Website Skin
    $wp_customize->add_section(
        'mantranews_website_skin_section',
        array(
            'title' => esc_html__('Website Skin', 'mantranews'),
            'priority' => 26,
            'panel' => 'mantranews_design_settings_panel'
        )
    );
    // Website Skin Setting
    $wp_customize->add_setting(
        'website_skin_option',
        array(
            'default' => 'default_skin',
            'sanitize_callback' => 'mantranews_website_skin_sanitize',
        )
    );
    $wp_customize->add_control(
        'website_skin_option',
        array(
            'type' => 'radio',
            'priority' => 4,
            'label' => esc_html__('Choose Website Skin', 'mantranews'),
            'description' => esc_html__('Choose the  skin color for your site.', 'mantranews'),
            'section' => 'mantranews_website_skin_section',
            'choices' => array(
                'default_skin' => esc_html__('Default', 'mantranews'),
                'dark_skin' => esc_html__('Dark Skin', 'mantranews'),
            ),
        )
    );
    /* --------------------------------------------------------------------------------------------------------------- */
    /**
     * Title Style
     */
    $wp_customize->add_section(
        'mantranews_site_title_design', array(
            'title' => __('Title Style', 'mantranews'),
            'description' => __('Design option of title style', 'mantranews'),
            'priority' => 26,
            'panel' => 'mantranews_design_settings_panel',
        )
    );
    $wp_customize->add_setting(
        'site_title_design_options', array(
            'default' => 'plain',
            'sanitize_callback' => 'mantranews_sanitize_title_design',
        )
    );
    $wp_customize->add_control(
        'site_title_design_options', array(
            'type' => 'radio',
            'priority' => 10,
            'label' => __('Title design styles', 'mantranews'),
            'section' => 'mantranews_site_title_design',
            'choices' => mantranews_site_title_design(),
        )
    );

    include_once "options/design-readmore.php";

    include_once "options/design-homepage.php";
    // Title case design
    /**
     */
    $wp_customize->add_section(
        'mantranews_site_title_case_design', array(
            'title' => __('Title font case', 'mantranews'),
            'description' => __('Design of font case style', 'mantranews'),
            'priority' => 27,
            'panel' => 'mantranews_design_settings_panel',
        )
    );
    $wp_customize->add_setting(
        'site_title_case_design_options', array(
            'default' => 'none',
            'sanitize_callback' => 'mantranews_sanitize_title_case_design',
        )
    );
    $wp_customize->add_control(
        'site_title_case_design_options', array(
            'type' => 'radio',
            'priority' => 10,
            'label' => __('Title font case styles', 'mantranews'),
            'section' => 'mantranews_site_title_design',
            'choices' => mantranews_site_title_design_case(),
        )
    );


}
