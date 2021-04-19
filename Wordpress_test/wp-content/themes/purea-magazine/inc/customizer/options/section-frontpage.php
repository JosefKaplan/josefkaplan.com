<?php
/**
 * Theme Customizer Controls
 *
 * @package purea-magazine
 */


if ( ! function_exists( 'purea_magazine_customizer_frontpage_register' ) ) :
function purea_magazine_customizer_frontpage_register( $wp_customize ) {

	$wp_customize->add_section(
        'purea_magazine_front_page_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Front Page Settings', 'purea-magazine' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'purea_magazine_label_front_page_start_layout', 
        array(
            'sanitize_callback' => 'purea_magazine_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_label_front_page_start_layout', 
        array(
            'label'       => esc_html__( 'To use these settings, first create a new page (Pages -> Add New) and then set its template to Home Template under Page Attributes section. Also make sure you have selected this page as your Homepage from Settings -> Reading', 'purea-magazine' ),
            'section'     => 'purea_magazine_front_page_settings',
            'type'        => 'title',
            'settings'    => 'purea_magazine_label_front_page_start_layout',
        ) 
    ));

    // Title label
    $wp_customize->add_setting( 
        'purea_magazine_label_front_page_layout', 
        array(
            'sanitize_callback' => 'purea_magazine_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_front_page_layout', 
        array(
            'label'       => esc_html__( 'Home Page Layout', 'purea-magazine' ),
            'section'     => 'purea_magazine_front_page_settings',
            'type'        => 'title',
            'settings'    => 'purea_magazine_label_front_page_layout',
        ) 
    ));

    // Layout
    $wp_customize->add_setting(
        'purea_magazine_home_page_layout',
        array(
            'default'           => 'right-sidebar',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'purea_magazine_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new Purea_Magazine_Radio_Image_Control( $wp_customize,'purea_magazine_home_page_layout',
            array(
                'settings'      => 'purea_magazine_home_page_layout',
                'section'       => 'purea_magazine_front_page_settings',
                'label'         => esc_html__( 'Choose Layout', 'purea-magazine' ),
                'choices'       => array(
                    'right-sidebar'  => PUREA_MAGAZINE_DIR_URI . '/inc/customizer/assets/images/cr.png',
                    'left-sidebar'   => PUREA_MAGAZINE_DIR_URI . '/inc/customizer/assets/images/cl.png',
                    'both-sidebars'  => PUREA_MAGAZINE_DIR_URI . '/inc/customizer/assets/images/clr.png',
                )
            )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'purea_magazine_home_page_layout_start', 
        array(
            'sanitize_callback' => 'purea_magazine_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_home_page_layout_start', 
        array(
            'label'       => esc_html__( 'After this step, you have to add widgets to the columns. Navigate to Appearance -> Widgets and then add widgets to the Home Page Left Section, Home Page Main Section and Home Page Right Section.', 'purea-magazine' ),
            'section'     => 'purea_magazine_front_page_settings',
            'type'        => 'title',
            'settings'    => 'purea_magazine_home_page_layout_start',
        ) 
    ));

    // Title label
	$wp_customize->add_setting( 
		'purea_magazine_label_front_page_highlight', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Title_Info_Control( $wp_customize, 'purea_magazine_label_front_page_highlight', 
		array(
		    'label'       => esc_html__( 'Highlight Area', 'purea-magazine' ),
		    'section'     => 'purea_magazine_front_page_settings',
		    'type'        => 'title',
		    'settings'    => 'purea_magazine_label_front_page_highlight',
		) 
	));

    // Show highlight area
    $wp_customize->add_setting( 
        'purea_magazine_enable_highlight_area', 
        array(
            'default'           => true,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control( 
        new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_enable_highlight_area', 
        array(
            'label'       => esc_html__( 'Show Highlight Area', 'purea-magazine' ),
            'section'     => 'purea_magazine_front_page_settings',
            'type'        => 'toggle',
            'settings'    => 'purea_magazine_enable_highlight_area',
        ) 
    ));

	// Info label
	$wp_customize->add_setting( 
		'purea_magazine_label_highlight_area_info', 
		array(
		    'sanitize_callback' => 'purea_magazine_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Info_Control( $wp_customize, 'purea_magazine_label_highlight_area_info', 
		array(
		    'label'       => esc_html__( 'Note: The highlight area is the 3 columns section after the header using to showcase the posts ', 'purea-magazine' ),
		    'section'     => 'purea_magazine_front_page_settings',
		    'type'        => 'info',
		    'settings'    => 'purea_magazine_label_highlight_area_info',
		) 
	));

	// Check for showing the same category for all the 3 columns
	$wp_customize->add_setting( 
		'purea_magazine_is_show_same_cat_highlight_area', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'purea_magazine_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Purea_Magazine_Toggle_Control( $wp_customize, 'purea_magazine_is_show_same_cat_highlight_area', 
		array(
		    'label'       => esc_html__( 'Show same category for all 3 columns', 'purea-magazine' ),
		    'section'     => 'purea_magazine_front_page_settings',
		    'type'        => 'toggle',
		    'settings'    => 'purea_magazine_is_show_same_cat_highlight_area',
            'active_callback'  => 'purea_magazine_highlight_area_enable',
		) 
	));

	// Category
    $wp_customize->add_setting( 
        'purea_magazine_highlight_area_category_all', 
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
       'purea_magazine_highlight_area_category_all', 
        array(
            'section'       => 'purea_magazine_front_page_settings',
            'label'         => esc_html__( 'Choose Category', 'purea-magazine' ),
            'description'   => esc_html__( 'Select category from which posts will show from. Leave unselect to show all categories posts', 'purea-magazine' ),
            'type'          => 'select',
			'choices'       =>  purea_magazine_category_list(),
            'active_callback'  => 'purea_magazine_same_cat_highlight_area_enable',
        ) 
    ); 

    // Category for column1
    $wp_customize->add_setting( 
        'purea_magazine_highlight_area_category_column1', 
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
       'purea_magazine_highlight_area_category_column1', 
        array(
            'section'       => 'purea_magazine_front_page_settings',
            'label'         => esc_html__( 'Choose Category for Column1', 'purea-magazine' ),
            'description'   => esc_html__( 'Select category from which posts will show from.', 'purea-magazine' ),
            'type'          => 'select',
			'choices'       =>  purea_magazine_category_list(),
            'active_callback'  => 'purea_magazine_same_cat_highlight_area_disable',
        ) 
    );

    // Category for column2
    $wp_customize->add_setting( 
        'purea_magazine_highlight_area_category_column2', 
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
       'purea_magazine_highlight_area_category_column2', 
        array(
            'section'       => 'purea_magazine_front_page_settings',
            'label'         => esc_html__( 'Choose Category for Column2', 'purea-magazine' ),
            'description'   => esc_html__( 'Select category from which posts will show from.', 'purea-magazine' ),
            'type'          => 'select',
			'choices'       =>  purea_magazine_category_list(),
            'active_callback'  => 'purea_magazine_same_cat_highlight_area_disable',
        ) 
    );

    // Category for column3
    $wp_customize->add_setting( 
        'purea_magazine_highlight_area_category_column3', 
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'purea_magazine_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
       'purea_magazine_highlight_area_category_column3', 
        array(
            'section'       => 'purea_magazine_front_page_settings',
            'label'         => esc_html__( 'Choose Category for Column3', 'purea-magazine' ),
            'description'   => esc_html__( 'Select category from which posts will show from.', 'purea-magazine' ),
            'type'          => 'select',
			'choices'       =>  purea_magazine_category_list(),
            'active_callback'  => 'purea_magazine_same_cat_highlight_area_disable',
        ) 
    ); 



}
endif;
add_action( 'customize_register', 'purea_magazine_customizer_frontpage_register' );