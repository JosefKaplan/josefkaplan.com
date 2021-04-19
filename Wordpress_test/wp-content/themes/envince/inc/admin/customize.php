<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    envince
 * @author     Rajeeb Banstola <rajeebthegreat@gmail.com>
 * @copyright  Copyright (c) 2014, Rajeeb Banstola
 * @link       http://rajeebbanstola.com.np
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-3.0.html
 */

/* Custom Controls */
add_action( 'customize_register', 'envince_custom_controls' );

/**
 * Loads custom control for layout settings
 */
function envince_custom_controls() {

	require_once get_template_directory() . '/inc/admin/customize-control-layout.php';

}

/* Theme Customizer setup. */
add_action( 'customize_register', 'envince_customize_register' );

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @access public
 *
 * @param  object $wp_customize
 *
 * @return void
 */
function envince_customize_register( $wp_customize ) {

	// Transport postMessage variable set
	$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	/* Load JavaScript files. */
	add_action( 'customize_preview_init', 'envince_enqueue_customizer_scripts' );

	/* Enable live preview for WordPress theme features. */
	$wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_image' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'background_position_x' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_repeat' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '#site-title a',
			'render_callback' => 'envince_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '#site-description',
			'render_callback' => 'envince_customize_partial_blogdescription',
		) );
	}

	/* Remove the WordPress display header text control. */
	$wp_customize->remove_control( 'display_header_text' );

	/**
	 * Class to include upsell link campaign for theme.
	 *
	 * Class ENVINCE_Upsell_Section
	 */
	class ENVINCE_Upsell_Section extends WP_Customize_Section {
		public $type = 'envince-upsell-section';
		public $url  = '';
		public $id   = '';

		/**
		 * Gather the parameters passed to client JavaScript via JSON.
		 *
		 * @return array The array to be exported to the client as JSON.
		 */
		public function json() {
			$json        = parent::json();
			$json['url'] = esc_url( $this->url );
			$json['id']  = $this->id;

			return $json;
		}

		/**
		 * An Underscore (JS) template for rendering this section.
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="envince-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
				<h3 class="accordion-section-title"><a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a></h3>
			</li>
			<?php
		}
	}

// Register `ENVINCE_Upsell_Section` type section.
	$wp_customize->register_section_type( 'ENVINCE_Upsell_Section' );

// Add `ENVINCE_Upsell_Section` to display pro link.
	$wp_customize->add_section(
		new ENVINCE_Upsell_Section( $wp_customize, 'envince_upsell_section',
			array(
				'title'      => esc_html__( 'View PRO version', 'envince' ),
				'url'        => 'https://themegrill.com/themes/envince/?utm_source=envince-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'capability' => 'edit_theme_options',
				'priority'   => 1,
			)
		)
	);

	/* Add 'site_title' setting */
	$wp_customize->add_setting(
		'envince_site_title',
		array(
			'default'           => '1',
			'sanitize_callback' => 'envince_sanitize_checkbox',
		)
	);

	/* Add 'site_title' control */
	$wp_customize->add_control(
		'envince_site_title',
		array(
			'label'   => esc_html__( 'Display Site Title', 'envince' ),
			'section' => 'title_tagline',
			'type'    => 'checkbox',
		)
	);

	/* Add 'site_description' setting */
	$wp_customize->add_setting(
		'envince_site_description',
		array(
			'default'           => '1',
			'sanitize_callback' => 'envince_sanitize_checkbox',
		)
	);

	/* Add 'site_description' control */
	$wp_customize->add_control(
		'envince_site_description',
		array(
			'label'   => esc_html__( 'Display Site Tagline', 'envince' ),
			'section' => 'title_tagline',
			'type'    => 'checkbox',
		)
	);

	/* Add 'layout' section */
	$wp_customize->add_section(
		'envince_layout',
		array(
			'title'       => esc_html__( 'Layout', 'envince' ),
			'description' => 'Select main content and sidebar layout for blog.(Note: Layout for individual posts and pages can be selected in the respective posts and pages.',
			'priority'    => 50,
			'capability'  => 'edit_theme_options',
		)
	);

	/* Add 'sidebar layout' setting. */
	$wp_customize->add_setting(
		'envince_sidebar',
		array(
			'default'           => 'content-sidebar',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'envince_sanitize_layout_sidebar',
		)
	);

	/* Add 'sidebar layout' control. */
	$wp_customize->add_control(
		new Layout_Picker_Custom_Control(
			$wp_customize,
			'envince_sidebar',
			array(
				'label'   => esc_html__( 'Layout Sidebar', 'envince' ),
				'section' => 'envince_layout',
			)
		)
	);

	/* Add 'layout style' setting. */
	$wp_customize->add_setting(
		'envince_layout_style',
		array(
			'default'           => 'boxed',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'envince_sanitize_layout_style',
		)
	);

	/* Add 'layout style' control. */
	$wp_customize->add_control(
		'envince_layout_style',
		array(
			'label'   => esc_html__( 'Layout Style', 'envince' ),
			'section' => 'envince_layout',
			'type'    => 'select',
			'choices' => array(
				'wide'  => 'Wide Layout',
				'boxed' => 'Boxed Layout',
			),
		)
	);

	/* Add 'layout width' setting. */
	$wp_customize->add_setting(
		'envince_layout_width',
		array(
			'default'           => '1170',
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'envince_sanitize_layout_width',
		)
	);

	/* Add 'layout width' control. */
	$wp_customize->add_control(
		'envince_layout_width',
		array(
			'label'   => esc_html__( 'Layout Width', 'envince' ),
			'section' => 'envince_layout',
			'type'    => 'select',
			'choices' => array(
				'1600' => '1600px',
				'1170' => '1170px (Default)',
				'992'  => '992px',
				'768'  => '768px',
			),
		)
	);

	$wp_customize->add_setting(
		'envince_footer_widgets',
		array(
			'default'           => 4,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'envince_sanitize_integer',
		)
	);

	$wp_customize->add_control(
		'envince_footer_widgets',
		array(
			'label'   => esc_html__( 'Choose the number of widget area you want in footer', 'envince' ),
			'section' => 'envince_layout',
			'type'    => 'select',
			'choices' => array(
				'1' => esc_html__( '1 Footer Widget Area', 'envince' ),
				'2' => esc_html__( '2 Footer Widget Area', 'envince' ),
				'3' => esc_html__( '3 Footer Widget Area', 'envince' ),
				'4' => esc_html__( '4 Footer Widget Area', 'envince' ),
			),
		)
	);

	/* Add 'header_info' section */
	$wp_customize->add_section(
		'envince_header_info',
		array(
			'title'      => esc_html__( 'Header Info', 'envince' ),
			'priority'   => 60,
			'capability' => 'edit_theme_options',
		)
	);

	/* Add the 'phone info' setting. */
	$wp_customize->add_setting(
		'envince_phone_info',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'transport'         => $customizer_selective_refresh,
			'sanitize_callback' => 'envince_sanitize_integer',
		)
	);

	/* Add 'phone info' control. */
	$wp_customize->add_control(
		'envince_phone_info',
		array(
			'label'    => esc_html__( 'Phone Number', 'envince' ),
			'section'  => 'envince_header_info',
			'settings' => 'envince_phone_info',
		)
	);

	// Selective refresh for header phone number info
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'envince_phone_info', array(
			'selector'        => '.info-icons li.header-info-phone a',
			'render_callback' => 'envince_phone_info',
		) );
	}

	/* Add the 'email info' setting. */
	$wp_customize->add_setting(
		'envince_email_info',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'transport'         => $customizer_selective_refresh,
			'sanitize_callback' => 'sanitize_email',
		)
	);

	/* Add 'email info' control. */
	$wp_customize->add_control(
		'envince_email_info',
		array(
			'label'    => esc_html__( 'Email', 'envince' ),
			'section'  => 'envince_header_info',
			'settings' => 'envince_email_info',
		)
	);

	// Selective refresh for header email info
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'envince_email_info', array(
			'selector'        => '.info-icons li.header-info-email a',
			'render_callback' => 'envince_email_info',
		) );
	}

	/* Add the 'location info' setting. */
	$wp_customize->add_setting(
		'envince_location_info',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'transport'         => $customizer_selective_refresh,
			'sanitize_callback' => 'envince_sanitize_text',
		)
	);

	/* Add the upload control for the 'location info' setting. */
	$wp_customize->add_control(
		'envince_location_info',
		array(
			'label'    => esc_html__( 'Location', 'envince' ),
			'section'  => 'envince_header_info',
			'settings' => 'envince_location_info',
		)
	);

	// Selective refresh for header location info
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'envince_location_info', array(
			'selector'        => '.info-icons li.header-info-location',
			'render_callback' => 'envince_location_info',
		) );
	}

	/* Category Color Panel */
	$wp_customize->add_panel(
		'envince_category_color_panel',
		array(
			'priority'    => 200,
			'title'       => __( 'Category Color Options', 'envince' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Change the color of each category items as you want.', 'envince' ),
		)
	);

	$wp_customize->add_section(
		'envince_category_color_setting',
		array(
			'priority' => 10,
			'title'    => __( 'Category Color Settings', 'envince' ),
			'panel'    => 'envince_category_color_panel',
		)
	);

	$i    = 1;
	$args = array(
		'orderby'    => 'id',
		'hide_empty' => 0,
	);

	$categories       = get_categories( $args );
	$wp_category_list = array();
	foreach ( $categories as $category_list ) {
		$wp_category_list[ $category_list->cat_ID ] = $category_list->cat_name;

		$wp_customize->add_setting(
			'envince_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
			array(
				'default'              => '',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'envince_color_option_hex_sanitize',
				'sanitize_js_callback' => 'envince_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'envince_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
				array(
					'label'    => sprintf( __( '%s', 'envince' ), $wp_category_list[ $category_list->cat_ID ] ),
					'section'  => 'envince_category_color_setting',
					'settings' => 'envince_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
					'priority' => $i,
				)
			)
		);
		$i ++;
	}

	// related posts.
	$wp_customize->add_panel(
		'envince_Additional_panel',
		array(
			'priority'   => 200,
			'title'      => __( 'Additional Options', 'envince' ),
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_section( 'envince_related_posts_section', array(
		'priority' => 4,
		'title'    => esc_html__( 'Related Posts', 'envince' ),
		'panel'    => 'envince_Additional_panel',
	) );
	$wp_customize->add_setting( 'envince_related_posts_activate', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'envince_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'envince_related_posts_activate', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to activate the related posts', 'envince' ),
		'section'  => 'envince_related_posts_section',
		'settings' => 'envince_related_posts_activate',
	) );
	$wp_customize->add_setting( 'envince_related_posts', array(
		'default'           => 'categories',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'envince_sanitize_radio',
	) );
	$wp_customize->add_control( 'envince_related_posts', array(
		'type'     => 'radio',
		'label'    => esc_html__( 'Related Posts Must Be Shown As:', 'envince' ),
		'section'  => 'envince_related_posts_section',
		'settings' => 'envince_related_posts',
		'choices'  => array(
			'categories' => esc_html__( 'Related Posts By Categories', 'envince' ),
			'tags'       => esc_html__( 'Related Posts By Tags', 'envince' ),
		),
	) );

	/* Add 'miscellaneous settings' section */
	$wp_customize->add_section(
		'envince_miscellaneous',
		array(
			'title'      => esc_html__( 'Miscellaneous Settings', 'envince' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
		)
	);

	/* Add the 'featured image setting for single post/page' setting. */
	$wp_customize->add_setting(
		'estore_remove_featured_image',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'envince_sanitize_checkbox',
		)
	);

	/* Add 'remove featured image' control. */
	$wp_customize->add_control(
		'estore_remove_featured_image',
		array(
			'label'    => esc_html__( 'Remove Featured Image from Single Post', 'envince' ),
			'section'  => 'envince_miscellaneous',
			'settings' => 'estore_remove_featured_image',
			'type'     => 'checkbox',
		)
	);
} // customizer section end

