<?php
/**
 * Layout/Design Option
 *
 */
$wp_customize->add_panel(
    'quality_construction_design_layout_options',
    array(
        'priority' => 7,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__(' Layout/Design Option', 'quality-construction'),
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Sidebar Option
 *
 */
$wp_customize->add_section(
    'quality_construction_default_sidebar_layout_option',
    array(
        'title' => esc_html__('Default Sidebar Layout Option', 'quality-construction'),
        'panel' => 'quality_construction_design_layout_options',
        'priority' => 6,
    )
);

/**
 * Sidebar Option
 */
$wp_customize->add_setting(
    'quality_construction_sidebar_layout_option',
    array(
        'default' => $default['quality_construction_sidebar_layout_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
    )
);


$layout = quality_construction_sidebar_layout();
$wp_customize->add_control('quality_construction_sidebar_layout_option',
    array(
        'label' => esc_html__('Default Sidebar Layout', 'quality-construction'),
        'description' => esc_html__('Home/front page does not have sidebar. Inner pages like blog, archive single page/post Sidebar Layout. However single page/post sidebar can be overridden.', 'quality-construction'),
        'section' => 'quality_construction_default_sidebar_layout_option',
        'type' => 'select',
        'choices' => $layout,
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/

/**
 * Blog/Archive Layout Option
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_blog_archive_layout_option',
    array(
        'title' => esc_html__('Blog/Archive Layout Option', 'quality-construction'),
        'panel' => 'quality_construction_design_layout_options',
        'priority' => 7,
    )
);


/**
 * Blog Page Title
 */
$wp_customize->add_setting(
    'quality_construction_blog_title_option',
    array(
        'default' => $default['quality_construction_blog_title_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('quality_construction_blog_title_option',
    array(
        'label' => esc_html__('Blog Page Title', 'quality-construction'),
        'section' => 'quality_construction_blog_archive_layout_option',
        'type' => 'text',
        'priority' => 11
    )
);

/**
 * Blog/Archive excerpt option
 */
$wp_customize->add_setting(
    'quality_construction_blog_excerpt_option',
    array(
        'default' => $default['quality_construction_blog_excerpt_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
    )
);
$blogexcerpt = quality_construction_blog_excerpt();
$wp_customize->add_control('quality_construction_blog_excerpt_option',
    array(
        'choices' => $blogexcerpt,
        'label' => esc_html__('Show Description From', 'quality-construction'),
        'section' => 'quality_construction_blog_archive_layout_option',
        'type' => 'select',
        'priority' => 8
    )
);

/**
 * Description Length In Words
 */
$wp_customize->add_setting(
    'quality_construction_description_length_option',
    array(
        'default' => $default['quality_construction_description_length_option'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('quality_construction_description_length_option',
    array(
        'label' => esc_html__('Description Length In Words', 'quality-construction'),
        'section' => 'quality_construction_blog_archive_layout_option',
        'type' => 'number',
        'priority' => 12
    )
);

/**
 * Exclude Categories In Blog/Archive Pages
 */
$wp_customize->add_setting(
    'quality_construction_exclude_cat_blog_archive_option',
    array(
        'default' => $default['quality_construction_exclude_cat_blog_archive_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('quality_construction_exclude_cat_blog_archive_option',
    array(
        'label' => esc_html__('Exclude Categories In Blog Page', 'quality-construction'),
        'description' => esc_html__('Enter categories ids with comma separated eg: 2,7,14,47. For including all categories left blank', 'quality-construction'),
        'section' => 'quality_construction_blog_archive_layout_option',
        'type' => 'text',
        'priority' => 13
    )
);


/**
 * Read More Text
 */
$wp_customize->add_setting(
    'quality_construction_read_more_text_blog_archive_option',
    array(
        'default' => $default['quality_construction_read_more_text_blog_archive_option'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('quality_construction_read_more_text_blog_archive_option',
    array(
        'label' => esc_html__('Read More Text', 'quality-construction'),
        'section' => 'quality_construction_blog_archive_layout_option',
        'type' => 'text',
        'priority' => 14
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Feature Image Option
 *
 */
$wp_customize->add_section(
    'quality_construction_feature_image_info_option',
    array(
        'title' => esc_html__('Feature Image Option For Single Page', 'quality-construction'),
        'panel' => 'quality_construction_design_layout_options',
        'priority' => 6,
    )
);


/**
 * Feature Image Option Single page
 */
$wp_customize->add_setting(
    'quality_construction_show_feature_image_single_option',
    array(
        'default' => $default['quality_construction_show_feature_image_single_option'],
        'sanitize_callback' => 'quality_construction_sanitize_select',
    )
);

$hide_show_feature_image_option = quality_construction_show_feature_image_option();
$wp_customize->add_control(
    'quality_construction_show_feature_image_single_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Show/Hide Feature Image For Single Page', 'quality-construction'),
        'section' => 'quality_construction_feature_image_info_option',
        'choices' => $hide_show_feature_image_option,
        'priority' => 5
    )
);



  

	