<?php
/*
 * Business Architect functions
 * Since Version 1.0
 */

if ( ! function_exists( 'business_architect_setup' ) ) :

	function business_architect_setup() {

		load_theme_textdomain( 'business-architect' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
		
		$header_args = array(
			'width'           => 1600,
			'flex-width'    => true,
			'flex-height'    => true,
			'uploads'         => true,
			'random-default'  => true,	
			'header-text'     => false,
			
		);
				
		add_theme_support( 'custom-header', $header_args );	
	
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'business-architect' ),
				'social'  => __( 'Social Links Menu', 'business-architect' ),
			)
		);
		
		$backbround_args = array(
			'default-color'          => '#ffffff',
			'default-image'          => '',
			'default-repeat'         => '',
			'default-position-x'     => '',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		
		add_theme_support( 'custom-background', $backbround_args );		


		/*
		 * Enable support for Post Formats.		
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );


		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		
		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(
			'widgets'     => array(
				// Place three core-defined widgets in the sidebar area.
				'sidebar-1' => array(
					'search',
					'categories',
					'archives',
				),
		
				// Add business info widget to the footer 1 area.
				'footer-sidebar-1' => array(
					'text_about',
				),
		
				// Put widgets in the footer 2 area.
				'footer-sidebar-2' => array(
					'recent-posts',				
				),
				// Putwidgets in the footer 3 area.
				'footer-sidebar-3' => array(
					'categories',				
				),
				// Put widgets in the footer 4 area.
				'footer-sidebar-4' => array(				
					'search',				
				),
												
			),
			
			'nav_menus' => array(
					'primary' => array(
						'name' => __( 'Top Menu', 'business-architect' ),
					),
					'social' => array(
						'name' => __( 'Social Links Menu', 'business-architect' ),
						'items' => array(
							'link_yelp',
							'link_facebook',
							'link_twitter',
							'link_instagram',
							'link_email',
						),
					),
				),	
		);



	 
	add_theme_support( 'starter-content', $starter_content );
		
	}
	
endif; // business_architect_setup
add_action( 'after_setup_theme', 'business_architect_setup' );


if ( ! function_exists( 'business_architect_default_settings' ) ) :

function business_architect_default_settings($param){
	$values = array (
					 'background_color'=> '#fff', 
					 'page_background_color'=> '#fff', 
					 'woocommerce_menubar_color'=> '#fff', 
					 'woocommerce_menubar_text_color'=> '#333333', 
					 'link_color'=>  '#003666',
					 'main_text_color' => '#1a1a1a', 
					 'primary_color'=> '#0182f4',
					 'header_bg_color'=> '#fff',
					 'header_text_color'=> '#333333',
					 'footer_bg_color'=> '#020617',
					 'footer_text_color'=> '#fff',
					 'header_contact_social_bg_color'=> '#aaa',
					 'footer_border' =>'1',
					 'hero_border' => 0 ,
					 'header_layout' =>'1',
					 'heading_font' => 'Roboto', 
					 'body_font' => 'Google Sans'					 
					 );
					 
	return $values[$param];
}

endif;


/*  
 * Theme uri can be changed in child themes by overriding function
 */
if (!function_exists('business_architect_theme_uri')) {
	function business_architect_theme_uri(){
		return 'https://wpbusinessthemes.com/product/agency-starter-theme/';
	}
}


add_action( 'after_setup_theme', 'business_architect_custom_header' );
/**
 * Add Default Custom Header Image To
 * @return void
 */
function business_architect_custom_header() {

    add_theme_support(
        'custom-header',
        apply_filters(
            'business_architect_custom_header_args',
            array(
                'default-text-color' => '#ffffff',
				'width'              => 1280,
				'height'             => 340,
				'flex-width'         => true,
				'flex-height'        => true,								
            )
        )
    );
}


/**
 *
 * @global int $content_width
 *
 *
 */
function business_architect_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_architect_content_width', 840 );
}
add_action( 'after_setup_theme', 'business_architect_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function business_architect_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'business-architect-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'business_architect_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 */
function business_architect_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'business-architect' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'WooCommerce', 'business-architect' ),
			'id'            => 'woocommerce-sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in WooCommerce sidebar.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	
	/* Footer widget area */
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'business-architect' ),
			'id'            => 'footer-sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'business-architect' ),
			'id'            => 'footer-sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'business-architect' ),
			'id'            => 'footer-sidebar-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);	
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 4', 'business-architect' ),
			'id'            => 'footer-sidebar-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'business-architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	
}
add_action( 'widgets_init', 'business_architect_widgets_init' );

/**
 * @since 1.0.0
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function business_architect_php_not_met_notice() {
	?>
	<div class="notice notice-error is-dismissible" ><p><?php esc_html_e("Unable to activate the theme. Business Architect Theme requires Minimum PHP version 5.6", 'business-architect'); ?></p></div>
	<?php
}


if ( ! function_exists( 'business_architect_fonts_url' ) ) :
	/**
	 * @return string Google fonts URL for the theme.
	 */
	function business_architect_fonts_url() {

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by "Open Sans", sans-serif;, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$typography = _x( 'on', 'Open Sans font: on or off', 'business-architect' ); 
	
		if ( 'off' !== $typography ) {
			$font_families = array();
			
			$font_families[] = get_theme_mod('heading_font', 'Roboto').':300,400,500';
			$font_families[] = get_theme_mod('body_font', 'Google Sans').':300,400,500';
			
	 
			$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
			);
			
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			
			
		}
	   
		return esc_url( $fonts_url );
	
	}
