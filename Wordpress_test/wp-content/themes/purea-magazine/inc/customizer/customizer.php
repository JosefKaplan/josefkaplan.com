<?php
/**
 * Purea Magazine Theme Customizer
 *
 * @package purea-magazine
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! function_exists( 'purea_magazine_customize_register' ) ) :
function purea_magazine_customize_register( $wp_customize ) {

    // Add custom controls.
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-title-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/radio-images/class-radio-image-control.php' );

    // Register the custom control type.
    $wp_customize->register_control_type( 'Purea_Magazine_Toggle_Control' );


    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'purea_magazine_site_title_callback',
            'fallback_refresh'    => false,
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'purea_magazine_site_description_callback',
            'fallback_refresh'    => false, 
        ) );
    }

    // Display Site Title and Tagline
    $wp_customize->add_setting( 
        'purea_magazine_display_site_title_tagline', 
        array(
            'default'           => true,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_display_site_title_tagline', 
        array(
            'label'       => esc_html__( 'Display Site Title and Tagline', 'purea-magazine' ),
            'section'     => 'title_tagline',
            'type'        => 'toggle',
            'settings'    => 'purea_magazine_display_site_title_tagline',
        ) 
    ));
}
endif;
add_action( 'customize_register', 'purea_magazine_customize_register' );

//top bar settings
get_template_part( 'inc/customizer/options/section-topbar' );

//trending news settings
get_template_part( 'inc/customizer/options/section-trending' );

//frontpage settings
get_template_part( 'inc/customizer/options/section-frontpage' );

//Header settings
get_template_part( 'inc/customizer/options/section-headers' );

//blog settings
get_template_part( 'inc/customizer/options/section-blog' );

//footer settings
get_template_part( 'inc/customizer/options/section-footer' );

//preloader settings
get_template_part( 'inc/customizer/options/section-preloader' );

//customizer helper
get_template_part( 'inc/customizer/customizer-helpers' );

//data sanitization
get_template_part( 'inc/customizer/data-sanitization' );



/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'purea_magazine_enqueue_customizer_stylesheets' ) ) :
function purea_magazine_enqueue_customizer_stylesheets() {
    wp_register_style( 'purea-magazine-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/css/customizer.css', array(), '1.0.9', 'all' );
    wp_enqueue_style( 'purea-magazine-customizer-css' );
}
endif;
add_action( 'customize_controls_print_styles', 'purea_magazine_enqueue_customizer_stylesheets' );