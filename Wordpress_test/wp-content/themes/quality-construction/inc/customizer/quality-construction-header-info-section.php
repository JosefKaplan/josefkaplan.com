<?php
/**
 * Quality Construction Header Info Section
 *
 */
$wp_customize->add_section(
    'quality_construction_top_header_info_section',
    array(
        'priority' => 6,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Top Header Info', 'quality-construction'),
    )
);

$wp_customize->add_setting(
    'quality_construction_top_header_section',
    array(
        'default' => $default['quality_construction_top_header_section'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
    )
);

$hide_show_top_header_option = quality_construction_slider_option();
$wp_customize->add_control(
    'quality_construction_top_header_section',
    array(
        'type' => 'radio',
        'label' => esc_html__('Top Header Info Option', 'quality-construction'),
        'description' => esc_html__('Show/hide Option for Top Header Info Section.', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'choices' => $hide_show_top_header_option,
        'priority' => 5
    )
);

/**
 * Field for Font Awesome Icon
 *
 */
$wp_customize->add_setting(
    'quality_construction_top_header_section_phone_number_icon',
    array(
        'default' => $default['quality_construction_top_header_section_phone_number_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'quality_construction_top_header_section_phone_number_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Class Name', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'priority' => 6
    )
);

/**
 * Field for Top Header Phone Number
 *
 */
$wp_customize->add_setting(
    'quality_construction_top_header_phone_no',
    array(
        'default' => $default['quality_construction_top_header_phone_no'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'quality_construction_top_header_phone_no',
    array(
        'type' => 'text',
        'label' => esc_html__('Phone Number', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'priority' => 8
    )
);

/**
 * Field for Fonsome Icon
 *
 */
$wp_customize->add_setting(
    'quality_construction_email_icon',
    array(
        'default' => $default['quality_construction_email_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'quality_construction_email_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Class Name', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'priority' => 8
    )
);

/**
 * Field for Top Header Email Address
 *
 */
$wp_customize->add_setting(
    'quality_construction_top_header_email',
    array(
        'default' => $default['quality_construction_top_header_email'],
        'sanitize_callback' => 'sanitize_email',
    )
);
$wp_customize->add_control(
    'quality_construction_top_header_email',
    array(
        'type' => 'email',
        'label' => esc_html__('Email Address', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'priority' => 8
    )
);


/**
 *   Show/Hide Social Link
 */
$wp_customize->add_setting(
    'quality_construction_social_link_hide_option',
    array(
        'default' => $default['quality_construction_social_link_hide_option'],
        'sanitize_callback' => 'quality_construction_sanitize_checkbox',
    )
);
$wp_customize->add_control('quality_construction_social_link_hide_option',
    array(
        'label' => esc_html__('Hide/Show Social Menu', 'quality-construction'),
        'section' => 'quality_construction_top_header_info_section',
        'type' => 'checkbox',
        'priority' => 10
    )
);