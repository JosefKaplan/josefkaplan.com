<?php
/**
 * Custom template hooks for this theme.
 *
 *
 * @package purea-magazine
 */


/**
 * Before title meta hook
 */
if ( ! function_exists( 'purea_magazine_before_title' ) ) :
function purea_magazine_before_title() {
	do_action('purea_magazine_before_title');
}
endif;

/**
 * After title meta hook
 */
if ( ! function_exists( 'purea_magazine_after_title' ) ) :
function purea_magazine_after_title() {
	do_action('purea_magazine_after_title');
}
endif;

/**
 * Highlight area after content hook
 */
if ( ! function_exists( 'purea_magazine_highlight_area_after_content' ) ) :
function purea_magazine_highlight_area_after_content() {
	do_action('purea_magazine_highlight_area_after_content');
}
endif;

/**
 * Featured area after content hook
 */
if ( ! function_exists( 'purea_magazine_featured_area_after_content' ) ) :
function purea_magazine_featured_area_after_content() {
	do_action('purea_magazine_featured_area_after_content');
}
endif;

/**
 * Posts Layout 1 area after meta hook
 */
if ( ! function_exists( 'purea_magazine_posts_layout_1_after_meta' ) ) :
function purea_magazine_posts_layout_1_after_meta() {
	do_action('purea_magazine_posts_layout_1_after_meta');
}
endif;

/**
 * Single post content after meta hook
 */
if ( ! function_exists( 'purea_magazine_single_post_after_content' ) ) :
function purea_magazine_single_post_after_content($postID) {
	do_action('purea_magazine_single_post_after_content',$postID);
}
endif;