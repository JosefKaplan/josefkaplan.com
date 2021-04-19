<?php
/**
 * Purea Magazine Theme Customizer Data Sanitization
 *
 * @package purea-magazine
 */


/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
if ( ! function_exists( 'purea_magazine_sanitize_checkbox' ) ) :
function purea_magazine_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
endif;


/**
 * URL sanitization.
 *
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
if ( ! function_exists( 'purea_magazine_sanitize_url' ) ) :
function purea_magazine_sanitize_url( $url ) {
    return esc_url_raw( $url );
}
endif;


/**
 * String sanitization.
 *
 * @see sanitize_text_field() https://developer.wordpress.org/reference/functions/sanitize_text_field/
 *
 * @param string $str to sanitize.
 * @return string Sanitized string.
 */
if ( ! function_exists( 'purea_magazine_sanitize_text_field' ) ) :
function purea_magazine_sanitize_text_field( $str ) {
    return sanitize_text_field( $str );
}
endif;


/**
 * Number sanitization.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param mixed $str to sanitize.
 * @return int, A non-negative integer.
 */
if ( ! function_exists( 'purea_magazine_sanitize_number' ) ) :
function purea_magazine_sanitize_number( $str ) {
    return absint( $str );
}
endif;


/**
 * Multiline String sanitization.
 *
 * @see sanitize_textarea_field() https://developer.wordpress.org/reference/functions/sanitize_textarea_field/
 *
 * @param string $str to sanitize.
 * @return string Sanitized string.
 */
if ( ! function_exists( 'purea_magazine_sanitize_textarea_field' ) ) :
function purea_magazine_sanitize_textarea_field( $str ) {
    return sanitize_textarea_field( $str );
}
endif;


/**
 * Select sanitization.
 */
if ( ! function_exists( 'purea_magazine_sanitize_select' ) ) :
function purea_magazine_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

/**
 * Title sanitization.
 */
if ( ! function_exists( 'purea_magazine_sanitize_title' ) ) :
function purea_magazine_sanitize_title( $str ) {
	return sanitize_title( $str );	
}
endif;