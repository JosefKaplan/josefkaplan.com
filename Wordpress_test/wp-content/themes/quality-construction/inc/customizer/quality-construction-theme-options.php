<?php
/**
 * Theme Option
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'quality_construction_theme_options',
    array(
        'priority' => 7,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Theme Option', 'quality-construction'),
    )
);



/*----------------------------------------------------------------------------------------------*/
/**
 * Color Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_sticky_menu_option',
    array(
        'title' => esc_html__('Sticky Menu Options', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 6,
    )
);

$wp_customize->add_setting(
    'quality_construction_remove_stikcy_menu',
    array(
        'default' => $default['quality_construction_remove_stikcy_menu'],
        'sanitize_callback' => 'quality_construction_sanitize_checkbox',
    )
);


$wp_customize->add_control('quality_construction_remove_stikcy_menu',
    array(
        'label' => esc_html__('Remove Sticky Menu', 'quality-construction'),
         'section' => 'quality_construction_sticky_menu_option',
        'type' => 'checkbox',
        'priority' => 10
    )
);



/*----------------------------------------------------------------------------------------------*/
/**
 * Color Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_primary_color_option',
    array(
        'title' => esc_html__('Color Options', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 6,
    )
);

$wp_customize->add_setting(
    'quality_construction_primary_color',
    array(
        'default' => $default['quality_construction_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'quality_construction_primary_color', array(
    'label' => esc_html__('Primary Color', 'quality-construction'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'quality-construction'),
    'section' => 'quality_construction_primary_color_option',
    'priority' => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Top Header Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'quality_construction_top_header_background_color',
    array(
        'default' => $default['quality_construction_top_header_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'quality_construction_top_header_background_color', array(
    'label' => esc_html__('Top Header Background Color', 'quality-construction'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'quality-construction'),
    'section' => 'quality_construction_primary_color_option',
    'priority' => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Top Footer Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'quality_construction_top_footer_background_color',
    array(
        'default' => $default['quality_construction_top_footer_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'quality_construction_top_footer_background_color', array(
    'label' => esc_html__('Top Footer Background Color', 'quality-construction'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'quality-construction'),
    'section' => 'quality_construction_primary_color_option',
    'priority' => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Bottom Footer Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'quality_construction_bottom_footer_background_color',
    array(
        'default' => $default['quality_construction_bottom_footer_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'quality_construction_bottom_footer_background_color', array(
    'label' => esc_html__('Bottom Footer Background Color', 'quality-construction'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'quality-construction'),
    'section' => 'quality_construction_primary_color_option',
    'priority' => 14,

)));


/*-------------------------------------------------------------------------------------------*/
/**
 * Hide Static page in Home page
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_front_page_option',
    array(
        'title' => esc_html__('Front Page Options', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 6,
    )
);

/**
 *   Show/Hide Static page/Posts in Home page
 */
$wp_customize->add_setting(
    'quality_construction_front_page_hide_option',
    array(
        'default' => $default['quality_construction_front_page_hide_option'],
        'sanitize_callback' => 'quality_construction_sanitize_checkbox',
    )
);
$wp_customize->add_control('quality_construction_front_page_hide_option',
    array(
        'label' => esc_html__('Hide Blog Posts or Static Page on Front Page', 'quality-construction'),
        'section' => 'quality_construction_front_page_option',
        'type' => 'checkbox',
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Breadcrumb Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_breadcrumb_option',
    array(
        'title' => esc_html__('Breadcrumb Options', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 6,
    )
);

/**
 * Breadcrumb Option
 */
$wp_customize->add_setting(
    'quality_construction_breadcrumb_setting_option',
    array(
        'default' => $default['quality_construction_breadcrumb_setting_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',

    )
);
$hide_show_breadcrumb_option = quality_construction_show_breadcrumb_option();
$wp_customize->add_control('quality_construction_breadcrumb_setting_option',
    array(
        'label' => esc_html__('Breadcrumb Options', 'quality-construction'),
        'section' => 'quality_construction_breadcrumb_option',
        'choices' => $hide_show_breadcrumb_option,
        'type' => 'select',
        'priority' => 10
    )
);


  /**
     *   Show/Hide Breadcrumb in Home page
     */
    $wp_customize->add_setting(
        'quality_construction_hide_breadcrumb_front_page_option',
        array(
                'default' => $default['quality_construction_hide_breadcrumb_front_page_option'],
                'sanitize_callback' => 'quality_construction_sanitize_checkbox',
             )
    );
    $wp_customize->add_control('quality_construction_hide_breadcrumb_front_page_option',
        array(
                'label' => esc_html__('Show/Hide Breadcrumb in Home page', 'quality-construction'),
                'section' => 'quality_construction_breadcrumb_option',
                'type' => 'checkbox',
                'priority' => 10
             )
    );

/*-------------------------------------------------------------------------------------------*/
/**
 * Search Placeholder
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_search_option',
    array(
        'title' => esc_html__('Search', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 12,
    )
);

/**
 *Search Placeholder
 */
$wp_customize->add_setting(
    'quality_construction_post_search_placeholder_option',
    array(
        'default' => $default['quality_construction_post_search_placeholder_option'],
        'sanitize_callback' => 'sanitize_text_field',

    )
);

$wp_customize->add_control('quality_construction_post_search_placeholder_option',
    array(
        'label' => esc_html__('Search Placeholder', 'quality-construction'),
        'section' => 'quality_construction_search_option',
        'type' => 'text',
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Reset Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_reset_option',
    array(
        'title' => esc_html__('Color Reset Options', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 14,
    )
);

/**
 * Reset Option
 */
$wp_customize->add_setting(
    'quality_construction_color_reset_option',
    array(
        'default' => $default['quality_construction_color_reset_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
        'transport' => 'postMessage'
    )
);
$reset_option = quality_construction_reset_option();
$wp_customize->add_control('quality_construction_color_reset_option',
    array(
        'label' => esc_html__('Reset Options', 'quality-construction'),
        'description' => sprintf( esc_html__('Caution: Reset theme settings according to the given options. Refresh the page after saving to view the effects', 'quality-construction')),
        'section' => 'quality_construction_reset_option',
        'type' => 'select',
        'choices' => $reset_option,
        'priority' => 20
    )
);