<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'header_menu_slide_in_animation',
	'label'       => esc_html__( 'Slide In Animation', 'bizberg' ),
	'section'     => 'header',
	'default'     => true,
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_navbar_background_1',
	'label'       => esc_html__( 'Navbar Background 1', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_navbar_background_1', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-collapse',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_navbar_background_2',
	'label'       => esc_html__( 'Navbar Background 2', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_navbar_background_2', '#fff' ),
	'choices'     => [
		'alpha' => true,
	]
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_text_color',
	'label'       => esc_html__( 'Menu Text Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_text_color', '#777' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-nav>li>a,.header-search i',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_separator',
	'label'       => esc_html__( 'Menu Separator Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_separator', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-nav>li>a:after',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_color_hover',
	'label'       => esc_html__( 'Menu Background Color ( Hover )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_color_hover', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.page-fullwidth-transparent-header header .navbar-default .navbar-nav > li > a:hover,.page-fullwidth-transparent-header .navbar-nav > li:hover > a',
			'property' => 'color',
			'suffix'   => ' !important'
		),
		array(
			'element'  => 'header .navbar-default .navbar-nav > li > a:hover,.navbar-nav > li:hover,.header-search .search-form input#searchsubmit, .header-search .search-form input#searchsubmit:visited',
			'property' => 'background',
			'suffix'   => ' !important'
		),
		array(
			'element'  => '.navbar-nav > li.header_btn_wrapper:hover,.navbar-nav > li.search_wrapper:hover,.page-fullwidth-transparent-header .navbar-nav > li:hover',
			'property' => 'background',
			'suffix'   => ' !important',
			'value_pattern' => 'none'
		),
		array(
			'element'  => '.navbar-nav li ul',
			'property' => 'border-top-color',
			'suffix'   => ' !important'
		),
		array(
            'element'  => 'header .navbar-default .navbar-nav > li > a:hover',
            'property' => 'border-color',
            'sanitize_callback' => 'bizberg_adjustBrightness'
        ),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_site_title_color',
	'label'       => esc_html__( 'Site Title Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_site_title_color', '#333' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_header_wrapper h3,.primary_header_2 h3',
			'property'      => 'color',
			'value_pattern' => '$',
			'media_query' => '@media only screen and (min-width: 1025px)'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_site_tagline_color',
	'label'       => esc_html__( 'Site Tagline Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_site_tagline_color', '#333' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_header_wrapper p,.primary_header_2 p',
			'property'      => 'color',
			'value_pattern' => '$',
			'media_query' => '@media only screen and (min-width: 1025px)'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'header_sticky_menu_options_heading',
    'section'     => 'header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Sticky Menu Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_site_title_color_sticky_menu',
	'label'       => esc_html__( 'Site Title Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_site_title_color_sticky_menu', '#333' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.sticky .bizberg_header_wrapper h3,.sticky .primary_header_2 h3,.bizberg_header_wrapper h3',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_site_tagline_color_sticky_menu',
	'label'       => esc_html__( 'Site Tagline Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_site_tagline_color_sticky_menu', '#333' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.sticky .bizberg_header_wrapper p,.sticky .primary_header_2 p, .bizberg_header_wrapper p',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_navbar_background_1_sticky_menu',
	'label'       => esc_html__( 'Navbar Background 1', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_navbar_background_1_sticky_menu', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'  => '.navbar-default.sticky .navbar-collapse',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_navbar_background_2_sticky_menu',
	'label'       => esc_html__( 'Navbar Background 2', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_navbar_background_2_sticky_menu', '#fff' ),
	'choices'     => [
		'alpha' => true,
	]
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_text_color_sticky_menu',
	'label'       => esc_html__( 'Menu Text Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_text_color_sticky_menu', '#777' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar.sticky.navbar-default .navbar-nav>li>a,.navbar.sticky .header-search i',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_separator_sticky_menu',
	'label'       => esc_html__( 'Menu Separator Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_separator_sticky_menu', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-default.sticky .navbar-nav>li>a:after',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_color_hover_sticky_menu',
	'label'       => esc_html__( 'Menu Background Color ( Hover )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_color_hover_sticky_menu', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'header .navbar-default.sticky .navbar-nav > li > a:not(.menu_custom_btn):hover,.sticky .navbar-nav > li:hover,.sticky .header-search .search-form input#searchsubmit,.sticky .header-search .search-form input#searchsubmit:visited',
			'property' => 'background',
			'suffix'   => ' !important'
		),
		array(
			'element'  => '.sticky .navbar-nav > li.header_btn_wrapper:hover,.sticky .navbar-nav > li.search_wrapper:hover',
			'property' => 'background',
			'suffix'   => ' !important',
			'value_pattern' => 'none'
		),
		array(
			'element'  => '.sticky .navbar-nav li ul',
			'property' => 'border-top-color',
			'suffix'   => ' !important'
		),
		array(
            'element'  => 'body:not(.bizberg_transparent_header) header .navbar-default.sticky .navbar-nav > li > a:not(.menu_custom_btn):hover',
            'property' => 'border-color',
            'sanitize_callback' => 'bizberg_adjustBrightness'
        ),
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'header_child_menu_options_heading',
    'section'     => 'header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Child Menu Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_background',
	'label'       => esc_html__( 'Background', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_background', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-nav li ul',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_background_sticky_menu',
	'label'       => esc_html__( 'Background ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_background_sticky_menu', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.sticky .navbar-nav li ul',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_border',
	'label'       => esc_html__( 'Border', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_border', '#eee' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-nav li ul',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.navbar-nav li ul li a',
			'property'      => 'border-bottom-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_border_sticky_menu',
	'label'       => esc_html__( 'Border ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_border_sticky_menu', '#eee' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.sticky .navbar-nav li ul',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.sticky .navbar-nav li ul li a',
			'property'      => 'border-bottom-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_text_color',
	'label'       => esc_html__( 'Text Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_text_color', '#636363' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.navbar-nav li ul li a,.navbar-nav li ul li:hover a',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_child_menu_text_color_sticky_menu',
	'label'       => esc_html__( 'Text Color ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_menu_child_menu_text_color_sticky_menu', '#636363' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.sticky .navbar-nav li ul li a,.sticky .navbar-nav li ul li:hover a',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'header_search_options_heading',
    'section'     => 'header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Search Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'header_search',
	'label'       => esc_html__( 'Disable Search', 'bizberg' ),
	'section'     => 'header',
	'default'     => true
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'header_button_section_heading',
    'section'     => 'header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Button Section', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'header_button',
	'label'       => esc_html__( 'Disable Button', 'bizberg' ),
	'section'     => 'header',
	'default'     => true,
	'partial_refresh' => array(
		'header_btn_wrapper1' => array(
			'selector'        => '.header_btn_wrapper',
			'render_callback' => 'bizberg_get_menu_btn',
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'header_button_label',
	'label'       => esc_html__( 'Button Label', 'bizberg' ),
	'section'     => 'header',
	'default'     => esc_html__( 'Buy Now', 'bizberg' ),
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'partial_refresh' => array(
		'header_btn_wrapper' => array(
			'selector'        => '.header_btn_wrapper',
			'render_callback' => 'bizberg_get_menu_btn',
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'header_button_link',
	'label'       => esc_html__( 'Button Link', 'bizberg' ),
	'section'     => 'header',
	'default'     => '#',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_color',
	'label'       => esc_html__( 'Button Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_color', '#0088cc' ),
	'transport' => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.menu_custom_btn',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_color_sticky_menu',
	'label'       => esc_html__( 'Button Color ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_color_sticky_menu', '#0088cc' ),
	'transport' => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.sticky .menu_custom_btn',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_color_hover',
	'label'       => esc_html__( 'Button Color ( Hover )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_color_hover', '#0088cc' ),
	'transport' => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn:hover',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_color_hover_sticky_menu',
	'label'       => esc_html__( 'Button Color ( Hover ) ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_color_hover_sticky_menu', '#0088cc' ),
	'transport' => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.navbar-default.sticky .navbar-nav>li>a.menu_custom_btn:hover',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'dimensions',
	'settings'    => 'header_btn_border_radius',
	'label'       => esc_html__( 'Border Radius', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 
		'bizberg_header_btn_border_radius', 
		array(
			'top-left-radius'  => '0px',
			'top-right-radius'  => '0px',
			'bottom-left-radius' => '0px',
			'bottom-right-radius' => '0px',
		) 
	),
	'choices'     => array(
		'labels' => array(
			'top-left-radius'  => esc_html__( 'Top Left Radius', 'bizberg' ),
			'top-right-radius'  => esc_html__( 'Top Right Radius', 'bizberg' ),
			'bottom-left-radius' => esc_html__( 'Bottom Left Radius', 'bizberg' ),
			'bottom-right-radius' => esc_html__( 'Bottom Right Radius', 'bizberg' ),
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'property' => 'border',
			'element'  => 'a.menu_custom_btn'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_border_color',
	'label'       => esc_html__( 'Border Color', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_border_color', '#026191' ),
	'transport'   => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn,.navbar-default .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			'property' => 'border-color',
			// 'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_button_border_color_sticky_menu',
	'label'       => esc_html__( 'Border Color ( Sticky Menu )', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_border_color_sticky_menu', '#026191' ),
	'transport'   => 'auto',
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'element'  => '.navbar-default.sticky .navbar-nav>li>a.menu_custom_btn,.navbar-default.sticky .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			'property' => 'border-color',
			// 'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'dimensions',
	'settings'    => 'header_button_border_dimensions',
	'label'       => esc_html__( 'Border Width', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 
		'bizberg_header_button_border_dimensions', 
		array(
			'top-width'  => '0px',
			'bottom-width'  => '0px',
			'left-width' => '0px',
			'right-width' => '0px',
		) 
	),
	'choices'     => array(
		'labels' => array(
			'top-width'  => esc_html__( 'Top', 'bizberg' ),
			'bottom-width'  => esc_html__( 'Bottom', 'bizberg' ),
			'left-width' => esc_html__( 'Left', 'bizberg' ),
			'right-width' => esc_html__( 'Right', 'bizberg' ),
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'property' => 'border',
			'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn,.navbar-default .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			// 'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'dimensions',
	'settings'    => 'header_button_padding',
	'label'       => esc_html__( 'Padding', 'bizberg' ),
	'section'     => 'header',
	'default'     => apply_filters( 'bizberg_header_button_padding', array(
		'top'  => '8px',
		'bottom'  => '8px',
		'left' => '16px',
		'right' => '16px',
	)),
	'choices'     => array(
		'labels' => array(
			'top'  => esc_html__( 'Top', 'bizberg' ),
			'bottom'  => esc_html__( 'Bottom', 'bizberg' ),
			'left' => esc_html__( 'Left', 'bizberg' ),
			'right' => esc_html__( 'Right', 'bizberg' ),
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_button',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'property' => 'padding',
			'element'  => '.navbar-default .navbar-nav>li>a.menu_custom_btn,.navbar-default .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			// 'suffix'   => ' !important'
		),
	)
) );