<?php
/**
 * Copyright Info Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_copyright_info_section',
    array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Footer Option', 'quality-construction'),
    )
);

/**
 * Field for Copyright
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'quality_construction_copyright',
    array(
        'default' => $default['quality_construction_copyright'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'quality_construction_copyright',
    array(
        'type' => 'text',
        'label' => esc_html__('Copyright', 'quality-construction'),
        'section' => 'quality_construction_copyright_info_section',
        'priority' => 8
    )
);

