<?php
/**
 *
 * Wortex Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2014-2020 Iceable Themes - https://www.iceablethemes.com
 *
 * Customizer functions
 *
 */

class Wortex_Customizer {

	public static function register( $wp_customize ) {

		// Move default settings "background_color" in the same section as background image settings
		// and rename the section just "Background"
		$wp_customize->get_control( 'background_color' )->section = 'background_image';
		$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'wortex-lite' );

		// Add new sections
		$wp_customize->add_section(
			'wortex_layout',
			array(
				'title'    => __( 'Main Layout', 'wortex-lite' ),
				'priority' => 10,
			)
		);

		$wp_customize->add_section(
			'wortex_logo_settings',
			array(
				'title'    => __( 'Logo', 'wortex-lite' ),
				'priority' => 20,
			)
		);

		$wp_customize->add_section(
			'wortex_blog_settings',
			array(
				'title'    => __( 'Blog Settings', 'wortex-lite' ),
				'priority' => 80,
			)
		);

		$wp_customize->add_section(
			'wortex_misc_settings',
			array(
				'title'    => __( 'Misc', 'wortex-lite' ),
				'priority' => 100,
			)
		);

		$wp_customize->add_section(
			'wortex_more',
			array(
				'title'    => __( 'More', 'wortex-lite' ),
				'priority' => 130,
			)
		);

		// Setting and control for main layout
		$wp_customize->add_setting( 'wortex_layout',
			array(
				'default'           => 'boxed',
				'sanitize_callback' => 'wortex_sanitize_layout',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wortex_layout',
				array(
					'label'    => __( 'Blog Index Content', 'wortex-lite' ),
					'section'  => 'wortex_layout',
					'settings' => 'wortex_layout',
					'type'     => 'radio',
					'choices'  => array(
						'wide'  => __( 'Wide', 'wortex-lite' ),
						'boxed' => __( 'Boxed', 'wortex-lite' ),
					),
				)
			)
		);

