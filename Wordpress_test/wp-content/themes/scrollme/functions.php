<?php
/**
 * scrollme functions and definitions
 *
 * @package scrollme
 */

if ( ! function_exists( 'scrollme_setup' ) ) :

function scrollme_setup() {

	load_theme_textdomain( 'scrollme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'scrollme' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_theme_support( 'custom-background', apply_filters( 'scrollme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'post-thumbnails' );

	add_image_size( 'scrollme-grid-large', 750, 750, true ); // Grid image crop
	add_image_size( 'scrollme-post-image', 850, 300, true ); // Post Image
    add_image_size( 'scrollme-bpost-image', 380, 250, true ); // Blog  Post Image
    add_image_size( 'scrollme-featbox-image', 580, 350, true ); // Feature Box Thumbnail


}
endif; // scrollme_setup
add_action( 'after_setup_theme', 'scrollme_setup' );

function scrollme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'scrollme_content_width', 1000 );
}
add_action( 'after_setup_theme', 'scrollme_content_width', 0 );

// Register widget area.
function scrollme_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'scrollme' ),
		'id'            => 'scrollme-sidebar-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'scrollme' ),
		'id'            => 'scrollme-sidebar-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Google Map', 'scrollme' ),
		'id'            => 'scrollme-gmap',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Social Link (Header)', 'scrollme' ),
		'id'            => 'scrollme-header-socialicon',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'scrollme_widgets_init' );

//Enqueue scripts and styles.
function scrollme_scripts() {

	 $font_args = array(
        'family' => 'Open+Sans:400,300,400italic,600,700|Open+Sans+Condensed:300,700',
    );
    wp_enqueue_style('scrollme-google-fonts', add_query_arg($font_args, "//fonts.googleapis.com/css"));
	wp_enqueue_style('font-awesome',get_template_directory_uri() . '/css/font-awesome.css',true );
	wp_enqueue_style( 'nivo-lightbox', get_template_directory_uri().'/js/nivolightbox/nivo-lightbox.css' );
	wp_enqueue_style( 'nivo-lightbox-default', get_template_directory_uri().'/js/nivolightbox/themes/default/default.css' );
	wp_enqueue_style( 'jquery-fullpage', get_template_directory_uri().'/js/fullpage/jquery.fullPage.css', true );
	wp_enqueue_style( 'mcustomscrollbar', get_template_directory_uri().'/js/mcustomscrollbar/jquery.mCustomScrollbar.css', true );
	wp_enqueue_style( 'scrollme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'scrollme-keyboard', get_template_directory_uri().'/css/keyboard.css', true );
	wp_enqueue_style( 'scrollme-responsive', get_template_directory_uri().'/css/responsive.css', true );
	

	wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri().'/js/fullpage/jquery.fullPage.min.js', array( 'jquery' ),'20120206', true );
	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri().'/js/jquery.bxslider.js', array( 'jquery' ),'20120206', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ),'20120206', true );
	wp_enqueue_script( 'jquery-inview', get_template_directory_uri().'/js/jquery.inview.js', array( 'jquery'), '20120206', true );
	wp_enqueue_script( 'jquery-knob', get_template_directory_uri().'/js/jquery.knob.js', array( 'jquery'), '20120206', true );
	wp_enqueue_script( 'nivo-lightbox', get_template_directory_uri().'/js/nivolightbox/nivo-lightbox.js', array( 'jquery'), '20120206', true );
	wp_enqueue_script( 'mcustomscrollbar', get_template_directory_uri().'/js/mcustomscrollbar/jquery.mCustomScrollbar.js', array( 'jquery'), '20120206', true );
	wp_enqueue_script( 'device', get_template_directory_uri().'/js/device.js', array( ), '20120206', true );
	wp_enqueue_script( 'scrollto', get_template_directory_uri().'/js/jquery.scrollTo.js', array( ), '20120206', true );
	wp_enqueue_script( 'scrollme-custom-js', get_template_directory_uri().'/js/custom.js', array('jquery', 'jquery-masonry'), '20120206', true );

	$pause = get_theme_mod( 'scrollme_slider_pause', '4000' );

	wp_localize_script( 'scrollme-custom-js', 'sBxslider', array( 'pause' => $pause ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'scrollme_scripts' );

/** Enqueue Scripts in Backend **/
add_action( 'admin_enqueue_scripts', 'scrollme_admin_enqueue_scripts' );
function scrollme_admin_enqueue_scripts() {
    $currentScreen = get_current_screen();
    /** Loads the media js file in Page Edit Page only **/
    if( $currentScreen->id == "widgets" || $currentScreen->id == "page" ) {
        wp_enqueue_media();
        wp_enqueue_script( 'scrollme-media-uploader-js', get_template_directory_uri(). '/inc/admin/js/media-uploader.js', array('jquery') );
    }

    wp_enqueue_style('scrollme-other-admin', get_template_directory_uri(). '/inc/admin/css/other-admin.css');
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Scroll Me Custom Functions
 */
require get_template_directory() . '/inc/scrollme-functions.php';

/**
 * Scroll Me Extra Customizer Controls
 */
require get_template_directory() . '/inc/scrollme-extra-controls.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Metabox for this theme
 */
require get_template_directory() . '/inc/scrollme-metabox.php';

/**
 * Custom Widgets
 */
require get_template_directory() . '/inc/scrollme-widgets.php';

/**
 * Woocommerce Hooks
 */
require get_template_directory() . '/woocommerce/woocommerce-functions.php';

/**
 * Dynamic Color
 */
require get_template_directory() . '/css/dynamic-style.php';

/**
 * Include Welcome Page
 */
require get_template_directory() . '/inc/welcome/welcome-config.php';