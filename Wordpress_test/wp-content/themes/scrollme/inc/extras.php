<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package scrollme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function scrollme_body_classes( $classes ) {
	global $post;
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if( is_singular( array( 'post', 'page' )) ) {
		$post_sidebar = get_post_meta( $post->ID, 'scrollme_sidebar_layout', true );
		if( empty( $post_sidebar ) ) {
			$classes[] = 'right_sidebar';
		}else{
			$classes[] = $post_sidebar;
		}
	}

	return $classes;
}
add_filter( 'body_class', 'scrollme_body_classes' );

// Remove current class on hash menu
add_filter('nav_menu_css_class', 'scrollme_remove_current_class_hash', 10, 2 );

function scrollme_remove_current_class_hash($classes, $item) {
	$class_names = array( 'current-menu-item', 'current-menu-ancestor', 'current-menu-parent', 'current_page_parent',  'current_page_ancestor', 'current_page_item' );
	if( strpos( $item->url, '#' ) !== false ) {
		foreach( $class_names as $class_name ) {
			if(($key = array_search($class_name, $classes)) !== false) {
				unset($classes[$key]);
			}
		}

	}
	return $classes;
}

/**
 * Custom Search Form
 */
function scrollme_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:', 'scrollme' ) . '</label>
	<input type="search" class="search-field" placeholder="'. __('Search..', 'scrollme').'" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="search-submit" value="'. __('Search..', 'scrollme').'" />
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'scrollme_search_form' );

/**
 * Sidebar Layout Class
 */
function scrollme_get_sidebar_layout()  {
	global $post;
	$post_sidebar = 'right_sidebar';

	if( is_singular() ) {
		$post_sidebar = get_post_meta( $post->ID, 'scrollme_sidebar_layout', true );
	}
	
	return $post_sidebar;
}

/** Add Editor Styles **/
function scrollme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

add_action( 'admin_init', 'scrollme_add_editor_styles' );

function scrollme_dynamic_style() {
    $preloader = get_theme_mod( 'scrollme_preloader' );
    $disp_cap_in_mobile = absint(get_theme_mod('scrollme_disp_caption_in_mobile', 0));
    
    if( isset( $preloader ) && $preloader == '' ) :
    ?>
    <style>
    .no-js #loader { display: none; }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .scrollme-preloader { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999999; background: url('<?php echo esc_url(get_template_directory_uri()."/images/loading.gif"); ?>') center no-repeat #fff;}
	
	<?php if(!$disp_cap_in_mobile) : ?>
    @media screen and (max-width:580px) {
	.slide-desc{
			display: none;
		}
	}
	<?php endif; ?>
    </style>
    <?php
    endif;
}
add_action( 'wp_head', 'scrollme_dynamic_style', 15 );

/** Woocommerce Tweaks **/
/**
	* Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'scrollme_loop_columns');
if (!function_exists('scrollme_loop_columns')) {
   function scrollme_loop_columns() {
       $xr = 3;
       return $xr;
   }
}

add_action( 'body_class', 'scrollme_woo_body_class');
if (!function_exists('scrollme_woo_body_class')) {
   function scrollme_woo_body_class( $class ) {
          $class[] = 'columns-'.scrollme_loop_columns();
          return $class;
   }
}

function woo_related_products_limit() {
	  global $product;
		
		$args['posts_per_page'] = 6;
		return $args;
	}
add_filter( 'woocommerce_output_related_products_args', 'scrollme_related_products_args' );

function scrollme_related_products_args( $args ) {
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}