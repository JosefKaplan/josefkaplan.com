<?php
/**
 * Customizer option for Header sections
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action('customize_register', 'mantranews_header_settings_register');

function mantranews_header_settings_register($wp_customize)
{
    /**
     * Add header panels
     */
    $wp_customize->add_panel(
        'mantranews_header_settings_panel',
        array(
            'priority' => 4,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Header Settings', 'mantranews'),
        )
    );
    /*----------------------------------------------------------------------------------------------------*/
    /**
     * Top Header Section
     */
    $wp_customize->add_section(
        'mantranews_top_header_section',
        array(
            'title' => esc_html__('Top Header Section', 'mantranews'),
            'priority' => 5,
            'panel' => 'mantranews_header_settings_panel'
        )
    );

    //Ticker display option
    $wp_customize->add_setting(
        'mantranews_ticker_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_ticker_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('News Ticker Option', 'mantranews'),
                'description' => esc_html__('Enable/disable news ticker at header.', 'mantranews'),
                'priority' => 1,
                'section' => 'mantranews_top_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                )
            )
        )
    );


    //Ticker Caption
    $wp_customize->add_setting(
        'mantranews_ticker_caption',
        array(
            'default' => esc_html__('Latest', 'mantranews'),
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'mantranews_ticker_caption',
        array(
            'type' => 'text',
            'label' => esc_html__('News Ticker Caption', 'mantranews'),
            'section' => 'mantranews_top_header_section',
            'priority' => 2
        )
    );
    // Show ticker in all page or only front page /*
    $wp_customize->add_setting(
        'all_page_mantranews_ticker_option',
        array(
            'default' => 'no',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_all_page_ticker_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'all_page_mantranews_ticker_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Show on all page', 'mantranews'),
                'description' => esc_html__('Select yes, if you want to show ticker on all page.', 'mantranews'),
                'priority' => 3,
                'section' => 'mantranews_top_header_section',
                'choices' => array(
                    'yes' => esc_html__('Yes', 'mantranews'),
                    'no' => esc_html__('No', 'mantranews')
                )
            )
        )
    );

    // Display Current Date
    $wp_customize->add_setting(
        'mantranews_header_date',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_header_date',
            array(
                'type' => 'switch',
                'label' => esc_html__('Current Date Option', 'mantranews'),
                'description' => esc_html__('Enable/disable current date from top header.', 'mantranews'),
                'priority' => 4,
                'section' => 'mantranews_top_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                )
            )
        )
    );

    //Date Format
    $wp_customize->add_setting(
        'mantranews_date_format_option', array(
            'default' => 'l, F d, Y',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_sanitize_date_format',
        )
    );
    $wp_customize->add_control(
        'mantranews_date_format_option', array(
            'type'        => 'radio',

            'label'       =>esc_html__( 'Current Date Format Style Options', 'mantranews' ),
            'description' => esc_html__( 'Choose available format for date format style. (functions only if current date option is enabled)', 'mantranews' ),
            'section'     => 'mantranews_top_header_section',
            'choices'     => array(
                'l, F d, Y' => esc_html__( 'Format 1 (dd,mm,yy)', 'mantranews' ),
                'l, Y, F d' => esc_html__( 'Format 2 (dd,yy,mm)', 'mantranews' ),
                'Y, F d, l' => esc_html__( 'Format 3 (yy,mm,dd)', 'mantranews' ),
            ),
            'priority'    => 4
        )
    );


    // Option about top header social icons
    $wp_customize->add_setting(
        'mantranews_header_social_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_header_social_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Social Icon Option', 'mantranews'),
                'description' => esc_html__('Enable/disable social icons from top header (right).', 'mantranews'),
                'priority' => 5,
                'section' => 'mantranews_top_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                )
            )
        )
    );
    /*----------------------------------------------------------------------------------------------------*/
    /**
     * Sticky Header
     */
    $wp_customize->add_section(
        'mantranews_sticky_header_section',
        array(
            'title' => esc_html__('Sticky Menu', 'mantranews'),
            'priority' => 10,
            'panel' => 'mantranews_header_settings_panel'
        )
    );

    //Sticky header option
    $wp_customize->add_setting(
        'mantranews_sticky_option',
        array(
            'default' => 'enable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'mantranews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Mantranews_Customize_Switch_Control(
            $wp_customize,
            'mantranews_sticky_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Menu Sticky', 'mantranews'),
                'description' => esc_html__('Enable/disable option for Menu Sticky', 'mantranews'),
                'priority' => 4,
                'section' => 'mantranews_sticky_header_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'mantranews'),
                    'disable' => esc_html__('Disable', 'mantranews')
                )
            )
        )
    );

}
