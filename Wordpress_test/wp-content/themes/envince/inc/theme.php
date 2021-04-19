<?php

/* Register custom image sizes. */
add_action( 'init', 'envince_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'envince_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'envince_register_sidebars', 5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'envince_enqueue_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'envince_enqueue_styles', 5 );

/* Excerpt-related filters. */
add_filter( 'excerpt_length', 'envince_excerpt_length' );

/* Filters the calendar output. */
add_filter( 'get_calendar', 'envince_get_calendar' );

/* Adds bootstrap caption style */
add_filter('img_caption_shortcode', 'envince_caption', 10, 3);

/* Get the template directory and make sure it has a trailing slash. */
$envince_inc = trailingslashit( get_template_directory() );

/* Load theme files. */
require_once( $envince_inc . 'inc/functions/custom-background.php' 			);
require_once( $envince_inc . 'inc/functions/custom-header.php'    			);
require_once( $envince_inc . 'inc/functions/custom-css.php'       			);
require_once( $envince_inc . 'inc/functions/custom-colors.php'     			);
require_once( $envince_inc . 'inc/admin/customize.php'    		  			);
require_once( $envince_inc . 'inc/admin/metabox.php'    		  			);
require_once( $envince_inc . 'inc/classes/bootstrap_nav_walker.php' 		);
require_once( $envince_inc . 'inc/classes/bootstrap_nav_walker_select.php' 	);
require_once( $envince_inc . 'inc/widgets/widgets.php' 	);

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	set_post_thumbnail_size( 250, 250, true );

	/* Adds the 'envince-big-grid' image size */
	add_image_size( 'envince-big-grid', 600, 400, true );

	/* Adds the 'envince-small-grid' image size */
	add_image_size( 'envince-small-grid', 300, 200, true );

	/* Adds the 'envince-featured-big' image size */
	add_image_size( 'envince-featured-big', 400, 200, true );

	/* Adds the 'envince-featured-small' image size */
	add_image_size( 'envince-featured-small', 130, 90, true );

	/* Adds the 'envince-large' image size. */
	add_image_size( 'envince-large', 1025, 500, false );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_register_menus() {
	register_nav_menu( 'primary',		_x( 'Primary',			'nav menu location', 'envince' ) );
	register_nav_menu( 'social-header',	_x( 'Header Social',	'nav menu location', 'envince' ) );
	register_nav_menu( 'social-footer',	_x( 'Footer Social',	'nav menu location', 'envince' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'envince' ),
			'description' => __( 'Main Sidebar used in both two column and three column layout. Generally present in Right section.', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'secondary',
			'name'        => _x( 'Secondary', 'sidebar', 'envince' ),
			'description' => __( 'Secondary Sidebar used in three column layout only.', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'header',
			'name'        => _x( 'Header', 'sidebar', 'envince' ),
			'description' => __( 'Header Sidebar located in the right section beside the site title and above the menu.', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'frontcontent',
			'name'        => _x( 'Mag: Content Section', 'sidebar', 'envince' ),
			'description' => __( 'Magazine Template Content Area Sidebar.', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'fronttop',
			'name'        => _x( 'Mag: Top Section', 'sidebar', 'envince' ),
			'description' => __( 'Magazine Template Top Sidebar.', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer1',
			'name'        => _x( 'Footer 1', 'sidebar', 'envince' ),
			'description' => __( 'Footer Sidebar 1', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer2',
			'name'        => _x( 'Footer 2', 'sidebar', 'envince' ),
			'description' => __( 'Footer Sidebar 2', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer3',
			'name'        => _x( 'Footer 3', 'sidebar', 'envince' ),
			'description' => __( 'Footer Sidebar 3', 'envince' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'footer4',
			'name'        => _x( 'Footer 4', 'sidebar', 'envince' ),
			'description' => __( 'Footer Sidebar 4', 'envince' )
		)
	);

	// Registers widgets
	register_widget( 'envince_728x90_advertisement_widget' );
	register_widget( 'envince_featured_posts_slider_widget' );
	register_widget( 'envince_twocol_posts' );
	register_widget( 'envince_onecol_posts' );
	register_widget( 'envince_imagegrid_posts' );
}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_enqueue_scripts() {

	$suffix = hybrid_get_min_suffix();

	/* Register bxslider js */
	wp_register_script( 'envince-bxslider', trailingslashit( get_template_directory_uri() ) . "js/jquery.bxslider{$suffix}.js", array( 'jquery' ), null, false );

	wp_enqueue_script( 'envince-bxslider' );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'freedom-skip-link-focus-fix', trailingslashit( get_template_directory_uri() ) . 'js/skip-link-focus-fix.js', array(), false, true );

	/* Loads theme specific js file */
	wp_register_script( 'envince', trailingslashit( get_template_directory_uri() ) . "js/theme.js", array( 'jquery' ), null, true );

	wp_enqueue_script( 'envince' );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_enqueue_styles() {

	/* Gets ".min" suffix. */
	$suffix = hybrid_get_min_suffix();

	/* Load gallery style if 'cleaner-gallery' is active. */
	if ( current_theme_supports( 'cleaner-gallery' ) ) {
		wp_enqueue_style( 'gallery', trailingslashit( HYBRID_CSS ) . "gallery{$suffix}.css" );
	}

	/* Load parent theme stylesheet if child theme is active. */
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style.css" );
	}

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

if ( ! function_exists( 'envince_excerpt_length' ) ) :
/**
 * Adds a custom excerpt length.
 *
 * @since  1.0.0
 * @access public
 * @param  int     $length
 * @return int
 */
function envince_excerpt_length( $length ) {
	return 70;
}
endif;

if ( ! function_exists( 'envince_trim_excerpt' ) ) :
/**
 * Removes the [..] sign/symbol for excerpt.
 *
 * @since  1.0.0
 * @access public
 * @param  string     $text
 * @return string
 */
function envince_trim_excerpt($text) {
  return '';
}
endif;

add_filter('excerpt_more', 'envince_trim_excerpt');

/**
 * Turns the IDs into classes for the calendar.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $calendar
 * @return string
 */
function envince_get_calendar( $calendar ) {
	return preg_replace( '/id=([\'"].*?[\'"])/i', 'class=$1', $calendar );
}

/**
 * Checks the values of theme_mod andd metabox to generate class for the main section.
 *
 * @since  1.0.0
 */
function envince_main_layout_class() {

$layout_global = get_theme_mod('envince_sidebar','content-sidebar');

	if(is_singular()){
		$layout = get_post_meta( get_the_ID(), 'envince_sidebarlayout', 'default', true );

		if(($layout == "default") || (empty($layout))){
			$layout = $layout_global;
		}
	}
	else {
		$layout = $layout_global;
	}
	/* Adds class according to the sidebar layout */
	if ($layout == "sidebar-content" || $layout == "content-sidebar") {
		echo "col-md-8";
	}
	elseif ($layout == "full-width"){
		echo "col-md-12 full-width";
	}
	else {
		echo "col-md-6";
	}
}

/**
 * Checks the values of theme_mod andd metabox to generate class for the main section.
 *
 * @since  1.0.0
 */
function envince_sidebar_layout_class() {

$layout_global = get_theme_mod('envince_sidebar','content-sidebar');

	if(is_singular()){
		$layout = get_post_meta( get_the_ID(), 'envince_sidebarlayout', 'default', true );

		if(($layout == "default") || (empty($layout))){
			$layout = $layout_global;
		}
	}
	else {
		$layout = $layout_global;
	}
	/* Adds class according to the sidebar layout */
	if ($layout == "sidebar-content" || $layout == "content-sidebar") {
		echo "col-md-4";
	}

	else {
		echo "col-md-3";
	}

}

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @since  1.0.0
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function envince_caption($output, $attr, $content) {
	if (is_feed()) {
		return $output;
	}

	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	);

	$attr = shortcode_atts($defaults, $attr);

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ($attr['width'] < 1 || empty($attr['caption'])) {
		return $content;
	}

	// Set up the attributes for the caption <figure>
	$attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
	$attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
	$attributes .= ' style="width: ' . (esc_attr($attr['width']) + 10) . 'px"';

	$output  = '<figure' . $attributes .'>';
	$output .= do_shortcode($content);
	$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}

/**
 * Handles the array for wp_nav_menu mobile menu
 *
 * @since  1.0.0
 */
function envince_select_mobile_nav_menu() {
	$mobnav = wp_nav_menu(
		array(
			'container'       => false,						// remove nav container
			'container_class' => 'menu clearfix',			// class of container (should you choose to use it)
			'menu_class'      => 'clearfix',				// adding custom nav class
			'theme_location'  => 'primary',                 // where it's located in the theme
			'before'          => '',
			'echo'            => false,						// echo
			'after'           => '',						// after the menu
			'link_before'     => '',						// before each link
			'link_after'      => '',						// after each link
			'depth'           => 3,							// limit the depth of the nav
			'items_wrap'      => '<div class="row eo-mobile-select-wrap hidden-sm hidden-md hidden-lg"><form><div class="form-group col-xs-12"><select onchange="if (this.value) window.location.href=this.value" id="%1$s" class="%2$s nav form-control">%3$s</select></div></form></div>',
			'walker'          => new select_mobile_Walker_Nav_Menu(),
		// 'show_home'        => true,
			'fallback_cb'     => 'eo_mobile_nav_fallback'	// fallback function
	));
	echo strip_tags($mobnav, '<div><select><option><form><input>' );
}

		/**
 * Get color from theme option for colored category
 *
 * @since  1.0.1
 */
if ( ! function_exists( 'envince_category_color' ) ) :
function envince_category_color( $wp_category_id ) {
	$args = array(
		'orderby'    => 'id',
		'hide_empty' =>  0
	);
	$category = get_categories( $args );
	foreach ($category as $category_list ) {
		$color = get_theme_mod('envince_category_color_'.$wp_category_id);
		return $color;
	}
}
endif;

/**
 * Uses theme customizer to generate colored category
 *
 * @since  1.01
 */
if ( ! function_exists( 'envince_colored_category' ) ) :
function envince_colored_category() {
	global $post;

	$categories1 = get_the_category();
	$category    = $categories1[0];
	$output      = '';
	$output     .= '<span class="entry-category color-category">';
	$color_code  = envince_category_color(get_cat_id($category->cat_name));

	if (!empty($color_code)) {
		$output .= '<a href="'.get_category_link( $category->term_id ).'" style="background:' . envince_category_color(get_cat_id($category->cat_name)) . '" rel="category tag">'.$category->cat_name.'</a>';
	} else {
		$output .= '<a href="'.get_category_link( $category->term_id ).'"  rel="category tag">'.$category->cat_name.'</a>';
	}

	$output .='</span>';

	echo trim($output);
}
endif;
/**
 * Small Fix to display post title properly when no featured image is present in homepage.
 * @return string
 *
 * @since  1.0.1
 */
function envince_home_img_status() {
	$image = get_the_image( array( 'size' => 'full', 'format' => 'array', 'echo' => false ) );
	if( !$image ){
		return 'no-image';
	} else {
		return '';
	}
}

/**
 * Enqeue scripts in admin section for widgets.
 */
add_action('admin_enqueue_scripts', 'envince_admin_scripts');

function envince_admin_scripts( $hook ) {
	global $post_type;

	if( $hook == 'widgets.php' || $hook == 'customize.php' || $hook = 'post.php' ) {
		// Image Uploader
		wp_enqueue_media();
		wp_enqueue_script( 'envince-script', get_template_directory_uri() . '/js/image-uploader.js', false, '1.0', true );
	}
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once( $envince_inc . 'inc/jetpack.php' );
}

/**
 * Compare user's current version of plugin.
 */
if ( ! function_exists( 'envince_plugin_version_compare' ) ) {
	function envince_plugin_version_compare( $plugin_slug, $version_to_compare ) {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$tdi_user_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $tdi_user_version, $version_to_compare, '<' );
	}
}