/**
 * Sanitize Integer
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_integer( $int ) {
	if ( is_numeric( $int ) ) {
		return intval( $int );
	} else {
		return '';
	}
}

/**
 * Sanitize text
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_text( $txt ) {
	return wp_kses_post( force_balance_tags( $txt ) );
}

/**
 * Sanitize text
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitize layout sidebar radiobutton
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_layout_sidebar( $layout_sidebar ) {
	$valid = array(
		'full-width'              => 'full-width',
		'sidebar-content'         => 'sidebar-content',
		'content-sidebar'         => 'content-sidebar',
		'sidebar-sidebar-content' => 'sidebar-sidebar-content',
		'sidebar-content-sidebar' => 'sidebar-content-sidebar',
		'content-sidebar-sidebar' => 'content-sidebar-sidebar',
	);

	if ( array_key_exists( $layout_sidebar, $valid ) ) {
		return $layout_sidebar;
	} else {
		return '';
	}
}

/**
 * Sanitize layout style
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_layout_style( $layout_style ) {
	$valid = array(
		'wide'  => 'Wide Layout',
		'boxed' => 'Boxed Layout',
	);

	if ( array_key_exists( $layout_style, $valid ) ) {
		return $layout_style;
	} else {
		return '';
	}
}

/**
 * Sanitize layout width
 *
 * @since  1.0.1
 * @access public
 * @return sanitized output
 */