endif;

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function business_architect_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'business_architect_javascript_detection', 0 );

/**
 * @since 1.0.0
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function business_architect_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, business_architect_php_version, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'business_architect_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}


/**
 * Enqueues scripts and styles.
 */
function business_architect_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'business-architect-fonts', business_architect_fonts_url(), array(), null );
	
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/css/bootstrap.css' ), array(), '3.3.6');

	// Add FontAwesome, used in the main stylesheet.
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'business-architect-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'business-architect-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'business-architect-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'business-architect-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20191010', true );

	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/js/bootstrap.js' ), array( 'jquery' ), '3.3.7', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'business-architect-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}
	


	wp_enqueue_script( 'business-architect-script', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20191010', true );

	wp_localize_script(
		'business-architect-script',
		'business_architect_screenReaderText',
		array(
			'expand'   => esc_html__( 'Expand child menu', 'business-architect' ),
			'collapse' => esc_html__( 'Collapse child menu', 'business-architect' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'business_architect_scripts' );




/**
 * Enqueue styles for the block-based editor.
 */
function business_architect_block_editor_styles() {
	// Add custom fonts.
	wp_enqueue_style( 'business-architect-fonts', business_architect_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'business_architect_block_editor_styles' );



if ( class_exists( 'WP_Customize_Control' ) ) {

	require get_template_directory() .'/inc/color-picker/alpha-color-picker.php';
}



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php'; 


// Display fontawesome search icon in menus and toggle search form 
add_filter('wp_nav_menu_items', 'business_architect_search_form', 10, 2);

function business_architect_search_form($items, $args) {
if( $args->theme_location == 'primary' )
       $items .= '<li class="menu-search-popup" tabindex="0" ><a class="search_icon"><i class="fa fa-search"></i></a><div  class="spicewpsearchform" >'. get_search_form(false) .'</div></li></ul>';
       return $items;
}


/**
 * @since 1.0.0
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'business_architect_php_version', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'business_architect_test_for_min_php' );


/**
 * @since 1.0.0
 * Add WooCommerce product support to theme
 */

add_action( 'after_setup_theme', 'business_architect_woocommerce_support' );
function business_architect_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );	
}


/**
 * @since 1.0.0
 * add home link.
 */
function business_architect_nav_wrap() {
  $wrap  = '<ul id="%1$s" class="%2$s">';
  $wrap .= '<li class="hidden-xs"><a href="'.esc_url(home_url()).'"><i class="fa fa-home"></i></a></li>';
  $wrap .= '%3$s';
  $wrap .= '</ul>';
  return $wrap;
}

/* 
 * custom excerpt length 
 */
function business_architect_length($length){
	return 80;
}
add_filter('excerpt_length', 'business_architect_length');


/**
 *TGM Plugin activation.
*/

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'business_architect_activate_recommended_plugins' );

/**
 * Register recommended plugins.
 */

function business_architect_activate_recommended_plugins() {

	$plugins = array(
	
		array(
			'name'     => __( 'Elementor Drag and Drop Page Builder', 'business-architect' ),
			'slug'     => 'elementor',
			'required' => false,
		),	
		
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),		
		
	);

	$config = array();

	tgmpa( $plugins, $config );

}

/**
 * WordPress Custom control style
 */
function business_architect_customizer_styles() { ?>
	<style>
		.custom-help-control {
			padding:9px; 
			border:1px solid #CCCCCC; 
			background-color:#FFFFFF;
		}	
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'business_architect_customizer_styles', 999 );



/*
 * https://developer.wordpress.org/reference/hooks/admin_notices/
 * Displays theme info / quick help 
 */
if ( isset( $_GET['hide_admin_notice'] ) ) {
		update_option('business_architect_hide_admin_notice', 'dispose');
} else {
	$business_architect_info = get_option('business_architect_hide_admin_notice', 'show');
	if ($business_architect_info != 'dispose' || $business_architect_info ==""){ 
		add_action( 'admin_notices', 'business_architect_help_notice' );
	}
}

define ('business_architect_theme_url', 'https://wpbusinessthemes.com/product/agency-starter-theme/');

if(!function_exists('business_architect_help_notice')):

function business_architect_help_notice() {
    $class = 'notice notice-info';
    $message = __( '! Install recomended plugins before installing demo. Enable | Disable slider from customizer theme options.', 'business-architect' );
		
	$demo_msg = __( '1. Get Demo Contents & Tutorials', 'business-architect');	
	$demo_install = __( '2. Install Demo', 'business-architect');	
 	
	$dismiss = __( 'Hide Notice', 'business-architect');

    printf( '<div class="%1$s"> <p><strong><span>%2$s</span></strong> &nbsp;&nbsp; 
	<strong><a href="%3$s" target="_blank"  class="button button-primary">%4$s</a></strong> &nbsp;&nbsp;
	<strong><a href="%5$s" class="button button-primary">%6$s</a></strong> &nbsp;&nbsp;
	<em><a href="?hide_admin_notice" target="_self"  class="dismiss-notice" style="float:right">%7$s</a></em> </p></div>', 
	esc_attr( $class ), 
	esc_html( $message ),
	
	esc_url( business_architect_theme_url ), 
	esc_html( $demo_msg ),
	
	esc_url( home_url().'/wp-admin/tools.php?page=advanced-import-tool' ), 
	esc_html( $demo_install ),	
	
	esc_html( $dismiss ) );
}

endif;

