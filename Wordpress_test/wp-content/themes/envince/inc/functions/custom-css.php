<?php

/* Register custom sections, settings, and controls. */
add_action( 'customize_register', 'envince_customize_css_register' );

/* Output CSS into <head>. */
add_action( 'wp_head', 'print_custom_css', 20 );

/* Delete the cached data for this feature. */
add_action( 'update_option_theme_mods_' . get_stylesheet(), 'custom_css_cache_delete' );

/**
 * Deletes the cached style CSS that's output into the header.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */

function custom_css_cache_delete() {
	wp_cache_delete( 'envince_custom_css' );
}


function print_custom_css() {
	/* Get the cached style. */
	$style = wp_cache_get( 'envince_custom_css' );

	/* If the style is available, output it and return. */
	if ( !empty( $style ) ) {
		echo $style;
		return;
	} else {

		/* Adding custom css based on customizer setting */
		$layout_style = get_theme_mod('envince_layout_style', 'boxed');
		$layout_width = get_theme_mod('envince_layout_width', '1170');
		$layout_width_min = '';

		if($layout_width == "1600"){
			$layout_width_min = "1630";
		}

		if($layout_width == "1170"){
			$layout_width_min = "1200";
		}

		if($layout_width == "992"){
			$layout_width_min = "970";
		}

		if($layout_width == "768"){
			$layout_width_min = "750";
		}

		$custom_css = '';

		if($layout_style == "boxed") {
		$custom_css .= '
		@media (min-width: '.$layout_width_min.'px) {
			.container, #container {
				width: '.$layout_width.'px!important;
			}
		}';
		}
		else {
		$custom_css .= '
		@media (min-width: '.$layout_width_min.'px) {
			.container {
				width: '.$layout_width.'px!important;
			}
		}';
		}

		/* Fetch header image and add css only if header image exists */
		$header_image = get_header_image();
		if($header_image){
			if ( ! function_exists( 'the_custom_header_markup' ) || ( function_exists( 'the_custom_header_markup' ) && ( ( ! has_header_video() ) || ( ! is_front_page() && has_header_video() ) ) ) ) {
				$custom_css .= '
				#intro{
					height: auto;
					margin: 0 auto;
					width: 100%;
					position: relative;
					padding: 150px 0;
				}
				#intro{
					background: url('.$header_image.') 50% 0 fixed;
				}';
			}
		}
		/* Put the final style output together. */
		$envince_custom_css_value = '';
		$envince_custom_css = get_theme_mod( 'envince_custom_css' );
		if( $envince_custom_css && ! function_exists( 'wp_update_custom_css_post' ) ) {
			$envince_custom_css_value = $envince_custom_css;
		}


		$style = "\n" . '<style type="text/css" id="custom-css">' .$custom_css. "\n" .trim( $envince_custom_css_value ) . '</style>' . "\n";

		/* Cache the style, so we don't have to process this on each page load. */
		wp_cache_set( 'envince_custom_css', $style );

		/* Output the custom style. */
		echo $style;
	}
}

/**
 * Registers custom sections, settings, and controls for the $wp_customize instance.
 *
 * @since 1.0.0
 * @access private
 * @param object $wp_customize
 */
function envince_customize_css_register( $wp_customize ) {

	if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
		/* Add the section. */
		$wp_customize->add_section(
			'envince_custom',
			array(
				'title'      => esc_html__( 'Custom CSS', 'envince' ),
				'priority'   => 200,
				'capability' => 'edit_theme_options'
			)
		);

		/* Add the 'custom_css' setting. */
		$wp_customize->add_setting(
			'envince_custom_css',
			array(
				'default'              => '',
				'type'                 => 'theme_mod',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'custom_css_sanitize',
				'transport'            => 'postMessage',
			)
		);

		/* Add the textarea control for the 'custom_css' setting. */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'envince_custom_css',
				array(
					'label'    => '',
					'type'     => 'textarea',
					'section'  => 'envince_custom',
					'settings' => 'envince_custom_css',
				)
			)
		);
	}

	/* If viewing the customize preview screen, add a script to show a live preview. */
	if ( $wp_customize->is_preview() && !is_admin() ) {
		add_action( 'wp_footer', 'envince_customize_preview_script', 22 );
	}
}

/**
 * Handles changing settings for the live preview of the theme.
 *
 * @since 0.3.2
 * @access private
 */
function envince_customize_preview_script() {

	?>
	<script type="text/javascript">
	wp.customize(
		'envince_custom_css',
		function( value ) {
			value.bind(
				function( to ) {
					jQuery( '#custom-css' ).text( to );
				}
			);
		}
	);
	</script>
	<?php
}

/**
 * sanitize css input
 *
 * @since 1.0.0
 * @access private
 */
function custom_css_sanitize($value) {

	return stripslashes( wp_filter_post_kses( addslashes( $value ) ) );

}

/**
* Migrate any existing theme CSS codes added in Customize Options to the core option added in WordPress 4.7
*/
function envince_custom_css_migrate() {
if ( function_exists( 'wp_update_custom_css_post' ) ) {
	$custom_css = get_theme_mod( 'envince_custom_css' );
	if ( $custom_css ) {
		$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
		$return = wp_update_custom_css_post( $core_css . $custom_css );
		if ( ! is_wp_error( $return ) ) {
			// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
			remove_theme_mod( 'envince_custom_css' );
		}
	}
}
}
add_action( 'after_setup_theme', 'envince_custom_css_migrate' );
