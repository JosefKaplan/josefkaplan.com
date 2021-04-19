<?php
/**
 * minalite Theme Customizer.
 *
 * @package minalite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minalite_customize_register( $wp_customize ) {

	require_once get_template_directory().'/inc/customizer-controls.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel( 'theme_options' ,
        array(
            'title'       => esc_html__( 'Theme Options', 'minalite' ),
            'description' => ''
        )
    );

    // Sidebar settings
    $wp_customize->add_section( 'minalite_home_sidebar' ,
        array(
            'title'       => esc_html__( 'Sidebar', 'minalite' ),
            'description' => '',
            'panel'       => 'theme_options',
            'piority'     => 2
        )
    );

    $wp_customize->add_setting( 'minalite_home_sidebar', array(
        'sanitize_callback' => 'minalite_sanitize_checkbox',
        'default' => false,
    ) );

    $wp_customize->add_control(
        'minalite_home_sidebar',
            array(
                'type' => 'checkbox',
                'label'      => esc_html__( 'Disable Sidebar on Home Page, Archive Page', 'minalite' ),
                'section'    => 'minalite_home_sidebar',
            )
    );

    $wp_customize->add_setting( 'minalite_sidebar_post', array(
        'sanitize_callback' => 'minalite_sanitize_checkbox',
        'default' => false,
    ) );

    $wp_customize->add_control(
        'minalite_sidebar_post',
            array(
                'type' => 'checkbox',
                'label'      => esc_html__( 'Disable Sidebar on Single Post', 'minalite' ),
                'section'    => 'minalite_home_sidebar',
            )
    );

    $wp_customize->add_setting( 'minalite_sidebar_page', array(
        'sanitize_callback' => 'minalite_sanitize_checkbox',
        'default' => false,
    ) );

    $wp_customize->add_control(
        'minalite_sidebar_page',
            array(
                'type' => 'checkbox',
                'label'      => esc_html__( 'Disable Sidebar on Single Page', 'minalite' ),
                'section'    => 'minalite_home_sidebar',
            )
    );

    // Social Media Settings
    $wp_customize->add_section( 'minalite_social' ,
        array(
            'title'      => esc_html__('Social Media Settings', 'minalite'),
            'description'=> esc_html__('Enter your social media(URL). Icons will not show if left blank.', 'minalite'),
            'priority'   => 4,
            'panel'       => 'theme_options',
        ) 
    );

        $wp_customize->add_setting(
            'minalite_facebook',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_twitter',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_instagram',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_pinterest',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_tumblr',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_bloglovin',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_google',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_youtube',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_soundcloud',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_vimeo',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_linkedin',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_setting(
            'minalite_rss',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url_raw'
            )
        );


    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'minalite_facebook',
            array(
                'label'      => esc_html__('Facebook', 'minalite'),
                'section'    => 'minalite_social',
                'settings'   => 'minalite_facebook',
                'type'       => 'text',
                'priority'   => 1
            )
        )
    );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_twitter',
                array(
                    'label'      => esc_html__('Twitter', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_twitter',
                    'type'       => 'text',
                    'priority'   => 2
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_instagram',
                array(
                    'label'      => esc_html__('Instagram', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_instagram',
                    'type'       => 'text',
                    'priority'   => 3
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_pinterest',
                array(
                    'label'      => esc_html__('Pinterest', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_pinterest',
                    'type'       => 'text',
                    'priority'   => 4
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_bloglovin',
                array(
                    'label'      => esc_html__('Bloglovin', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_bloglovin',
                    'type'       => 'text',
                    'priority'   => 5
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_google',
                array(
                    'label'      => esc_html__('Google Plus', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_google',
                    'type'       => 'text',
                    'priority'   => 6
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_tumblr',
                array(
                    'label'      => esc_html__('Tumblr', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_tumblr',
                    'type'       => 'text',
                    'priority'   => 7
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_youtube',
                array(
                    'label'      => esc_html__('Youtube', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_youtube',
                    'type'       => 'text',
                    'priority'   => 8
                )
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_soundcloud',
                array(
                    'label'      => esc_html__('Soundcloud', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_soundcloud',
                    'type'       => 'text',
                    'priority'   => 9
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_vimeo',
                array(
                    'label'      => esc_html__('Vimeo', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_vimeo',
                    'type'       => 'text',
                    'priority'   => 10
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_linkedin',
                array(
                    'label'      => esc_html__('Linkedin', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_linkedin',
                    'type'       => 'text',
                    'priority'   => 11
                )
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'minalite_rss',
                array(
                    'label'      => esc_html__('Rss', 'minalite'),
                    'section'    => 'minalite_social',
                    'settings'   => 'minalite_rss',
                    'type'       => 'text',
                    'priority'   => 12
                )
            )
        );

    // Color settings
    $wp_customize->add_section( 'minalite_color_general' ,
        array(
            'title'       => esc_html__( 'Color Accent', 'minalite' ),
            'description' => '',
            'panel'       => 'theme_options',
            'piority'     => 2
        )
    );

    $wp_customize->add_setting( 'minalite_color_accent', array(
        'default'              => '#2bafb9',
        'sanitize_callback'    => 'sanitize_hex_color_no_hash',
        'sanitize_js_callback' => 'maybe_hash_hex_color',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'minalite_color_accent',
                array(
                    'label'      => esc_html__( 'Primary Color', 'minalite' ),
                    'section'    => 'minalite_color_general',
                )
        )
    );

    // Mina Pro
	$wp_customize->add_section( 'mina_pro' ,
	    array(
	        'title'       => esc_html__( 'Upgrade to Mina Pro', 'minalite' ),
	        'description' => '',
	        //'panel'       => 'theme_options',
	        'piority'     => 5
	    )
	);

	$wp_customize->add_setting( 'mina_features', array(
            'sanitize_callback' => 'sanitize_text_field',
        ) );
	$wp_customize->add_control(
            new minalite_Customize_Pro_Control(
                $wp_customize,
                'mina_features',
                array(
                    'label'      => esc_html__( 'Mina Features', 'minalite' ),
                    'description'   => sprintf( __('<span>Featured slider</span><span>6 Different Blog Layouts</span><span>Fully Responsive</span><span>100+ Customizable coloring options</span><span>4 Custom Widgets</span><span>Posts/Page Settings</span><span>Footer Copyright Text</span><span>Lifetime Upgrades</span><span>LifeTime Support</span><span>Mailchimp Support</span><span>Well Documented</span><span>Child Theme included</span><span>And More...</span>','minalite')),
                    'section'    => 'mina_pro',
                )
            )
	);
	$wp_customize->add_setting( 'mina_pro_links', array(
            'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		new minalite_Customize_Pro_Control(
			$wp_customize,
			'mina_pro_links',
			array(
				'description'   => sprintf( __('<a target="_blank" class="mina-buy-button" href="https://zthemes.net/themes/mina">Buy Now</a>', 'minalite')),
				'section'    => 'mina_pro',
			)
        )
	);

}
add_action( 'customize_register', 'minalite_customize_register' );

function minalite_sanitize_checkbox( $input ){
    if ( $input == 1 || $input == 'true' || $input === true ) {
        return 1;
    } else {
        return 0;
    }
}

function minalite_sanitize_number( $number, $setting ) {
    $number = absint( $number );
    return ( $number ? $number : $setting->default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function minalite_customize_preview_js() {
	wp_enqueue_script( 'minalite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'minalite_customize_preview_js' );

/**
 * Load customizer style
 */
function minalite_customizer_load_css(){
    wp_enqueue_style( 'minalite-customizer', get_template_directory_uri() . '/css/customizer.css' );
}
add_action('customize_controls_print_styles', 'minalite_customizer_load_css');
