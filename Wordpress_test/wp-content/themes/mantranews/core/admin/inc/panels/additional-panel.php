<?php
/**
 * Customizer settings for Additional Settings
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'customize_register', 'mantranews_additional_settings_register' );

function mantranews_additional_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     */
    $wp_customize->add_panel(
        'mantranews_additional_settings_panel',
        array(
            'priority'       => 7,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Additional Settings', 'mantranews' ),
        )
    );
/*--------------------------------------------------------------------------------------------*/
	// Category Color Section
    $wp_customize->add_section(
        'mantranews_categories_color_section',
        array(
            'title'         => esc_html__( 'Categories Color', 'mantranews' ),
            'priority'      => 5,
            'panel'         => 'mantranews_additional_settings_panel',
        )
    );

	$priority = 3;
	$categories = get_terms( 'category' ); // Get all Categories
	$wp_category_list = array();

	foreach ( $categories as $category_list ) {

		$wp_customize->add_setting(
			'mantranews_category_color_'.esc_html( strtolower( $category_list->name ) ),
			array(
				'default'              => '#0166bf',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'mantranews_category_color_'.esc_html( strtolower($category_list->name) ),
				array(
					/* translators: %s: category namet */
					'label'    => esc_html( $category_list->name ),
					'section'  => 'mantranews_categories_color_section',
					'priority' => absint($priority)
				)
			)
		);
		$priority++;
	}
/*--------------------------------------------------------------------------------------------*/
	//Social icons
	$wp_customize->add_section(
        'mantranews_social_media_section',
        array(
            'title'         => esc_html__( 'Social Media', 'mantranews' ),
            'priority'      => 10,
            'panel'         => 'mantranews_additional_settings_panel',
        )
    );

	//Add Facebook Link
    $wp_customize->add_setting(
        'social_fb_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_fb_link',
        array(
            'type' => 'text',
            'priority' => 5,
            'label' => esc_html__( 'Facebook', 'mantranews' ),
            'description' => esc_html__( 'Your Facebook Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add twitter Link
    $wp_customize->add_setting(
        'social_tw_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_tw_link',
        array(
            'type' => 'text',
            'priority' => 6,
            'label' => esc_html__( 'Twitter', 'mantranews' ),
            'description' => esc_html__( 'Your Twitter Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
       )
    );

    //Add Google plus Link
    $wp_customize->add_setting(
        'social_gp_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_gp_link',
        array(
            'type' => 'text',
            'priority' => 7,
            'label' => esc_html__( 'Google Plus', 'mantranews' ),
            'description' => esc_html__( 'Your Google Plus Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add LinkedIn Link
    $wp_customize->add_setting(
        'social_lnk_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_lnk_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => esc_html__( 'LinkedIn', 'mantranews' ),
            'description' => esc_html__( 'Your LinkedIn Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add youtube Link
    $wp_customize->add_setting(
        'social_yt_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_yt_link',
        array(
            'type' => 'text',
            'priority' => 9,
            'label' => esc_html__( 'YouTube', 'mantranews' ),
            'description' => esc_html__( 'Your YouTube Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add vimeo Link
    $wp_customize->add_setting(
        'social_vm_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_vm_link',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => esc_html__( 'Vimeo', 'mantranews' ),
            'description' => esc_html__( 'Your Vimeo Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add Pinterest link
    $wp_customize->add_setting(
        'social_pin_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_pin_link',
        array(
            'type' => 'text',
            'priority' => 11,
            'label' => esc_html__( 'Pinterest', 'mantranews' ),
            'description' => esc_html__( 'Your Pinterest Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

    //Add Instagram link
    $wp_customize->add_setting(
        'social_insta_link',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'social_insta_link',
        array(
            'type' => 'text',
            'priority' => 12,
            'label' => esc_html__( 'Instagram', 'mantranews' ),
            'description' => esc_html__( 'Your Instagram Account URL', 'mantranews' ),
            'section' => 'mantranews_social_media_section'
        )
    );

}
