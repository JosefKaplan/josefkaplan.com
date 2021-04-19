<?php // Readmore Option
/**
 */

$wp_customize->add_section(
    'mantranews_readmore_design_style', array(
        'title' => __('Readmore Option', 'mantranews'),
        'description' => __('Readmore Style', 'mantranews'),
        'priority' => 28,
        'panel' => 'mantranews_design_settings_panel',
    )
);
$wp_customize->add_setting(
    'mantranews_readmore_design_option', array(
        'default' => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'mantranews_readmore_design_option', array(
        'type' => 'radio',
        'priority' => 10,
        'label' => __('Readmore Option', 'mantranews'),
        'section' => 'mantranews_readmore_design_style',
        'choices' => array(
            'default' => __('Show WordPress Default', 'mantranews'),
            'always-show' => __('Always show readmore', 'mantranews'),
        )
    )
);