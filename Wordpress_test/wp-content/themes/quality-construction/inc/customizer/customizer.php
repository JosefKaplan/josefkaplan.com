<?php
/**
 * HomePage Settings Panel on customizer
 */
$wp_customize->add_panel(
    'quality_construction_homepage_settings_panel',
    array(
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('HomePage Slider Settings', 'quality-construction'),
    )
);

/*-------------------------------------------------------------------------------------------------*/
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'quality_construction_slider_section',
    array(
        'title' => esc_html__('Slider Section', 'quality-construction'),
        'panel' => 'quality_construction_homepage_settings_panel',
        'priority' => 6,
    )
);

/**
 * Show/Hide option for Homepage Slider Section
 *
 */

$wp_customize->add_setting(
    'quality_construction_homepage_slider_option',
    array(
        'default' => $default['quality_construction_homepage_slider_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
    )
);
$hide_show_option = quality_construction_slider_option();
$wp_customize->add_control(
    'quality_construction_homepage_slider_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Slider Option', 'quality-construction'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'quality-construction'),
        'section' => 'quality_construction_slider_section',
        'choices' => $hide_show_option,
        'priority' => 7
    )
);

/**
 * Dropdown available category for homepage slider
 *
 */
$wp_customize->add_setting(
    'quality_construction_slider_cat_id',
    array(
        'default' => $default['quality_construction_slider_cat_id'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new Quality_Construction_Customize_Category_Control(
        $wp_customize,
        'quality_construction_slider_cat_id',
        array(
            'label' => esc_html__('Slider Category', 'quality-construction'),
            'description' => esc_html__('Select Category for Homepage Slider Section', 'quality-construction'),
            'section' => 'quality_construction_slider_section',
            'priority' => 8,

        )
    )
);


/**
 * Field for no of posts to display..
 *
 */
$wp_customize->add_setting(
    'quality_construction_no_of_slider',
    array(
        'default' => $default['quality_construction_no_of_slider'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'quality_construction_no_of_slider',
    array(
        'type' => 'number',
        'label' => esc_html__('No of Slider', 'quality-construction'),
        'section' => 'quality_construction_slider_section',
        'priority' => 10
    )
);


/**
 * Field for Get Started button text
 *
 */
$wp_customize->add_setting(
    'quality_construction_slider_get_started_txt',
    array(
        'default' => $default['quality_construction_slider_get_started_txt'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'quality_construction_slider_get_started_txt',
    array(
        'type' => 'text',
        'label' => esc_html__('Get Started Button', 'quality-construction'),
        'section' => 'quality_construction_slider_section',
        'priority' => 11
    )
);

/**
 * Field for Get Started button Link
 *
 */
$wp_customize->add_setting(
    'quality_construction_slider_get_started_link',
    array(
        'default' => $default['quality_construction_slider_get_started_link'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'quality_construction_slider_get_started_link',
    array(
        'type' => 'url',
        'label' => esc_html__('Get Started Button Link', 'quality-construction'),
        'description' => esc_html__('Use full url link', 'quality-construction'),
        'section' => 'quality_construction_slider_section',
        'priority' => 20
    )
);

/*----------------------------------------------------------------------------------------------*/
	

/**
 * Field for View More Button Text
 *
 */
$wp_customize->add_setting(
    'quality_construction_slider_view_more_txt',
    array(
        'default' => $default['quality_construction_slider_view_more_txt'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'quality_construction_slider_view_more_txt',
    array(
        'type' => 'text',
        'label' => esc_html__('View More', 'quality-construction'),
        'section' => 'quality_construction_slider_section',
        'priority' => 25
    )
);    