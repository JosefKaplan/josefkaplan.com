<?php
/**
 * Business Architect Customizer functionality
 */

if ( ! function_exists( 'business_architect_header_style' ) ) :
	/**
	 * Styles the header text displayed on the site.
	 *
	 * Create your own business_architect_header_style() function to override in a child theme.
	 *
	 * @see business_architect_custom_header_and_background().
	 */
	function business_architect_header_style() {
		// If the header text option is untouched, let's bail.
		if ( display_header_text() ) {
			return;
		}

		// If the header text has been hidden.
		?>
		<style type="text/css" id="business-architect-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
		</style>
		<?php
	}
endif; // business_architect_header_style

add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'wptrt-customize-section-button',
		get_theme_file_uri( 'js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'wptrt-customize-section-button',
		get_theme_file_uri( 'css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

/**
 * Adds postMessage support for site title and description for the Customizer.
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function business_architect_customize_register( $wp_customize ) {

/**
 * Customize Section Button Class.
 *
 * Adds a custom "button" section to the WordPress customizer.
 *
 * @author    WPTRT <themes@wordpress.org>
 * @copyright 2019 WPTRT
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/WPTRT/customize-section-button
 */

class business_architect_Button extends WP_Customize_Section {


	public $type = 'wptrt-button';
	public $button_text = '';
	public $button_url = '';
	public $priority = 0;

	public function json() {

		$json       = parent::json();
		$theme      = wp_get_theme();
		$button_url = $this->button_url;

		// Fall back to the `Theme URI` defined in `style.css`.
		if ( ! $this->button_url && $theme->get( 'ThemeURI' ) ) {

			$button_url = $theme->get( 'ThemeURI' );

		// Fall back to the `Author URI` defined in `style.css`.
		} elseif ( ! $this->button_url && $theme->get( 'AuthorURI' ) ) {

			$button_url = $theme->get( 'AuthorURI' );
		}

		$json['button_text'] = $this->button_text ? $this->button_text : $theme->get( 'Name' );
		$json['button_url']  = esc_url( $button_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.button_text && data.button_url ) { #>
					<a href="{{ data.button_url }}" class="button button-secondary alignright" target="_blank" rel="external nofollow noopener noreferrer">{{ data.button_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

	$wp_customize->register_section_type( business_architect_Button::class );
	 
	$wp_customize->add_section(
		new business_architect_Button( $wp_customize, 'business-architect', [
			'title'       => __( 'Premium Features', 'business-architect' ),
			'button_text' => __( 'Learn More', 'business-architect' ),
			'button_url'  => business_architect_theme_uri(),
		] )
	);


	/* theme settings */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'business_architect_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'business_architect_customize_partial_blogdescription',
			)
		);
	}
	
	//label
	$wp_customize->add_setting('header_image_label' , array(
		'default'    => __("If you add background image, change header text color from Theme Options > Header section.","business-architect"),
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control( new business_architect_Label( 
	$wp_customize, 
	'header_image_label', 
		array(
			'section' => 'header_image',
			'settings' => 'header_image_label',
			'priority' => 8,
		) 
	));
	
	/***************** 
	 * Theme options *
	 ****************/

	$wp_customize->add_panel( 'theme_options' , array(
		'title'      => __( 'Theme Options', 'business-architect' ),
		'priority'   => 1,
	) );
	
	// header and footer
	$wp_customize->add_section( 'theme_header' , array(
		'description' => __( 'Add header social menu :- create a menu with social links and set menu as social.', 'business-architect' ),
		'title'      => __( 'Theme Header', 'business-architect' ),
		'priority'   => 1,
		'panel' => 'theme_options',
	) );
	
	
	//header shortcode
	$wp_customize->add_setting('header_shortcode' , array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	

	$wp_customize->add_control('header_shortcode' , array(
		'label' => __('Add Header Shortcode[Booking etc:]', 'business-architect' ),
		'section' => 'theme_header',
		'type'=> 'text',
	) );	
		

	//add settings page
	require get_template_directory() . '/inc/slider-options.php';	
	
		
	//hero content 
	/*
	$wp_customize->add_section( 'hero_section' , array(
		'title'      => __( 'Hero Content', 'business-architect' ),
		'priority'   => 2,
		'panel' => 'theme_options',
	) );
	*/
	
	
	//labe2
	$wp_customize->add_setting('header_image_label2' , array(
		'default'    => __("You can change header text color from Theme Options > Header section.","business-architect"),
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control( new business_architect_Label( 
	$wp_customize, 
	'header_image_label2', 
		array(
			'section' => 'hero_section',
			'settings' => 'header_image_label2',
			'priority' => 8,
		) 
	));
	
	//0
	$wp_customize->add_setting('hero_border' , array(
		'default'    => 0,
		'sanitize_callback' => 'absint',
	));
	
	$wp_customize->add_control('hero_border' , array(
		'label' => __('Top Border (px)', 'business-architect' ),
		'section' => 'hero_section',
		'type'=> 'number',
	) );	
	
	//hero section
	$wp_customize->add_setting('hero_title' , array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control('hero_title' , array(
		'label' => __('Title', 'business-architect' ),
		'section' => 'hero_section',
		'type'=> 'text',
	) );
	
	//
	$wp_customize->add_setting('hero_description' , array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control('hero_description' , array(
		'label' => __('Hero Description', 'business-architect' ),
		'section' => 'hero_section',
		'type'=> 'text',
	) );
	
	//3
	$wp_customize->add_setting('hero_button' , array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control('hero_button' , array(
		'label' => __('Button Text', 'business-architect' ),
		'section' => 'hero_section',
		'type'=> 'text',
	) );	
	
		
	//4
	$wp_customize->add_setting('hero_link' , array(
		'default'    => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	
	$wp_customize->add_control('hero_link' , array(
		'label' => __('Button Link', 'business-architect' ),
		'section' => 'hero_section',
		'type'=> 'url',
	) );	

	// Add page background color setting and control.
	$wp_customize->add_setting(
		'page_background_color',
		array(
			'default'           => business_architect_default_settings('page_background_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'page_background_color',
			array(
				'label'   => __( 'Page Background Color', 'business-architect' ),
				'section' => 'colors',
			)
		)
	);


	// Add link color setting and control.
	$wp_customize->add_setting(
		'link_color',
		array(
			'default'           => business_architect_default_settings('link_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'   => __( 'Link Color', 'business-architect' ),
				'section' => 'colors',
			)
		)
	);

	// Add main text color setting and control.
	$wp_customize->add_setting(
		'main_text_color',
		array(
			'default'           => business_architect_default_settings('main_text_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_text_color',
			array(
				'label'   => __( 'Main Text Color', 'business-architect' ),
				'section' => 'colors',
			)
		)
	);
	
	// header layout
	
	$wp_customize->add_setting( 'header_layout' , array(
		'default'    => business_architect_default_settings('header_layout'),
		'sanitize_callback' => 'business_architect_sanitize_select',
	));

	$wp_customize->add_control('header_layout' , array(
		'label' => __('Select Header Layout', 'business-architect' ),
		'section' => 'theme_header',
		'type' => 'select',
		'choices' => array(
			'0' => __('Default', 'business-architect' ),
			'1' => __('Header Search [Require WooCommerce]', 'business-architect' ),
			'2' => __('Burger [List]', 'business-architect' ),
		),
	) );		
	
	// woo menubar background
 
		$wp_customize->add_setting(
			'woocommerce_menubar_color',
			array(
				'default'     => '#fff',
				'type'        => 'theme_mod',			
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		
	
	// woo menubar bg color
	$wp_customize->add_setting(
		'woocommerce_menubar_color',
		array(
			'default'           => business_architect_default_settings('woocommerce_menubar_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'woocommerce_menubar_color',
			array(
				'label'   => __( 'Menubar Background [Product Search & List Layout]', 'business-architect' ),
				'section' => 'theme_header',
			)
		)
	);	
	
	// woo menubar text color
	$wp_customize->add_setting(
		'woocommerce_menubar_text_color',
		array(
			'default'           => business_architect_default_settings('woocommerce_menubar_text_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'woocommerce_menubar_text_color',
			array(
				'label'   => __( 'Menu Color [Product Search & List Layout]', 'business-architect' ),
				'section' => 'theme_header',
			)
		)
	);
	

	// Add header text color setting and control.
	$wp_customize->add_setting(
		'header_text_color',
		array(
			'default'           => business_architect_default_settings('header_text_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color',
			array(
				'label'   => __( 'Headet Text Color', 'business-architect' ),
				'section' => 'theme_header',
			)
		)
	);
	
	// Header text colour
	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'           => business_architect_default_settings('header_bg_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bg_color',
			array(
				'label'   => __( 'Header Background Color', 'business-architect' ),
				'section' => 'theme_header',
			)
		)
	);
	
	//header tel
	$wp_customize->add_setting('header_telephone' , array(
		'default'    => '1-000-123-4567',
		'sanitize_callback' => 'business_architect_sanitize_phone_number',
	));
	
	

	$wp_customize->add_control('header_telephone' , array(
		'label' => __('Tel', 'business-architect' ),
		'section' => 'theme_header',
		'type'=> 'text',
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'header_telephone', array(
		'selector' => '.contact-info',
	) );
	
	//header email
	$wp_customize->add_setting('header_email' , array(
		'default'    => 'edit@mailserver.com',
		'sanitize_callback' => 'sanitize_email',
	));

	$wp_customize->add_control('header_email' , array(
		'label' => __('Email', 'business-architect' ),
		'section' => 'theme_header',
		'type'=> 'text',
	) );
			
	//header address
	$wp_customize->add_setting('header_address' , array(
		'default'    => __('Street, City', 'business-architect'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('header_address' , array(
		'label' => __('Address', 'business-architect' ),
		'section' => 'theme_header',
		'type'=> 'text',
	) );
	
	
	// header contacts, social bg color
	$wp_customize->add_setting(
		'header_contact_social_bg_color',
		array(
			'default'           => business_architect_default_settings('header_contact_social_bg_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_contact_social_bg_color',
			array(
				'label'   => __( 'Header Contact Background Color', 'business-architect' ),
				'section' => 'theme_header',
			)
		)
	);	
	
	
	// 5 Typography
	
	$font_choices = array(
			'Source Sans Pro' => 'Source Sans Pro',
			'Google Sans' => 'Google Sans',
			'Open Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Montserrat' => 'Montserrat',
			'Raleway' => 'Raleway',
			'Droid Sans' => 'Droid Sans',
			'Lora' => 'Lora',
			'Oxygen' => 'Oxygen',
			'PT Sans' => 'PT Sans',
			'Arimo' => 'Arimo',
			'Roboto' => 'Roboto',
			'Open Sans' => 'Open Sans Condensed',
		);

	$wp_customize->add_section( 'typography_section' , array(
		'title'      => __('Typography', 'business-architect' ),			 
		'description'=> __('Change default fonts. Unlimited google fonts, go premium version.', 'business-architect' ),
		'panel' => 'theme_options',
	));


	$wp_customize->add_setting( 'heading_font' , array(
		'default'    => business_architect_default_settings('heading_font'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('heading_font' , array(
		'label' => __('H1, H2, H3 ... H6 Fonts', 'business-architect' ),
		'section' => 'typography_section',
		'type' => 'select',
		'choices' => $font_choices,
	) );
	
	
	$wp_customize->add_setting( 'body_font' , array(
		'default'    => business_architect_default_settings('body_font'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('body_font' , array(
		'label' => __('Content Font', 'business-architect' ),
		'section' => 'typography_section',
		'type' => 'select',
		'choices' => $font_choices,
	));	
	

	
	// 5 layout section 

	$wp_customize->add_section( 'layout_section' , array(
		'title'      => __('Layout', 'business-architect' ),			 
		'description'=> __('Chanege site layout to fluid / box mode', 'business-architect' ),
		'panel' => 'theme_options',
	));
 
	$wp_customize->add_setting( 'box_layout_mode' , array(
		'default'    => false,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'business_architect_sanitize_checkbox',
	));

	$wp_customize->add_control('box_layout_mode' , array(
		'label' => __('Enable | Disable Site Box Layout','business-architect' ),
		'section' => 'layout_section',
		'type'=> 'checkbox',
	));
	
	// sidebar position
	$wp_customize->add_setting( 'woo_sidebar_position' , array(
		'default'    => 'left',
		'sanitize_callback' => 'business_architect_sanitize_select',
	));

	$wp_customize->add_control('woo_sidebar_position' , array(
		'label' => __('WooCommerce Sidebar position', 'business-architect' ),
		'section' => 'layout_section',
		'type' => 'select',
		'choices' => array(
			'right' => __('Right', 'business-architect' ),
			'left' => __('Left', 'business-architect' ),
			'none' => __('No Sidebar', 'business-architect' ),
		),
	) );
	
	

	
	// 7 footer section
	$wp_customize->add_section( 'theme_footer' , array(
		'title'      => __( 'Theme Footer', 'business-architect' ),
		'panel' => 'theme_options',
	) );	
		
	// Add footer color setting and control.
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => business_architect_default_settings('footer_text_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'   => __( 'Footer Text Color', 'business-architect' ),
				'section' => 'theme_footer',
			)
		)
	);
	

	$wp_customize->add_setting('footer_border' , array(
		'default'    => business_architect_default_settings('footer_border'),
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('footer_border' , array(
		'label' => __('Footer Border Width', 'business-architect' ),
		'section' => 'theme_footer',
		'type'=> 'number',
	) );	
	
	
	// Add footer background color setting and control.
	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => business_architect_default_settings('footer_bg_color'),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label'   => __( 'Footer Background Color', 'business-architect' ),
				'section' => 'theme_footer',
			)
		)
	);
	
	
	// footer copyright text
	$wp_customize->add_setting( 'footer_text' , array(
		'default'    => __("A theme by Theme Space", 'business-architect'),
		'sanitize_callback' => 'sanitize_textarea_field',
	));	
	
	$wp_customize->add_control('footer_text' , array(
		'label' => __('Footer Bottom Text', 'business-architect'),
		'section' => 'theme_footer',
		'type'=>'textarea',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'footer_text', array(
		'selector' => '.site-info',
	) );
	
	
	
//end of settings
	
}
add_action( 'customize_register', 'business_architect_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 */
function business_architect_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Business Architect 1.2
 * @see business_architect_customize_register()
 *
 * @return void
 */
function business_architect_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueues front-end CSS for color scheme.
 * @see wp_add_inline_style()
 */
function business_architect_color_scheme_css() {

	$scheme_css = business_architect_get_theme_css();

	wp_add_inline_style( 'business-architect-style', $scheme_css );
}
add_action( 'wp_enqueue_scripts', 'business_architect_color_scheme_css' );


/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 *
 */
function business_architect_customize_preview_js() {
	wp_enqueue_script( 'business-architect-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'business_architect_customize_preview_js' );

/**
 * Theme options
 */

require get_template_directory() . '/inc/styles.php';

/*
 * Get product categories
 */

$business_architect_product_categories = business_architect_get_product_categories();

function business_architect_get_product_categories(){

	$args = array(
			'taxonomy' => 'product_cat',
			'orderby' => 'date',
			'order' => 'ASC',
			'show_count' => 1,
			'pad_counts' => 0,
			'hierarchical' => 0,
			'title_li' => '',
			'hide_empty' => 1,
	);

	$categories = get_categories($args);

	$arr = array();
	$arr['0'] = esc_html__('-Select Category-', 'business-architect') ;
	foreach($categories as $category){
		$arr[$category->term_id] = $category->name;
	}
	return $arr;
}


/* 
 * check valid font has been selected 
 */
function business_architect_sanitize_font_family( $value ) {
    if ( array_key_exists($value, business_architect_font_family()) )  {   
    	return $value;
	} else {
		return "Google Sans, Sans Serif";
	}
}

function business_architect_font_family(){

	$google_fonts = array(  "Google Sans" => "Google Sans",
							"Open sans" => "Open sans",
							"Oswald" => "Oswald",
							"Lora" => "Lora",
							"Raleway" => "Raleway",
						);
						
	return ($google_fonts);
}


if( class_exists( 'WP_Customize_Control' ) ):
	class business_architect_Customize_Help_Control extends WP_Customize_Control {

		public function render_content() {
		?>
			<label>
				<span class="customize-control-title custom-help-control"><?php echo esc_html( $this->label ); ?></span>
			</label>
		<?php
		}
	}
endif;


function business_architect_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}


/* Label custom control */
if( class_exists( 'WP_Customize_Control' ) ):
class business_architect_Label extends WP_Customize_Control {
  /**
  * Render the control's content.
  */
  public function render_content() {
  ?>
	<div class="container"><div class="placeholder"></div></div>
	<label><span class="customize-control-title" style="border: 1px solid #119926;padding: 5px;"><strong><?php echo esc_html( $this->value() ); ?></strong></span></label>
  <?php
  }
}
endif;