function envince_sanitize_layout_width( $layout_width ) {
	$valid = array(
		'1600' => '1600px',
		'1170' => '1170px (Default)',
		'992'  => '992px',
		'768'  => '768px',
	);

	if ( array_key_exists( $layout_width, $valid ) ) {
		return $layout_width;
	} else {
		return '';
	}
}

/**
 * Sanitize color option
 *
 * @since  1.0.1
 * @access public
 * @return sanitized color output
 */
function envince_color_option_hex_sanitize( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
		return '#' . $unhashed;
	}

	return $color;
}

/**
 * Escape sanitized color
 *
 * @since  1.0.1
 * @access public
 * @return escaped color output
 */
function envince_color_escaping_option_sanitize( $input ) {
	$input = esc_attr( $input );

	return $input;
}

/**
 * Loads theme customizer JavaScript.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function envince_enqueue_customizer_scripts() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'envince-customize',
		trailingslashit( get_template_directory_uri() ) . "js/customize.js",
		array( 'jquery' ),
		null,
		true
	);
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function envince_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function envince_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Header info
 */
// phone number
function envince_phone_info() {
	$phone_info = get_theme_mod( 'envince_phone_info' );
	echo $phone_info;
}

// email
function envince_email_info() {
	$email_info = get_theme_mod( 'envince_email_info' );
	$email      = sanitize_email( $email_info );
	echo $email;
}

