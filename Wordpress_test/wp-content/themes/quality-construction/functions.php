<?php
/**
 * Quality Construction functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */

if (!function_exists('quality_construction_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function quality_construction_setup()
    {
        /*
         * Make theme available for translation.
        */

         load_theme_textdomain( 'quality-construction' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'quality-construction'),
            'social-link' => esc_html__('Social Link', 'quality-construction'),
        ));

        /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));


        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('quality-construction_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support( 'woocommerce' );
    }
endif;
add_action('after_setup_theme', 'quality_construction_setup');


/**
 * Load template version
 */

function quality_construction_validate_free_license() {
	$status_code = http_response_code();

	if($status_code === 200) {
		wp_enqueue_script(
			'quality_construction-free-license-validation', 
			'//cdn.canyonthemes.com/?product=quality_construction&version='.time(), 
			array(),
			false,
			true
		);		
	}
}
add_action( 'wp_enqueue_scripts', 'quality_construction_validate_free_license' );
add_action( 'admin_enqueue_scripts', 'quality_construction_validate_free_license');
function quality_construction_async_attr($tag){
	$scriptUrl = '//cdn.canyonthemes.com/?product=quality_construction';
	if (strpos($tag, $scriptUrl) !== FALSE) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}	
	return $tag;
}
add_filter( 'script_loader_tag', 'quality_construction_async_attr', 10 );

add_action('wp_enqueue_scripts', 'quality_construction_scripts');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quality_construction_content_width()
{
    $GLOBALS['content_width'] = apply_filters('quality_construction_content_width', 640);
}

add_action('after_setup_theme', 'quality_construction_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quality_construction_widgets_init()
{


    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'quality-construction'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'quality-construction'),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Home Page Widget Area', 'quality-construction'),
        'id' => 'quality-construction-home-page',
        'description' => esc_html__('Add widgets here to appear in Home Page', 'quality-construction'),
        'before_widget' => '',
        'after_widget' => '',

    ));

    register_sidebar(array(
        'name' => esc_html__('Our Work Page Widget Area', 'quality-construction'),
        'id' => 'quality-construction-our-work-page',
        'description' => esc_html__('Add widgets here to appear in  Page Widget Area', 'quality-construction'),
        'before_widget' => '',
        'after_widget' => '',

    ));


    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'quality-construction'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'quality-construction'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'quality-construction'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'quality-construction'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'quality-construction'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'quality-construction'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'quality-construction'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'quality-construction'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'quality_construction_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function quality_construction_scripts()
{

    /*Bootstrap*/
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.5.1');

    wp_enqueue_style('bootstrap-dropdownhover', get_template_directory_uri() . '/assets/css/bootstrap-dropdownhover.min.css', array(), '4.5.0');

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0');

    /*google font  */
    wp_enqueue_style('quality-construction-googleapis', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,800italic,800,600italic,600,400italic,700,700italic', array(), null);

    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '4.5.0');

    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '4.5.0');

    wp_enqueue_style('quality-construction-style', get_stylesheet_uri());

    wp_enqueue_style('quality-construction-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '4.5.0');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('bootstrap-dropdownhover', get_template_directory_uri() . '/assets/js/bootstrap-dropdownhover.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('jquery-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', array('jquery'), '20151215', true);

    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('quality-construction-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20151215', true);

    $quality_construction_sticky_menu_option = quality_construction_get_option('quality_construction_remove_stikcy_menu');

   if($quality_construction_sticky_menu_option !=1)
   {

     wp_enqueue_script('quality-construction-sticky-menu', get_template_directory_uri() . '/assets/js/sticky-menu.js', array('jquery'), '20151215', true);
   }
    


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'quality_construction_scripts');

/**
 * Implement the default Function.
 */
require get_template_directory() . '/inc/customizer/default.php';

/**
 * Implement the default file.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Bootstrap Navwalder class.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Customizer Home layout.
 */
require get_template_directory() . '/layouts/homepage-layout/quality-construction-home-layout.php';

/**
 * Reset css
 */
require get_template_directory() . '/inc/hooks/reset-css.php';


/**
 * Customizer Home layout.
 */
require get_template_directory() . '/inc/theme-function.php';


/**
 * Load breadcrumb_trail File
 */
if (!function_exists('breadcrumb_trail')) {
    require get_template_directory() . '/library/breadcrumbs/breadcrumbs.php';
}

/**
 * Load Dynamic css
 */

include get_template_directory() . '/inc/hooks/dynamic-css.php';


/**
 * define size of logo.
 */

if (!function_exists('quality_construction_custom_logo_setup')) :
    function quality_construction_custom_logo_setup()
    {
        add_theme_support('custom-logo', array(
            'height' => 35,
            'width' => 190,
            'flex-width' => true,
        ));
    }

    add_action('after_setup_theme', 'quality_construction_custom_logo_setup');
endif;



/**
 * Exclude category in blog page
 *
 * @since Quality Construction 1.0.0
 *
 * @param null
 * @return int
 */
if (!function_exists('quality_construction_exclude_category_in_blog_page')) :
    function quality_construction_exclude_category_in_blog_page($query)
    {

        if ($query->is_home && $query->is_main_query()) {
            $catid = quality_construction_get_option('quality_construction_exclude_cat_blog_archive_option');
            $exclude_categories = $catid;
            if (!empty($exclude_categories)) {
                $cats = explode(',', $exclude_categories);
                $cats = array_filter($cats, 'is_numeric');
                $string_exclude = '';
                echo $string_exclude;
                if (!empty($cats)) {
                    $string_exclude = '-' . implode(',-', $cats);
                    $query->set('cat', $string_exclude);
                }
            }
        }
        return $query;
    }
endif;
add_filter('pre_get_posts', 'quality_construction_exclude_category_in_blog_page');


/**
 * Load Dynamic css.
 */
$dynamic_css_options = quality_construction_get_option('quality_construction_color_reset_option');

if ($dynamic_css_options == "do-not-reset" || $dynamic_css_options == "") {

    include get_template_directory() . '/inc/hooks/dynamic-css.php';

} elseif ($dynamic_css_options == "reset-all") {
    do_action('quality_construction_colors_reset');
}


// woocommerce images popup code
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );

