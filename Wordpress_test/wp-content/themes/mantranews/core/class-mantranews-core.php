<?php
/**
 * Mantranews Class
 *
 * @package Tejas
 * @since 1.0.0
 */

if (!class_exists('Mantranews_Core')) :

    /**
     * Mantranews Class
     *
     */
    class Mantranews_Core
    {

        /**
         * Instance
         *
         * @since 1.0.0
         *
         * @access private
         * @var object Class object.
         */
        private static $instance;

        /**
         * Initiator
         *
         * @since 1.0.0
         *
         * @return object initialized object of class.
         */
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self;
            }
            self::$instance->init();
            return self::$instance;
        }

        /**
         * Initialize the theme
         *
         * @since 1.0.0
         */
        public function init()
        {
             $this->includes();
             $this->include_hooks();
        }


        public function includes()
        {

            if (!function_exists('mantranews_sass_darken')) :
                function mantranews_sass_darken($hex, $percent)
                {
                    preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
                    str_replace('%', '', $percent);
                    $color = "#";
                    for ($i = 1; $i <= 3; $i++) {
                        $rgb = hexdec($primary_colors[$i]);
                        $calculated_color = round($rgb * (100 - ($percent * 2)) / 100);
                        $calculated_color = $calculated_color < 0 ? 0 : $calculated_color;
                        $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
                    }

                    return $color;
                }
            endif;
            if (!function_exists('mantranews_sass_lighten')) :
                function mantranews_sass_lighten($hex, $percent)
                {
                    if (!$hex) {
                        return;
                    }
                    preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
                    str_replace('%', '', $percent);
                    $color = "#";
                    for ($i = 1; $i <= 3; $i++) {
                        $rgb = hexdec($primary_colors[$i]);
                        $calculated_color = round((int)$rgb * (100 + (int)$percent) / 100);
                        $calculated_color = $calculated_color > 254 ? 255 : $calculated_color;
                        $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
                    }

                    return $color;
                }

            endif;
            if (!function_exists('mantranews_setup')) :
                /**
                 * Sets up theme defaults and registers support for various WordPress features.
                 *
                 * Note that this function is hooked into the after_setup_theme hook, which
                 * runs before the init hook. The init hook is too late for some features, such
                 * as indicating support for post thumbnails.
                 */
                function mantranews_setup()
                {
                    /*
                     * Make theme available for translation.
                     * Translations can be filed in the /languages/ directory.
                     * If you're building a theme based on Mantranews, use a find and replace
                     * to change 'mantranews' to the name of your theme in all the template files.
                     */
                    load_theme_textdomain('mantranews', get_template_directory() . '/languages');

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
                     * Enable support for custom logo.
                     */
                    add_theme_support('custom-logo', array(
                        'height' => 175,
                        'width' => 400,
                        'flex-width' => true,
                        'flex-height' => true
                    ));

                    add_image_size('mantranews-slider-large', 1020, 741, true);
                    add_image_size('mantranews-featured-medium', 420, 307, true);
                    add_image_size('mantranews-featured-long', 300, 443, true);
                    add_image_size('mantranews-block-medium', 464, 290, true);
                    add_image_size('mantranews-carousel-image', 600, 500, true);
                    add_image_size('mantranews-block-thumb', 322, 230, true);
                    add_image_size('mantranews-single-large', 1210, 642, true);

                    /*
                     * Enable support for Post Thumbnails on posts and pages.
                     *
                     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
                     */
                    add_theme_support('post-thumbnails');

                    // This theme uses wp_nav_menu() in one location.
                    register_nav_menus(array(
                        'primary' => esc_html__('Primary Menu', 'mantranews'),
                        'top-header' => esc_html__('Top Header Menu', 'mantranews'),
                        'footer' => esc_html__('Footer Menu', 'mantranews'),
                    ));

                    /*
                     * Switch default core markup for search form, comment form, and comments
                     * to output valid HTML5.
                     */
                    add_theme_support('html5', array(
                        'search-form',
                        'comment-form',
                        'comment-list',
                        'gallery',
                        'caption',
                    ));

                    /*
                     * Enable support for Post Formats.
                     * See https://developer.wordpress.org/themes/functionality/post-formats/
                     */
                    add_theme_support('post-formats', array(
                        'aside',
                        'image',
                        'video',
                        'quote',
                        'link',
                    ));

                    // Set up the WordPress core custom background feature.
                    add_theme_support('custom-background', apply_filters('mantranews_custom_background_args', array(
                        'default-color' => 'ffffff',
                        'default-image' => '',
                    )));

                    /*
                     * This theme styles the visual editor to resemble the theme style,
                     * specifically font, colors, and column width.
                      */
                    add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
                }
            endif;
            add_action('after_setup_theme', 'mantranews_setup');

            /**
             * Define Directory Location Constants
             */
            define('MANTRANEWS_PARENT_DIR', get_template_directory());
            define('MANTRANEWS_CHILD_DIR', get_stylesheet_directory());

            define('MANTRANEWS_CORE_DIR', MANTRANEWS_PARENT_DIR . '/core');
            define('MANTRANEWS_CSS_DIR', MANTRANEWS_PARENT_DIR . '/css');
            define('MANTRANEWS_JS_DIR', MANTRANEWS_PARENT_DIR . '/js');
            define('MANTRANEWS_LANGUAGES_DIR', MANTRANEWS_PARENT_DIR . '/languages');

            define('MANTRANEWS_ADMIN_DIR', MANTRANEWS_CORE_DIR . '/admin');
            define('MANTRANEWS_WIDGETS_DIR', MANTRANEWS_CORE_DIR . '/widgets');

            define('MANTRANEWS_ADMIN_IMAGES_DIR', MANTRANEWS_ADMIN_DIR . '/images');

            /**
             * Define URL Location Constants
             */
            define('MANTRANEWS_PARENT_URL', get_template_directory_uri());
            define('MANTRANEWS_CHILD_URL', get_stylesheet_directory_uri());

            define('MANTRANEWS_INCLUDES_URL', MANTRANEWS_PARENT_URL . '/inc');
            define('MANTRANEWS_CSS_URL', MANTRANEWS_PARENT_URL . '/css');
            define('MANTRANEWS_JS_URL', MANTRANEWS_PARENT_URL . '/js');
            define('MANTRANEWS_LANGUAGES_URL', MANTRANEWS_PARENT_URL . '/languages');

            define('MANTRANEWS_ADMIN_URL', MANTRANEWS_INCLUDES_URL . '/admin');
            define('MANTRANEWS_WIDGETS_URL', MANTRANEWS_INCLUDES_URL . '/widgets');

            define('MANTRANEWS_ADMIN_IMAGES_URL', MANTRANEWS_ADMIN_URL . '/images');


            /**
             * define theme version variable
             * @since 1.0.0
             */
            function mantranews_theme_version()
            {
                $mantranews_theme_info = wp_get_theme();
                $GLOBALS['mantranews_version'] = $mantranews_theme_info->get('Version');
            }

            add_action('after_setup_theme', 'mantranews_theme_version', 0);
            /**
             * Set the content width in pixels, based on the theme's design and stylesheet.
             *
             * Priority 0 to make it available to lower priority callbacks.
             *
             * @global int $content_width
             */
            function mantranews_content_width()
            {
                $GLOBALS['content_width'] = apply_filters('mantranews_content_width', 640);
            }

            add_action('after_setup_theme', 'mantranews_content_width', 0);

            /**
             * Implement the Custom Header feature.
             */
            require get_template_directory() . '/core/custom-header.php';

            /**
             * Custom template tags for this theme.
             */
            require get_template_directory() . '/core/template-tags.php';

            /**
             * Custom functions that act independently of the theme templates.
             */
            require get_template_directory() . '/core/extras.php';

            /**
             * Customizer additions.
             */
            require get_template_directory() . '/core/customizer.php';

            /**
             * Mantranews custom functions
             */
            require get_template_directory() . '/core/mantranews-functions.php';

            /**
             * Load Jetpack compatibility file.
             */
            require get_template_directory() . '/core/jetpack.php';

            /**
             * Load widgets areas
             */
            require get_template_directory() . '/core/widgets/mantranews-widgets-area.php';

            /**
             * Load metabox
             */
            require get_template_directory() . '/core/admin/inc/metaboxes/mantranews-post-metabox.php';

            /**
             * Load customizer custom classes
             */
            require get_template_directory() . '/core/admin/inc/mantranews-custom-classes.php'; //custom classes

            /**
             * Load customizer sanitize
             */
            require get_template_directory() . '/core/admin/inc/mantranews-sanitize.php'; //custom classes


            /**
             * Load theme about page
             */
            require MANTRANEWS_CORE_DIR. '/about-theme/mantranews-about.php';


            /**
             * Load TGMPA Configs.
             */
            require_once(MANTRANEWS_CORE_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php');

            require_once(MANTRANEWS_CORE_DIR . '/tgm-plugin-activation/tgmpa-mantranews.php');


        }

        public function include_hooks(){

            require get_template_directory() . '/core/hooks/class-mantranews-header-hooks.php'; //Header Hooks

        }
    }

endif;
