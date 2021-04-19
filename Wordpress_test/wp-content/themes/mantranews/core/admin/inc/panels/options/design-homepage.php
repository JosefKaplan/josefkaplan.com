<?php // Readmore Option
/**
 */

$wp_customize->add_section(
    'mantranews_homepage_design_style', array(
        'title' => __('Static Homepage Design', 'mantranews'),
        'description' => __('Static homepage design settings', 'mantranews'),
        'priority' => 30,
        'panel' => 'mantranews_design_settings_panel',
    )
);
$wp_customize->add_setting(
    'mantranews_homepage_sidebar_alignment', array(
        'default' => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'mantranews_homepage_sidebar_alignment', array(
        'type' => 'radio',
        'priority' => 10,
        'label' => __('Homepage Sidebar Position', 'mantranews'),
        'section' => 'mantranews_homepage_design_style',
        'choices' => array(
            'right' => __('Right', 'mantranews'),
            'left' => __('Left', 'mantranews'),
        )
    )
);