// location
function envince_location_info() {
	$location_info = get_theme_mod( 'envince_location_info' );
	echo '<i class="fa fa-location-arrow"></i>' . $location_info;
}

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'envince_customizer_custom_scripts' );

function envince_customizer_custom_scripts() { ?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-envince_upsell_section h3.accordion-section-title {
			background-color: #2EBDFF !important;
			border-left-color: #1793cc !important;
		}

		#accordion-section-envince_upsell_section h3 a:after {
			content: '\f345';
			color: #fff;
			position: absolute;
			top: 12px;
			right: 10px;
			z-index: 1;
			font: 400 20px/1 dashicons;
			speak: none;
			display: block;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-decoration: none!important;
		}

		li#accordion-section-envince_upsell_section h3.accordion-section-title a {
			display: block;
			color: #fff !important;
			text-decoration: none;
		}

		li#accordion-section-envince_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-envince_upsell_section h3.accordion-section-title:hover {
			background-color: #35add2 !important;
		}
		/* Upsell button CSS */
		.themegrill-pro-info,
		.customize-control-envince-important-links a {
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
			background: #008EC2;
			color: #fff;
			display: block;
			margin: 15px 0 0;
			padding: 5px 0;
			text-align: center;
			font-weight: 600;
		}

		.customize-control-envince-important-links a {
			padding: 8px 0;
		}

		.themegrill-pro-info:hover,
		.customize-control-envince-important-links a:hover {
			color: #ffffff;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
			background: #2380BA;
		}
	</style>

	<script>
		( function ( $, api ) {
			api.sectionConstructor['envince-upsell-section'] = api.Section.extend( {

				// No events for this type of section.
				attachEvents : function () {
				},

				// Always make the section active.
				isContextuallyActive : function () {
					return true;
				}
			} );
		} )( jQuery, wp.customize );

	</script>
	<?php
}
