<?php
/**
 * Define sanitize functions for customizer fields
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 * @since 1.0.0
 */

/**
 * Sanitize number
 *
 * @since Quality Construction 1.0.0
 *
 * @param $quality_construction_input
 * @param $quality_construction_setting
 * @return int || float || numeric value
 */
if ( !function_exists( 'quality_construction_sanitize_number' ) ) :
    function quality_construction_sanitize_number( $input ) {
        $output = intval($input);
        return $output;
    }
endif;

/**
 * Sanitize checkbox field
 *
 * @since Quality Construction 1.0.0
 *
 * @param $checked
 * @return Boolean
 */
if ( !function_exists('quality_construction_sanitize_checkbox') ) :
    function quality_construction_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
endif;


/**
 * Sanitize the page/post
 *
 * @since Quality Construction 1.0.0
 *
 * @param $page_id
 * @return sanitized output as $input
 */
if ( !function_exists( 'quality_construction_sanitize_dropdown_pages' ) ) :
        function quality_construction_sanitize_dropdown_pages( $page_id, $setting ) {
            $page_id = absint($page_id );
            // If $page_id is an ID of a published page, return it; otherwise, return the default.
          return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
        }
endif;

/**
 * Sanitizing the select callback example
 *
 * @since Quality Construction 1.0.0
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 */
if ( !function_exists('quality_construction_sanitize_select') ) :
    function quality_construction_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

