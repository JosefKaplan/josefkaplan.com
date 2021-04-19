<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */


if ( ! function_exists( 'purea_magazine_customizer_topbar_register' ) ) :
function purea_magazine_customizer_topbar_register( $wp_customize ) {

	$wp_customize->add_section(
        'purea_magazine_topbar_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Top Bar Settings', 'purea-magazine' )
        )
    );

  	// Add an option to enable the topbar
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar', 
		array(
		    'label'       => esc_html__( 'Show Top Bar Section', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar',
		) 
	));

	// Info label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_info', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_info', 
		array(
		    'label'       => esc_html__( 'Note: The top bar would be visible or hidden depending upon the type of header design selected. If header layout has no top bar then top bar will not be show', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'info',
		    'settings'    => 'purea_magazine_label_top_bar_info',
		) 
	));

	// enable social icons in topbar
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_social_icons', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_social_icons', 
		array(
		    'label'       => esc_html__( 'Show Social Icons in Topbar', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_social_icons',
		    'active_callback'  => 'purea_magazine_top_bar_enable',
		) 
	));

	// add text
    $wp_customize->add_setting(
        'purea_magazine_top_bar_social_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Follow Us', 'purea-magazine' ),
            'sanitize_callback' => 'purea_magazine_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_social_text',
        array(
            'settings'      => 'purea_magazine_top_bar_social_text',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Follow Us Text', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_social_enable',
        )
    );

	// Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_facebook_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_facebook_icon', 
		array(
		    'label'       => esc_html__( 'Facebook Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_facebook_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable facebook social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_facebook_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_facebook_icon', 
		array(
		    'label'       => esc_html__( 'Show Facebook Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_facebook_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add facebook url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_facebook_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_facebook_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_facebook_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Facebook URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your facebook page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_facebook_icon_enable',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_twitter_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_twitter_icon', 
		array(
		    'label'       => esc_html__( 'Twitter Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_twitter_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable twitter social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_twitter_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_twitter_icon', 
		array(
		    'label'       => esc_html__( 'Show Twitter Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_twitter_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add twitter url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_twitter_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_twitter_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_twitter_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Twitter URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your twitter page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_twitter_icon_enable',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_instagram_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_instagram_icon', 
		array(
		    'label'       => esc_html__( 'Instagram Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_instagram_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable instagram social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_instagram_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_instagram_icon', 
		array(
		    'label'       => esc_html__( 'Show Instagram Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_instagram_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add instagram url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_instagram_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_instagram_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_instagram_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Instagram URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your instagram page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_instagram_icon_enable',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_linkedin_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_linkedin_icon', 
		array(
		    'label'       => esc_html__( 'LinkedIn Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_linkedin_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable linkedin social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_linkedin_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_linkedin_icon', 
		array(
		    'label'       => esc_html__( 'Show LinkedIn Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_linkedin_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add linkedin url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_linkedin_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_linkedin_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_linkedin_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'LinkedIn URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your linkedin page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_linkedin_icon_enable',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_pinterest_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_pinterest_icon', 
		array(
		    'label'       => esc_html__( 'Pinterest Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_pinterest_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable pinterest social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_pinterest_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_pinterest_icon', 
		array(
		    'label'       => esc_html__( 'Show Pinterest Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_pinterest_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add pinterest url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_pinterest_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_pinterest_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_pinterest_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Pinterest URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your pinterest page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_pinterest_icon_enable',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_youtube_icon', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_youtube_icon', 
		array(
		    'label'       => esc_html__( 'YouTube Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_youtube_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// enable youtube social icon
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_youtube_icon', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_youtube_icon', 
		array(
		    'label'       => esc_html__( 'Show YouTube Icon', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_youtube_icon',
		    'active_callback'  => 'purea_magazine_top_bar_social_enable',
		) 
	));

	// add youtube url
    $wp_customize->add_setting(
        'purea_magazine_top_bar_youtube_icon_url',
        array(
            'type' => 'theme_mod',
            'default'           => '#',
            'sanitize_callback' => 'purea_magazine_sanitize_url',
        )
    );

    $wp_customize->add_control(
        'purea_magazine_top_bar_youtube_icon_url',
        array(
            'settings'      => 'purea_magazine_top_bar_youtube_icon_url',
            'section'       => 'purea_magazine_topbar_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'YouTube URL', 'purea-magazine' ),
            'description'   => esc_html__( 'Add URL for your youtube page', 'purea-magazine' ),
            'active_callback'  => 'purea_magazine_top_bar_youtube_icon_enable',
        )
    );



    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_top_bar_date_time', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_top_bar_date_time', 
		array(
		    'label'       => esc_html__( 'Date Time Section', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_top_bar_date_time',
		    'active_callback'  => 'purea_magazine_top_bar_enable',
		) 
	));

	// enable date
	$wp_customize->add_setting( 
		'purea_magazine_enable_top_bar_date', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_top_bar_date', 
		array(
		    'label'       => esc_html__( 'Show Date', 'purea-magazine' ),
		    'section'     => 'purea_magazine_topbar_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_enable_top_bar_date',
		    'active_callback'  => 'purea_magazine_top_bar_enable',
		) 
	));

}
endif;

add_action( 'customize_register', 'purea_magazine_customizer_topbar_register' );