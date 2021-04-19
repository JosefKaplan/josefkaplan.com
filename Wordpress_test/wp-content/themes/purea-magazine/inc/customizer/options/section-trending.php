<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */


if ( ! function_exists( 'purea_magazine_customizer_trending_news_register' ) ) :
function purea_magazine_customizer_trending_news_register( $wp_customize ) {

	$wp_customize->add_section(
        'purea_magazine_trending_news_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Trending News Settings', 'purea-magazine' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_news', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_trending_news', 
		array(
		    'label'       => esc_html__( 'Trending News', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_trending_news',
		) 
	));

  	// Add an option to enable the trending news
	$wp_customize->add_setting( 
		'purea_magazine_enable_trending_news', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_trending_news', 
		array(
		    'label'       => esc_html__( 'Show Trending News', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_trending_news',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_news_text', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_trending_news_text', 
		array(
		    'label'       => esc_html__( 'Trending News Title', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_trending_news_text',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));

	// add trending news text
    $wp_customize->add_setting(
        'purea_magazine_trending_news_title',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'TRENDING NOW', 'purea-magazine' ),
            'sanitize_callback' => 'purea_magazine_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_trending_news_title',
        array(
            'settings'      => 'purea_magazine_trending_news_title',
            'section'       => 'purea_magazine_trending_news_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Title', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_trending_news_enable',
        )
    );


    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_news_width', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_trending_news_width', 
		array(
		    'label'       => esc_html__( 'Trending News Content Width', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_trending_news_width',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));

	//width options
    $wp_customize->add_setting(
        'purea_magazine_trending_news_content_width',
        array(
            'type' => 'theme_mod',
            'default'           => 85,
            'sanitize_callback' => 'purea_magazine_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_trending_news_content_width',
        array(
            'settings'      => 'purea_magazine_trending_news_content_width',
            'section'       => 'purea_magazine_trending_news_settings',
            'type'          => 'number',
            'label'         => esc_html__( 'Content Width(%)', 'purea-magazine' ),
            'description'         => esc_html__( 'Default is 85', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_trending_news_enable',
        )
    );


    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_news_cat', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_trending_news_cat', 
		array(
		    'label'       => esc_html__( 'Trending News Category', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_trending_news_cat',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));

	// Category
    $wp_customize->add_setting( 
        'purea_magazine_trending_news_category', 
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
       'purea_magazine_trending_news_category', 
        array(
            'section'       => 'purea_magazine_trending_news_settings',
            'label'         => esc_html__( 'Choose Category', 'purea-magazine' ),
            'description'   => esc_html__( 'Select category from which trending news will show posts from. Leave unselect to show all category posts', 'purea-magazine' ),
            'type'          => 'select',
			'choices'       =>  purea_magazine_category_list(),
            'active_callback'  => 'purea_magazine_trending_news_enable',
        ) 
    ); 

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_news_display_style', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_trending_news_display_style', 
		array(
		    'label'       => esc_html__( 'Display Style', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_trending_news_display_style',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));

	// Add an option to change display style
	$wp_customize->add_setting( 
		'purea_magazine_enable_trending_news_display_slide', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_trending_news_display_slide', 
		array(
		    'label'       => esc_html__( 'Switch to Slides', 'purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_trending_news_display_slide',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));

	// Info label
	$wp_customize->add_setting( 
		'purea_magazine_label_trending_bar_display_info', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_label_trending_bar_display_info', 
		array(
		    'label'       => esc_html__( 'Note: The default is Marquee style, if you enable this setting it will switch to slides animation','purea-magazine' ),
		    'section'     => 'purea_magazine_trending_news_settings',
		    'type'        => 'info',
		    'settings'    => 'purea_magazine_label_trending_bar_display_info',
		    'active_callback'  => 'purea_magazine_trending_news_enable',
		) 
	));


}
endif;

add_action( 'customize_register', 'purea_magazine_customizer_trending_news_register' );