		// Setting and control for Logo
		$wp_customize->add_setting(
			'wortex_logo',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'wortex_logo',
				array(
					'label'       => __( 'Upload your logo', 'wortex-lite' ),
					'description' => __( 'If no logo is uploaded, the site title will be displayed instead.', 'wortex-lite' ),
					'section'     => 'wortex_logo_settings',
					'settings'    => 'wortex_logo',
				)
			)
		);

		// Setting and control for blog index content switch
		$wp_customize->add_setting(
			'wortex_blog_index_content',
			array(
				'default'           => 'excerpt',
				'sanitize_callback' => 'wortex_sanitize_blog_index_content',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wortex_blog_index_content',
				array(
					'label'    => __( 'Blog Index Content', 'wortex-lite' ),
					'section'  => 'wortex_blog_settings',
					'settings' => 'wortex_blog_index_content',
					'type'     => 'radio',
					'choices'  => array(
						'excerpt' => __( 'Excerpt', 'wortex-lite' ),
						'content' => __( 'Full content', 'wortex-lite' ),
					),
				)
			)
		);

		// Setting and control for responsive mode
		$wp_customize->add_setting(
			'wortex_responsive_mode',
			array(
				'default'           => 'on',
				'sanitize_callback' => 'wortex_sanitize_on_off',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wortex_responsive_mode',
				array(
					'label'    => __( 'Responsive Mode', 'wortex-lite' ),
					'section'  => 'wortex_misc_settings',
					'settings' => 'wortex_responsive_mode',
					'type'     => 'radio',
					'choices'  => array(
						'on'  => __( 'On', 'wortex-lite' ),
						'off' => __( 'Off', 'wortex-lite' ),
					),
				)
			)
		);

		// Settings and controls for header image display
		$wp_customize->add_setting(
			'home_header_image',
			array(
				'default'           => 'on',
				'sanitize_callback' => 'wortex_sanitize_on_off',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'home_header_image',
				array(
					'label'    => __( 'Display header on Homepage', 'wortex-lite' ),
					'section'  => 'header_image',
					'settings' => 'home_header_image',
					'type'     => 'radio',
					'choices'  => array(
						'on'  => __( 'On', 'wortex-lite' ),
						'off' => __( 'Off', 'wortex-lite' ),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'blog_header_image',
			array(
				'default'           => 'on',
				'sanitize_callback' => 'wortex_sanitize_on_off',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'blog_header_image',
				array(
					'label'    => __( 'Display header on Blog Index', 'wortex-lite' ),
					'section'  => 'header_image',
					'settings' => 'blog_header_image',
					'type'     => 'radio',
					'choices'  => array(
						'on'  => __( 'On', 'wortex-lite' ),
						'off' => __( 'Off', 'wortex-lite' ),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'single_header_image',
			array(
				'default'           => 'on',
				'sanitize_callback' => 'wortex_sanitize_on_off',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'single_header_image',
				array(
					'label'    => __( 'Display header on Single Posts', 'wortex-lite' ),
					'section'  => 'header_image',
					'settings' => 'single_header_image',
					'type'     => 'radio',
					'choices' => array(
						'on'  => __( 'On', 'wortex-lite' ),
						'off' => __( 'Off', 'wortex-lite' ),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'pages_header_image',
			array(
				'default'           => 'on',
				'sanitize_callback' => 'wortex_sanitize_on_off',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pages_header_image',
				array(
					'label'    => __( 'Display header on Pages', 'wortex-lite' ),
					'section'  => 'header_image',
					'settings' => 'pages_header_image',
					'type'     => 'radio',
					'choices'  => array(
						'on'  => __( 'On', 'wortex-lite' ),
						'off' => __( 'Off', 'wortex-lite' ),
					),
				)
			)
		);

		// Setting and control for Wortex upgrade message
		$wp_customize->add_setting(
			'wortex_upgrade',
			array(
				'default'           => 'https://www.iceablethemes.com/shop/wortex-pro/',
				'sanitize_callback' => 'wortex_sanitize_button',
			)
		);

		$wp_customize->add_control(
			new Wortex_Button_Customize_Control(
				$wp_customize,
				'wortex_upgrade',
				array(
					'label'       => __( 'Get Wortex Pro', 'wortex-lite' ),
					'description' => __( 'Unleash the full potential of Wortex with tons of additional settings, advanced features and premium support.', 'wortex-lite' ),
					'section'     => 'wortex_more',
					'settings'    => 'wortex_upgrade',
					'type'        => 'button',
				)
			)
		);

		// Setting and control for Wortex support forums message
		$wp_customize->add_setting(
			'wortex_support',
			array(
				'default'           => 'https://www.iceablethemes.com/forums/forum/free-support-forum/wortex-lite/',
				'sanitize_callback' => 'wortex_sanitize_button',
			)
		);

		$wp_customize->add_control(
			new Wortex_Button_Customize_Control(
				$wp_customize,
				'wortex_support',
				array(
					'label'       => __( 'Wortex Lite support forums', 'wortex-lite' ),
					'description' => __( 'Have a question? Need help?', 'wortex-lite' ),
					'section'     => 'wortex_more',
					'settings'    => 'wortex_support',
					'type'        => 'button',
				)
			)
		);

		// Setting and control for Wortex feedback message
		$wp_customize->add_setting(
			'wortex_feedback',
			array(
				'default'           => 'https://wordpress.org/support/view/theme-reviews/wortex-lite',
				'sanitize_callback' => 'wortex_sanitize_button',
			)
		);

		$wp_customize->add_control(
			new Wortex_Button_Customize_Control(
				$wp_customize,
				'wortex_feedback',
				array(
					'label'       => __( 'Rate Wortex Lite', 'wortex-lite' ),
					'description' => __( 'Like this theme? We\'d love to hear your feedback!', 'wortex-lite' ),
					'section'     => 'wortex_more',
					'settings'    => 'wortex_feedback',
					'type'        => 'button',
				)
			)
		);

	}

	public static function customize_controls_scripts() {
		wp_enqueue_style(
			'wortex-customizer-controls-style',
			WORTEX_THEME_DIR_URI . '/inc/customizer/css/customizer-controls.css',
			array( 'customize-controls' )
		);

		wp_register_script(
			'wortex-customizer-section',
			WORTEX_THEME_DIR_URI . '/inc/customizer/js/wortex-customizer-section.js',
			array( 'jquery', 'jquery-ui-core', 'jquery-ui-button', 'customize-controls' ),
			'',
			true
		);

		$wortex_customizer_section_l10n = array(
			'upgrade_pro' => __( 'Upgrade to Wortex Pro!', 'wortex-lite' ),
		);
		wp_localize_script( 'wortex-customizer-section', 'wortex_customizer_section_l10n', $wortex_customizer_section_l10n );
		wp_enqueue_script( 'wortex-customizer-section' );

	}

}
add_action( 'customize_register', array( 'Wortex_Customizer', 'register' ) );
add_action( 'customize_controls_enqueue_scripts', array( 'Wortex_Customizer', 'customize_controls_scripts' ) );

// Create custom controls for customizer
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Wortex_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'button';
		public function render_content() {
			?>
			<label>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<a class="button" href="<?php echo esc_url( $this->value() ); ?>" target="_blank"><?php echo esc_html( $this->label ); ?></a>
			</label>
			<?php
		}
	}
}

// Sanitation callback functions
function wortex_sanitize_layout( $input ) {
	$choices = array( 'boxed', 'wide' );
	if ( in_array( $input, $choices, true ) ) :
		return $input;
	else :
		return '';
	endif;
}

function wortex_sanitize_blog_index_content( $input ) {
	$choices = array( 'excerpt', 'content' );
	if ( in_array( $input, $choices, true ) ) :
		return $input;
	else :
		return '';
	endif;
}

function wortex_sanitize_on_off( $input ) {
	$choices = array( 'on', 'off' );
	if ( in_array( $input, $choices, true ) ) :
		return $input;
	else :
		return '';
	endif;
}

function wortex_sanitize_button( $input ) {
	return '';
}
