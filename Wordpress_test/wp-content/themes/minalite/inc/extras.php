<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package minalite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function minalite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'minalite_body_classes' );

/**
 * Custom excerpt more
 */
function minalite_custom_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'minalite_custom_excerpt_more' );

/**
 * Custom styling
 *
 * @return string
 */
function minalite_get_custom_style(){
    $css = '';
    $primary_color = esc_attr( get_theme_mod( 'minalite_color_accent' ) );
    if ( $primary_color ) {
        $primary_color = '#'.$primary_color;

        /**
         * @TODO beautiful output code
         */
$css .= '
a {
    color: '.$primary_color.';
}
.entry-cate a {
	color: '.$primary_color.';
}
.widget-title {
	border-color: '.$primary_color.';
}
.entry-tags a:hover {
	background-color: '.$primary_color.';
}
time.entry-date:hover{
  color: '.$primary_color.';
}
.entry-more a:hover {
  color: '.$primary_color.';
}

';

    }
    return $css;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function minalite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'minalite_pingback_header' );

function minalite_light_get_image_src( $image_id, $size = 'full' ) {
	$img_attr = wp_get_attachment_image_src( intval( $image_id ), $size );
	if ( ! empty( $img_attr[0] ) ) {
		return $img_attr[0];
	}
}
