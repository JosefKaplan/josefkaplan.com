<?php
/**
 * scrollme Theme Customizer
 *
 * @package scrollme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function scrollme_customize_register( $wp_customize ) {

	/**
	 * Adds Category dropdown support to theme customizer
	 */
	class Scrollme_Category_Dropdown_Control extends WP_Customize_Control {
		private $cats = false;

		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			$this->cats = get_categories( $options );
			parent::__construct( $manager, $id, $args );
		}

		public function render_content() {
			if( !empty( $this->cats ) ) {

?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?>>
						<option value="0">&mdash;Select&mdash;</option>
					<?php
					foreach( $this->cats as $cat ) {
						printf( '<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected( $this->value(), esc_attr($cat->term_id), false) , esc_attr($cat->name) );
					}

					?>
					</select>
				</label>
				<?php
			}

		}

	} // end of class

	/**
	 * Adds info content
	 */
	class Scrollme_Customize_Info_Control extends WP_Customize_Control {

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<p><?php echo esc_html( $this->value() ); ?></p>
			</label>
		<?php
		}
	}


	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Moving some WordPress default section to 'General Settings' Panel **/
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'static_front_page' );

    /*------------------------------------------------------------------------------------*/
	/**
	 * Upgrade to Scrollme Pro
	*/
	// Register custom section types.
	$wp_customize->register_section_type( 'Scrollme_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
	    new Scrollme_Customize_Section_Pro(
	        $wp_customize,
	        'scrollme-pro',
	        array(
	            'title1'    => esc_html__( 'Free Vs Pro', 'scrollme' ),
	            'pro_text1' => esc_html__( 'Compare','scrollme' ),
	            'pro_url1'  => admin_url( 'themes.php?page=welcome-page&section=free_vs_pro'),
	            'priority' => 1,
	        )
	    )
	);
	$wp_customize->add_setting(
		'scrollme_pro_upbuton',
		array(
			'section' => 'scrollme-pro',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'scrollme_pro_upbuton',
		array(
			'section' => 'scrollme-pro'
		)
	);
    
    $wp_customize->add_section(
        'title_tagline',
        array(
            'title'=>__('Site Identity', 'scrollme'), 'panel' => 'scrollme_panel_general_settings'
        )
    );
    
    $wp_customize->add_section(
        'colors',
        array(
            'title'=>__('Colors', 'scrollme'), 'panel' => 'scrollme_panel_general_settings'
        )
    );
    
    $wp_customize->add_section(
        'static_front_page',
        array(
            'title'=>__('Static Front Page', 'scrollme'), 'panel' => 'scrollme_panel_general_settings'
        )
    );
    
    /** Dynamic Color Option **/
    $wp_customize->add_setting( 'scrollme_tpl_color', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#df2c45' ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'scrollme_tpl_color', array(
    		'label'      => esc_html__( 'Template Color', 'scrollme' ),
            'description' => esc_html__( 'Set te template color for the site', 'scrollme' ),
    		'section'    => 'colors',
    		'settings'   => 'scrollme_tpl_color',
    ) ) );
    
    /** Necesary Variables **/
    $pr_layout = array(
        'services' => __('Service', 'scrollme'),
        'portfolio' => __('Portfolio', 'scrollme'),
        'clients' => __('Clients', 'scrollme'),
        'contact' => __('Contact', 'scrollme'),
        'blog' => __('Blog', 'scrollme'),
    );

	// Logo & Favicon
	$wp_customize->add_section(
		'scrollme_log_favicon',
		array(
			'title' => __( 'Site Logo', 'scrollme' ),
            'panel' => 'scrollme_panel_general_settings'
		)
	);

	//Home Logo
	$wp_customize->add_setting(
		'scrollme_home_logo',
		array(
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'scrollme_home_logo',array(
				'label' => __( 'Home Page Logo', 'scrollme' ),
				'section' => 'scrollme_log_favicon',
				'settings' => 'scrollme_home_logo',
				'priority' => 1,
				'description' => 'Shows on the home page above slider'
			)
		)
	);

	// Header Logo
	$wp_customize->add_setting(
		'scrollme_logo',
		array(
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scrollme_logo', array(
				'label' => __( 'Header Logo', 'scrollme' ),
				'section' => 'scrollme_log_favicon',
				'settings' => 'scrollme_logo',
				'priority' => 5,
				'description' => 'Shows on the header'
			)

		)

	);

	// General Settings
	$wp_customize->add_panel(
		'scrollme_panel_general_settings',
		array(
			'title' => __( 'General Settings', 'scrollme' ),
			'priority' => 30
		)
	);

	// General Section
	$wp_customize->add_section(
		'scrollme_section_preloader',
		array(
			'title' => __( 'Preloader', 'scrollme' ),
			'priority' => 10,
			'panel' => 'scrollme_panel_general_settings'
		)
	);

	// Preloader
	$wp_customize->add_setting(
		'scrollme_preloader',
		array(
			'sanitize_callback' => 'scrollme_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'scrollme_preloader',
		array(
			'type' => 'checkbox',
			'label' => __( 'Disable Preloader', 'scrollme' ),
			'section' => 'scrollme_section_preloader',
			'settings' => 'scrollme_preloader',
			'priority' => 1
		)
	);

	$wp_customize->add_setting(
		'scrollme_blog_page',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'scrollme_sanitize_integer'

		)
	);

	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize, 'scrollme_blog_page', array(
				'label' => __( 'Choose Category for Blog', 'scrollme' ),
				'section' => 'scrollme_section_general_settings',
				'settings' => 'scrollme_blog_page'
			)

		)
	);

	$wp_customize->add_setting(
		'scrollme_blog_page',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'scrollme_sanitize_integer'

		)
	);

	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize, 'scrollme_blog_page', array(
				'label' => __( 'Choose Category for Blog', 'scrollme' ),
				'section' => 'scrollme_section_general_settings',
				'settings' => 'scrollme_blog_page'
			)

		)
	);

	$wp_customize->add_panel(
		'scrollme_panel_scroll_page_sections',
		array(
			'title' => __( 'Horizontal Scroll Page Sections', 'scrollme' ),
			'priority' => 40
		)
	);

	// Scroll Section Home
	$wp_customize->add_section(
		'scrollme_section_section_home',
		array(
			'title' => __('Scroll Section - Slider', 'scrollme' ),
			'priority' => 5,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);


	// Home ID for Navigation
	$wp_customize->add_setting(
		'scrollme_section_home',
		array(
			'default' => 'home',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'scrollme_sanitize_text'
		)
	);

	$wp_customize->add_control( new Scrollme_Customize_Info_Control( $wp_customize, 'scrollme_section_home', array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'section' => 'scrollme_section_section_home',
			'settings' => 'scrollme_section_home',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
			)
		)
	);

	$wp_customize->add_setting(
		'scrollme_slider_category',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'

		)
	);

	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize, 'scrollme_slider_category', array(
				'label' => __( 'Choose Category for Slider', 'scrollme' ),
				'section' => 'scrollme_section_section_home',
				'settings' => 'scrollme_slider_category'
			)

		)
	);

	// Slider Pause
	$wp_customize->add_setting( 'scrollme_slider_pause',array( 'default' => '4000', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_sanitize_integer'));
	$wp_customize->add_control(
		'scrollme_slider_pause',
		array(
			'label'	=> __( 'Slider Pause Duration', 'scrollme' ),
			'type' => 'text',
			'settings' => 'scrollme_slider_pause',
			'section' => 'scrollme_section_section_home'
		)
	);

	// Slider Caption
	$wp_customize->add_setting( 'scrollme_slider_caption', array( 'default' => 'yes', 'sanitize_callback' => 'scrollme_sanitize_slider_settings'));
	$wp_customize->add_control(
		'scrollme_slider_caption',
		array(
			'label' => __( 'Show Slider Caption', 'scrollme' ),
			'type' => 'radio',
			'settings' => 'scrollme_slider_caption',
			'section' => 'scrollme_section_section_home',
			'priority' => 20,
			'choices' => array(
				'yes' => __( 'Yes', 'scrollme' ),
				'no' => __( 'No', 'scrollme' )
			)
		)
	);

	// Display Caption in Mobile Devices
	$wp_customize->add_setting( 'scrollme_disp_caption_in_mobile', array( 'default' => 0, 'sanitize_callback' => 'absint'));
	$wp_customize->add_control(
		'scrollme_disp_caption_in_mobile',
		array(
			'label' => __( 'Display Caption Description Text in Mobile', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_section_section_home',
			'priority' => 21,
		)
	);

	// Section 1
	$wp_customize->add_section(
		'scrollme_sec_1',
		array(
			'title' => __('Scroll Section 1', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_1_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_1_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_1',
			'settings' => 'scrollme_section_1_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_1', array( 'default' => 'section-1', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'scrollme_section_1',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_1',
			'settings' => 'scrollme_section_1',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
		)
	);

    $wp_customize->add_setting( 'scrollme_section_1_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_1_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_1',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_1', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_1',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_1',
			'settings' => 'scrollme_section_page_1',
            'active_callback' => 'scrollme_section1_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout1', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout1',
		array(
			'label'	=> __( 'Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_1',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section1_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	// Section 2
	$wp_customize->add_section(
		'scrollme_sec_2',
		array(
			'title' => __('Scroll Section 2', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_2_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_2_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_2',
			'settings' => 'scrollme_section_2_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_2', array( 'default' => 'section-2', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'scrollme_section_2',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_2',
			'settings' => 'scrollme_section_2',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_2_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_2_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_2',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_2', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_2',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_2',
			'settings' => 'scrollme_section_page_2',
            'active_callback' => 'scrollme_section2_pg_layout'
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout2', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout2',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_2',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section2_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	// Section 3
	$wp_customize->add_section(
		'scrollme_sec_3',
		array(
			'title' => __('Scroll Section 3', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_3_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_3_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_3',
			'settings' => 'scrollme_section_3_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_3', array( 'default' => 'section-3', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'scrollme_section_3',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_3',
			'settings' => 'scrollme_section_3',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_3_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_3_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_3',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_3', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_3',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_3',
			'settings' => 'scrollme_section_page_3',
            'active_callback' => 'scrollme_section3_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout3', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout3',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_3',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section3_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	// Section 4
	$wp_customize->add_section(
		'scrollme_sec_4',
		array(
			'title' => __('Scroll Section 4', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_4_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_4_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_4',
			'settings' => 'scrollme_section_4_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_4', array( 'default' => 'section-4', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title' ));
	$wp_customize->add_control(
		'scrollme_section_4',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_4',
			'settings' => 'scrollme_section_4',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_4_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_4_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_4',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_4', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_4',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_4',
			'settings' => 'scrollme_section_page_4',
            'active_callback' => 'scrollme_section4_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout4', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout4',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_4',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section4_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	// Section 5
	$wp_customize->add_section(
		'scrollme_sec_5',
		array(
			'title' => __('Scroll Section 5', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_5_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_5_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_5',
			'settings' => 'scrollme_section_5_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_5', array( 'default' => 'section-5', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'scrollme_section_5',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_5',
			'settings' => 'scrollme_section_5',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu'))
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_5_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_5_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_5',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_5', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_5',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_5',
			'settings' => 'scrollme_section_page_5',
            'active_callback' => 'scrollme_section5_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout5', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout5',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_5',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section5_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	// Section 6
	$wp_customize->add_section(
		'scrollme_sec_6',
		array(
			'title' => __('Scroll Section 6', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_6_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_6_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_6',
			'settings' => 'scrollme_section_6_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_6', array( 'default' => 'section-6', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title' ));
	$wp_customize->add_control(
		'scrollme_section_6',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_6',
			'settings' => 'scrollme_section_6',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu') )
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_6_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_6_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_6',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),           
			'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_6', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_6',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_6',
			'settings' => 'scrollme_section_page_6',
            'active_callback' => 'scrollme_section6_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout6', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout6',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_6',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section6_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);
    
    // Section 7
	$wp_customize->add_section(
		'scrollme_sec_7',
		array(
			'title' => __('Scroll Section 7', 'scrollme' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'panel' => 'scrollme_panel_scroll_page_sections'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_7_disable', array( 'default' => '', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_7_disable',
		array(
			'label'	=> __( 'Disable Section', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_sec_7',
			'settings' => 'scrollme_section_7_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_section_7', array( 'default' => 'section-7', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_title_with_dashes' ));
	$wp_customize->add_control(
		'scrollme_section_7',
		array(
			'label'	=> __( 'ID for Navigation', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_sec_7',
			/* translators: %s : documentation link */
			'description' => sprintf(__('Use this ID to Create Scrolling Menu. <a target="_blank" href="%s">How to create Menu?</a>', 'scrollme'), esc_url('http://accesspressthemes.com/documentation/scrollme/#!/scrollable_menu') )
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_7_type', array( 'default' => 'page', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_7_type',
		array(
			'label'	=> __( 'Section Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_7',
			'choices' => array(
                'page' => __('Page Layout', 'scrollme'),
                'prlayout' => __('Predefined Layout', 'scrollme'),
            ),
            'description' => __( 'Choose either to display Page or Predefined Layout', 'scrollme' )
		)
	);

	$wp_customize->add_setting( 'scrollme_section_page_7', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_section_page_7',
		array(
			'label'	=> __( 'Choose a Page for Section', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_sec_7',
			'settings' => 'scrollme_section_page_7',
            'active_callback' => 'scrollme_section7_pg_layout',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_section_layout7', array( 'default' => 'services', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control(
		'scrollme_section_layout7',
		array(
			'label'	=> __( 'Choose Layout', 'scrollme' ),
			'type' => 'select',
			'section' => 'scrollme_sec_7',
            'choices' => $pr_layout,
            'active_callback' => 'scrollme_section7_pr_layout',
            'description' => __( 'Navigate back and Configure the Predefined Layout', 'scrollme' )
		)
	);

	/** Service Section Settings **/
    $wp_customize->add_section(
		'scrollme_service_settings',
		array(
			'title' => __('Service Settings', 'scrollme' ),
			'priority' => 51,
			'capability' => 'edit_theme_options',
		)
	);
    
    // Section Title
	$wp_customize->add_setting( 'scrollme_service_title', array( 'default' => 'Sample Title', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_allow_span' ));
	$wp_customize->add_control(
		'scrollme_service_title',
		array(
			'label'	=> __( 'Section Title', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_service_settings',
		)
	);

	// Service 1 Page
	$wp_customize->add_setting( 'scrollme_service_block_1_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_service_block_1_page',
		array(
			'label'	=> __( 'Service 1', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_service_settings',
		)
	);

	// Service 2 Page
	$wp_customize->add_setting( 'scrollme_service_block_2_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_service_block_2_page',
		array(
			'label'	=> __( 'Service 2', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_service_settings',
		)
	);

	// Service 3 Page
	$wp_customize->add_setting( 'scrollme_service_block_3_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_service_block_3_page',
		array(
			'label'	=> __( 'Service 3', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_service_settings',
		)
	);

	// Service 4 Page
	$wp_customize->add_setting( 'scrollme_service_block_4_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_service_block_4_page',
		array(
			'label'	=> __( 'Service 4', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_service_settings',
		)
	);

	$wp_customize->add_control(
		'scrollme_open_service_newtab',
		array(
			'type' => 'checkbox',
			'label' => __( 'Open Service Link in new tab', 'scrollme' ),
			'section' => 'scrollme_service_settings',
			'settings' => 'scrollme_open_service_newtab',
		)
	);
    
    /** Portfolio Settings **/
    $wp_customize->add_section(
		'scrollme_portfolio_settings',
		array(
			'title' => __('Portfolio Settings', 'scrollme' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_portfolio_title', array( 'default' => 'What we have done - <span>Our Works</span>', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_allow_span' ));
    $wp_customize->add_control(
		'scrollme_portfolio_title',
		array(
			'label'	=> __( 'Section Title', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_portfolio_settings',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_portfolio_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_sanitize_integer' ));
	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize, 
        'scrollme_portfolio_page',
        array(
				'label' => __( 'Choose Category for Portfolio', 'scrollme' ),
				'section' => 'scrollme_portfolio_settings',
				'settings' => 'scrollme_portfolio_page'
			)
		)
	);
    
    /** Clients Settings **/
    $wp_customize->add_section(
		'scrollme_clients_settings',
		array(
			'title' => __('Clients Settings', 'scrollme' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_client_title', array( 'default' => 'We Have Some - <span>Great Clients</span>', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_allow_span' ));
    $wp_customize->add_control(
		'scrollme_client_title',
		array(
			'label'	=> __( 'Section Title', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_clients_settings',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_clients_category', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize, 
        'scrollme_clients_category',
        array(
				'label' => __( 'Choose Category for Clients', 'scrollme' ),
				'section' => 'scrollme_clients_settings',
				'settings' => 'scrollme_clients_category',
			)

		)
	);
    
    $wp_customize->add_setting( 'scrollme_linkto_inpage', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_sanitize_checkbox' ));
	$wp_customize->add_control(
		'scrollme_linkto_inpage',
		array(
			'type' => 'checkbox',
			'label' => __( 'Link to Inner Page', 'scrollme' ),
			'section' => 'scrollme_clients_settings',
		)
	);
    
    /** Contact Settings **/
    $wp_customize->add_section(
		'scrollme_contact_settings',
		array(
			'title' => __('Contact Settings', 'scrollme' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_contact_title', array( 'default' => "We'd Love to - <span>Hear From You</span>", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_allow_span' ));
    $wp_customize->add_control(
		'scrollme_contact_title',
		array(
			'label'	=> __( 'Section Title', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_contact_settings',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_contact_page', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_contact_page',
		array(
			'label'	=> __( 'Select Page', 'scrollme' ),
			'type' => 'dropdown-pages',
			'section' => 'scrollme_contact_settings',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_map_info', array( 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control( new WP_Customize_Help_Control( $wp_customize, 'scrollme_map_info', array(
            'section' => 'scrollme_contact_settings',
            'settings' => 'scrollme_map_info',
            'input_attrs' => array(
                'info' => '<p>Add the <span style="text-decoration: underline;">Text</span> widget to the <a href="'.admin_url('widgets.php').'" target="_blank" >Google Map</a> widget area and paste the google map iframe code there.</p>',
            )
        )
    ) );
    
    /** Blog Settings **/
    $wp_customize->add_section(
		'scrollme_blog_settings',
		array(
			'title' => __('Blog Settings', 'scrollme' ),
			'priority' => 52,
			'capability' => 'edit_theme_options',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_blog_title', array( 'default' => "Know - <span>What we are Upto</span>", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_allow_span' ));
    $wp_customize->add_control(
		'scrollme_blog_title',
		array(
			'label'	=> __( 'Section Title', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_blog_settings',
		)
	);
    
    $wp_customize->add_setting( 'scrollme_blog_cat', array( 'default' => '0', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'scrollme_sanitize_integer' ));
	$wp_customize->add_control( new Scrollme_Category_Dropdown_Control( $wp_customize,
        'scrollme_blog_cat',
        array(
				'label' => __( 'Choose Category for Blog', 'scrollme' ),
				'section' => 'scrollme_blog_settings',
				'settings' => 'scrollme_blog_cat'
			)
		)
	);
    
    
    $wp_customize->add_setting( 'scrollme_blog_readmore_txt', array( 'default' => "Read More", 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control(
		'scrollme_blog_readmore_txt',
		array(
			'label'	=> __( 'Readmore Text', 'scrollme' ),
			'type' => 'text',
			'section' => 'scrollme_blog_settings',
		)
	);
        
	// Social Links
	$wp_customize->add_section(
		'scrollme_social_links',
		array(
			'title' => __( 'Social Links', 'scrollme' ),
			'priority' => 170
		)
	);

	// Social Icon Shortcode
    // Social Icons Help Info
    $wp_customize->add_setting( 'scrollme_sicon_info', array( 'sanitize_callback' => 'sanitize_text_field' ));
    $wp_customize->add_control( new WP_Customize_Help_Control( $wp_customize, 'scrollme_sicon_info', array(
            'section' => 'scrollme_social_links',
            'settings' => 'scrollme_sicon_info',
            'input_attrs' => array(
                'info' => '<p>Make Sure You have installed <a href="https://wordpress.org/plugins/accesspress-social-icons/" target="_blank">AccessPres Social Icons plugin</a>. Then create a social icon set.</p><p>Add the <span style="text-decoration: underline;">AccessPres Social Icons</span> widget to the <a href="'.admin_url('widgets.php').'" target="_blank" >Social Link (Header)</a> widget area.</p>',
            )
        )
    ) );

   	//post settings
    $wp_customize->add_section(
		'scrollme_post_settings',
		array(
			'title' => __('Post Settings', 'scrollme' ),
			'priority' => 53,
			'capability' => 'edit_theme_options',
		)
	);

    //featured image
	$wp_customize->add_setting( 'scrollme_feat_img_disable', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_feat_img_disable',
		array(
			'label'	=> __( 'Enable/Disable featured Image', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_post_settings',
			'settings' => 'scrollme_feat_img_disable'
		)
	);

	$wp_customize->add_setting( 'scrollme_metadata_disable', array( 'default' => 1, 'capability' => 'edit_theme_options', 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control(
		'scrollme_metadata_disable',
		array(
			'label'	=> __( 'Enable/Disable MetaData', 'scrollme' ),
			'type' => 'checkbox',
			'section' => 'scrollme_post_settings',
			'settings' => 'scrollme_metadata_disable'
		)
	);

    
}

/** Extra Controls **/
if(class_exists('WP_Customize_Control')) {
    class WP_Customize_Help_Control extends WP_Customize_Control{            
        public function render_content() {
            $input_attrs = $this->input_attrs;
            $info = isset($input_attrs['info']) ? $input_attrs['info'] : '';
            ?>
            <div class="help-info">
                <h4><?php esc_html_e('Instruction', 'scrollme'); ?></h4>
                <div style="font-weight: bold;">
                    <?php echo wp_kses_post($info); ?>
                </div>
            </div>
            <?php
        }
    }
}


add_action( 'customize_register', 'scrollme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function scrollme_customize_preview_js() {
	wp_enqueue_script( 'scrollme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'scrollme_customize_preview_js' );

function scrollme_customize_scripts() {
	wp_enqueue_style( 'scrollme_custom_css', get_template_directory_uri() . '/inc/admin/css/admin.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'scrollme_customize_scripts' );


function scrollme_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function scrollme_sanitize_integer( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}

function scrollme_sanitize_checkbox( $input ) {
	if( $input == 1 ) {
		return 1;
	}else {
		return '';
	}
}

function scrollme_sanitize_float( $input ) {

		return floatval( $input );

}

function scrollme_sanitize_filter_html( $input ) {
	return wp_filter_nohtml_kses( $input );
}

function scrollme_sanitize_slider_settings( $input ) {
	$options = array(
		'yes' => __( 'Yes', 'scrollme' ),
		'no' => __( 'No', 'scrollme' ),
		'horizontal' => __( 'Slider', 'scrollme' ),
		'fade' => __( 'Fade', 'scrollme' ),

	);
	if( array_key_exists( $input, $options ) ) {
		return $input;
	}else {
		return '';
	}
}

    /** Active Callbacks **/
    /** Section Page Layout **/
        function scrollme_section1_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_1_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section2_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_2_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section3_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_3_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section4_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_4_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section5_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_5_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section6_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_6_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section7_pg_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_7_type')->value() == 'page' ) {
                return true;
            } else {
                return false;
            }
        }
    
    /** Section Predefined layout **/
        function scrollme_section1_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_1_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section2_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_2_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section3_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_3_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section4_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_4_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section5_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_5_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section6_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_6_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
        
        function scrollme_section7_pr_layout( $control ) {
            if ( $control->manager->get_setting('scrollme_section_7_type')->value() == 'prlayout' ) {
                return true;
            } else {
                return false;
            }
        }
    /** Sanitization **/
    function scrollme_allow_span($input) {
        $cus_allowed_tags = array(
            'span' => array()
        );
        
        $input_fil = wp_kses($input, $cus_allowed_tags);
        
        return $input_fil;        
    }