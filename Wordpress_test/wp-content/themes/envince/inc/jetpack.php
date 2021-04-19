<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package ThemeGrill
 * @subpackage Envince
 * @since Envince 1.1.8
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/content-options/
 */
function envince_jetpack_setup() {

	 // Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'style',
			'author'     => '.fa-user,.entry-author',
			'date'       => '.fa-calendar,.entry-published',
			'comment'    => '.fa-comment-o,.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'envince_jetpack_setup' );