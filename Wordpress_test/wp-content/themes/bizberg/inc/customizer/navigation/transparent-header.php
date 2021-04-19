<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'transparent_header_homepage',
	'label'       => esc_html__( 'Transparent Header Homepage ?', 'bizberg' ),
	'description' => esc_html__( 'If enabled, the homepage will have transparent header.', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_homepage', false ),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'repeater',
	'label'       => esc_html__( 'Pages', 'bizberg' ),
	'section'     => 'transparent_header',
	'description' => esc_html__( 'Select pages that will contain transparent header.', 'bizberg' ),
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Pages', 'bizberg' ),
	],
	'button_label' => esc_html__('Add New', 'bizberg' ),
	'settings'     => 'transparent_header_pages',
	'default'     => [],
	'choices' => [
		'limit' => 1
	],
	'fields' => [
		'page_id'  => [
			'type'        => 'select',
			'label'       => esc_html__( 'Page', 'bizberg' ),
			'choices'  => bizberg_get_all_pages()
		],
	]
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'image',
	'settings'    => 'transparent_header_logo',
	'label'       => esc_html__( 'Logo', 'bizberg' ),
	'description' => esc_html__( 'Will be used only where transparent header is enabled.', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => '',
	'choices'     => [
		'save_as' => 'id',
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'transparent_header_color_options_heading',
    'section'     => 'transparent_header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Transparent Header Color Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_navbar_background',
	'label'       => esc_html__( 'Background', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_navbar_background', 'rgba(10,10,10,0.2)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar,body.bizberg_transparent_header .navbar-default,body.bizberg_transparent_header .primary_header_2_wrapper',
			'property' => 'background',
		),
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'header_blur',
	'label'       => esc_html__( 'Blur', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_header_blur', 30 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead,body.bizberg_transparent_header .navbar.sticky',
			'property' => 'backdrop-filter',
			'value_pattern' => 'blur($px)',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead,body.bizberg_transparent_header .navbar.sticky',
			'property' => '--webkit-backdrop-filter',
			'value_pattern' => 'blur($px)',
		),
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_navbar_border_color',
	'label'       => esc_html__( 'Border Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => 'rgba(255,255,255,0.36)',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar,body.bizberg_transparent_header .primary_header_2_wrapper, .bizberg_transparent_header:not(.bizberg_sticky_header_disabled) header#masthead',
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar #top-social-left li a',
			'property' => 'border-right-color',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar #top-social-left li:first-child a',
			'property' => 'border-left-color',
		),
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_navbar_separator_color',
	'label'       => esc_html__( 'Separator Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => 'rgba(255,255,255,0.36)',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar .top-bar-right li:after',
			'property' => 'color',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default .navbar-nav>li>a:after',
			'property' => 'background',
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_navbar_text_color',
	'label'       => esc_html__( 'Text Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => '#fff',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead #top-bar #top-social-left li a,body.bizberg_transparent_header header#masthead #top-bar .infobox_header_wrapper li a,body.bizberg_transparent_header header#masthead #top-bar .infobox_header_wrapper li, body.bizberg_transparent_header header#masthead .navbar-default .navbar-nav>li>a, body.bizberg_transparent_header header#masthead .header-search i',
			'property' => 'color',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .bizberg_header_wrapper h3,body.bizberg_transparent_header header#masthead .primary_header_2 h3, body.bizberg_transparent_header header#masthead .bizberg_header_wrapper p, body.bizberg_transparent_header header#masthead .primary_header_2 p',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_menu_color_hover',
	'label'       => esc_html__( 'Menu Background Color ( Hover )', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_menu_color_hover', 'rgba(10,10,10,0.1)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header .page-fullwidth-transparent-header header .navbar-default .navbar-nav > li > a:hover,body.bizberg_transparent_header .page-fullwidth-transparent-header .navbar-nav > li:hover > a',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header .navbar-default .navbar-nav > li > a:hover, body.bizberg_transparent_header header .navbar-default.sticky .navbar-nav > li > a:hover, body.bizberg_transparent_header .navbar-nav > li:hover,body.bizberg_transparent_header .header-search .search-form input#searchsubmit,body.bizberg_transparent_header .header-search .search-form input#searchsubmit:visited',
			'property' => 'background',
			'suffix'   => ' !important',
		),
		array(
			'element'  => 'body.bizberg_transparent_header .navbar-nav > li.header_btn_wrapper:hover,body.bizberg_transparent_header .navbar-nav > li.search_wrapper:hover,body.bizberg_transparent_header .page-fullwidth-transparent-header .navbar-nav > li:hover',
			'property' => 'background',
			'suffix'   => ' !important',
			'value_pattern' => 'none',
		),
		array(
			'element'  => 'body.bizberg_transparent_header .navbar-nav li ul',
			'property' => 'border-top-color',
			'suffix'   => ' !important',
		),
		array(
            'element'  => 'body.bizberg_transparent_header header .navbar-default .navbar-nav > li > a:hover, body.bizberg_transparent_header header .navbar-default.sticky .navbar-nav > li > a:hover',
            'property' => 'border-color',
            'value_pattern' => 'transparent',
        ),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_button_color_text',
	'label'       => esc_html__( 'Button Text Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_button_color_text', '#fff' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead nav:not(.sticky) .menu_custom_btn',
			'property' => 'color',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_button_color',
	'label'       => esc_html__( 'Button Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_button_color', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead nav:not(.sticky) .menu_custom_btn',
			'property' => 'background',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_button_color_hover',
	'label'       => esc_html__( 'Button Color ( Hover )', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_button_color_hover', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default:not(.sticky) .navbar-nav>li>a.menu_custom_btn:hover, body.bizberg_transparent_header header#masthead .page-fullwidth-transparent-header .navbar-default:not(.sticky) .navbar-nav>li>a.menu_custom_btn:hover',
			'property' => 'background',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_button_border_color',
	'label'       => esc_html__( 'Button Border Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_button_border_color', '#026191' ),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default:not(.sticky) .navbar-nav>li>a.menu_custom_btn,body.bizberg_transparent_header header#masthead .navbar-default:not(.sticky) .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			'property' => 'border-color',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'transparent_header_mobile_options_heading',
    'section'     => 'transparent_header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Transparent Header Mobile Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_menu_toggle_color_mobile',
	'label'       => esc_html__( 'Toggle Button Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_menu_toggle_color_mobile', '#434343' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header.bizberg_sticky_header_enabled header#masthead .slicknav_btn.slicknav_open:before, body.bizberg_transparent_header.bizberg_sticky_header_enabled header#masthead .slicknav_btn.slicknav_collapsed:before',
			'property' => 'color'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'transparent_header_sticky_options_heading',
    'section'     => 'transparent_header',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Transparent Header Sticky Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'image',
	'settings'    => 'sticky_transparent_header_logo',
	'label'       => esc_html__( 'Sticky Logo', 'bizberg' ),
	'description' => esc_html__( 'Will be used only where transparent header is enabled and when the user scrolls the page.', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => ''
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_menu_sticky_background',
	'label'       => esc_html__( 'Header Background', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_menu_sticky_background', 'rgba(255,255,255,0)' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header .navbar-default.sticky',
			'property' => 'background'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_sticky_menu_color_hover',
	'label'       => esc_html__( 'Menu Background Color ( Hover )', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_sticky_menu_color_hover', 'rgba(10,10,10,0.1)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header .sticky .navbar-nav li ul',
			'property' => 'border-top-color',
			'suffix'   => ' !important',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header .navbar-default.sticky .navbar-nav > li > a:hover, body.bizberg_transparent_header .sticky .navbar-nav > li:not(.search_wrapper):not(.header_btn_wrapper):hover',
			'property' => 'background',
			'suffix'   => ' !important',
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_menu_sticky_text_color',
	'label'       => esc_html__( 'Text Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_menu_sticky_text_color', '#fff' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output' => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default.sticky .navbar-nav>li>a, body.bizberg_transparent_header header#masthead .sticky .header-search i',
			'property' => 'color',
		),
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .sticky .bizberg_header_wrapper h3,body.bizberg_transparent_header header#masthead .sticky .primary_header_2 h3, body.bizberg_transparent_header header#masthead .sticky .bizberg_header_wrapper p, body.bizberg_transparent_header header#masthead .sticky .primary_header_2 p',
			'property' => 'color',
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_sticky_button_color_text',
	'label'       => esc_html__( 'Button Text Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_sticky_button_color_text', '#fff' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead nav.sticky .menu_custom_btn',
			'property' => 'color',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_sticky_button_color',
	'label'       => esc_html__( 'Button Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_sticky_button_color', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead nav.sticky .menu_custom_btn',
			'property' => 'background',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_sticky_button_color_hover',
	'label'       => esc_html__( 'Button Color ( Hover )', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_sticky_button_color_hover', '#0088cc' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default.sticky .navbar-nav>li>a.menu_custom_btn:hover, body.bizberg_transparent_header header#masthead .page-fullwidth-transparent-header .navbar-default.sticky .navbar-nav>li>a.menu_custom_btn:hover',
			'property' => 'background',
			'suffix'   => ' !important',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'transparent_header_sticky_button_border_color',
	'label'       => esc_html__( 'Button Border Color', 'bizberg' ),
	'section'     => 'transparent_header',
	'default'     => apply_filters( 'bizberg_transparent_header_sticky_button_border_color', '#026191' ),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'  => 'body.bizberg_transparent_header header#masthead .navbar-default.sticky .navbar-nav>li>a.menu_custom_btn,body.bizberg_transparent_header header#masthead .navbar-default.sticky .has-no-menu-description .navbar-nav>li>a.menu_custom_btn',
			'property' => 'border-color',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	)
) );