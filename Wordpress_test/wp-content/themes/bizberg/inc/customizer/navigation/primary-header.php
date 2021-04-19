<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-image',
	'settings'    => 'primary_header_layout',
	'label'       => esc_html__( 'Layout', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_primary_header_layout', 'left' ),
	'choices'     => [
		'left'   => get_template_directory_uri() . '/assets/images/header-layout-1.jpg',
		'center'   => get_template_directory_uri() . '/assets/images/header-layout-2.jpg',
		'right'   => get_template_directory_uri() . '/assets/images/header-layout-3.jpg'
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'primary_header_layout_width',
	'label'       => esc_html__( 'Width', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_primary_header_layout_width', '' ),
	'choices'     => [
		'100%' => esc_html__( 'Full Width', 'bizberg' ),
		'' => esc_html__( 'Content Width', 'bizberg' )
	],
	'output' => array(
		array(
			'element'  => 'header #navbar .container,.primary_header_2_wrapper .container',
			'property' => 'width',
		),
		array(
			'element'  => 'header #navbar .container,.primary_header_2_wrapper .container',
			'property' => 'max-width',
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'dimensions',
	'settings'    => 'header_2_spacing',
	'label'       => esc_html__( 'Spacing', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_header_2_spacing', [
		'padding-top'  => '20px',
		'padding-bottom'  => '20px',
	]),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'Top', 'bizberg' ),
			'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' ),
		],
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		]
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.primary_header_2_wrapper'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'header_2_position',
	'label'       => esc_html__( 'Position', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_header_2_position', 'center' ),
	'choices'     => [
		'left' => esc_html__( 'Left', 'bizberg' ),
		'center' => esc_html__( 'Center', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		]
	],
	'output' => array(
		array(
			'element'  => '.primary_header_2',
			'property' => 'justify-content'
		),
		array(
			'element'  => '.primary_header_2',
			'property' => 'text-align'
		),
		array(
			'element'  => '.primary_header_center .bizberg_header_wrapper',
			'property' => 'justify-content',
			'media_query' => '@media only screen and (min-width: 1025px)'
		),
	),
] );

/**
* Start for header left style
*/

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'last_item_header',
	'label'       => esc_html__( 'Last Item on Header', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_last_item_header', 'none' ),
	'choices'     => [
		'none' => esc_html__( 'None', 'bizberg' ),
		'text' => esc_html__( 'Text / Html', 'bizberg' ),
		'widget' => esc_html__( 'Widget', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'left',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'header_columns',
	'label'       => esc_html__( 'Columns', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_header_columns', 'col-sm-5|col-sm-7' ),
	'choices'     => [
		'col-sm-5|col-sm-7' => esc_html__( '40% | 60%', 'bizberg' ),
		'col-sm-6|col-sm-6' => esc_html__( '50% | 50%', 'bizberg' ),
		'col-sm-7|col-sm-5' => esc_html__( '60% | 40%', 'bizberg' ),
		'col-sm-8|col-sm-4' => esc_html__( '70% | 30%', 'bizberg' ),
		'col-sm-4|col-sm-8' => esc_html__( '30% | 70%', 'bizberg' ),
		'col-sm-3|col-sm-9' => esc_html__( '20% | 80%', 'bizberg' ),
		'col-sm-9|col-sm-3' => esc_html__( '80% | 20%', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'last_item_header',
			'operator' => '!=',
			'value'    => 'none',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'left',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'textarea',
	'settings' => 'last_item_html',
	'label'    => esc_html__( 'Text / HTML', 'bizberg' ),
	'description' => class_exists( 'WooCommerce' ) ? __( 'You can use there shortcodes. <code>[bizberg_product_search_box], [bizberg_woocommerce_account_menu], 
[bizberg_woocommerce_wishlist], [bizberg_woocommerce_compare], [bizberg_woocommerce_mini_cart]</code>', 'bizberg' ) : '',
	'section'  => 'primary_header',
	'default'  => apply_filters( 'bizberg_last_item_html', '<button>Contact Us</button>' ),
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'left',
		],
		[
			'setting'  => 'last_item_header',
			'operator' => '==',
			'value'    => 'text',
		],
	],
] );

/**
* End for header left style
*/

/**
* Start for header middle style
*/

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'header_columns_middle_style',
	'label'       => esc_html__( 'Columns', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_header_columns_middle_style', 'col-sm-3|col-sm-6|col-sm-3' ),
	'choices'     => [
		'col-sm-4|col-sm-4|col-sm-4' => esc_html__( '33% | 33% | 33%', 'bizberg' ),
		'col-sm-3|col-sm-6|col-sm-3' => esc_html__( '25% | 50% | 25%', 'bizberg' ),
		'col-sm-2|col-sm-8|col-sm-2' => esc_html__( '20% | 60% | 20%', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		]
	],
] );

/* Start First Item On Header */

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'first_item_header_logo_center',
	'label'       => esc_html__( 'First Item on Header', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_first_item_header_logo_center', 'none' ),
	'choices'     => [
		'none' => esc_html__( 'None', 'bizberg' ),
		'text' => esc_html__( 'Text / Html', 'bizberg' ),
		'social_icons' => esc_html__( 'Social Icons', 'bizberg' ),
		'widget' => esc_html__( 'Widget', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'textarea',
	'settings' => 'first_item_html_logo_center',
	'label'    => esc_html__( 'Text / HTML ( Left Header )', 'bizberg' ),
	'description' => class_exists( 'WooCommerce' ) ? __( 'You can use there shortcodes. <code>[bizberg_product_search_box], [bizberg_woocommerce_account_menu], 
[bizberg_woocommerce_wishlist], [bizberg_woocommerce_compare], [bizberg_woocommerce_mini_cart]</code>', 'bizberg' ) : '',
	'section'  => 'primary_header',
	'default'  => apply_filters( 'bizberg_first_item_html_logo_center', '<a href="#" class="btn btn-primary">Contact Us</a>' ),
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'first_item_header_logo_center',
			'operator' => '==',
			'value'    => 'text',
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'repeater',
	'label'       => esc_html__( 'Social Icons ( Left Header )', 'bizberg' ),
	'section'     => 'primary_header',
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Icon', 'bizberg' ),
	],
	'button_label' => esc_html__('Add New', 'bizberg' ),
	'settings'     => 'first_item_social_links',
	'default'      => [
		[
			'icon' => 'fab fa-facebook',
			'link_url'  => '#',
			'color'  => '#000'
		],
		[
			'icon' => 'fab fa-twitter-square',
			'link_url'  => '#',
			'color'  => '#000'
		],
	],
	'fields' => [
		'icon' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Fontawesome Icon', 'bizberg' ),
			'description' => __( 'You can get icons from here https://fontawesome.com/. eg fab fa-facebook', 'bizberg' ),
			'default'     => 'fab fa-facebook',
		],
		'link_url'  => [
			'type'        => 'text',
			'label'       => esc_html__( 'Link', 'bizberg' ),
			'default'     => '#',
		],
		'color'  => [
			'type'        => 'color',
			'label'       => esc_html__( 'Color', 'bizberg' ),
			'default'     => '#000',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'first_item_header_logo_center',
			'operator' => '==',
			'value'    => 'social_icons',
		],
	],
	'partial_refresh'    => [
		'bizberg_header_social_icon_left' => [
			'selector'        => '.bizberg_header_social_icon_left',
			'render_callback' => function() {
				return bizberg_get_header_social_icons( 'first_item_social_links' );
			},
		],
	],
] );

/* Start Last Item On Header */

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'last_item_header_logo_center',
	'label'       => esc_html__( 'Last Item on Header', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_last_item_header_logo_center', 'none' ),
	'choices'     => [
		'none' => esc_html__( 'None', 'bizberg' ),
		'text' => esc_html__( 'Text / Html', 'bizberg' ),
		'social_icons' => esc_html__( 'Social Icons', 'bizberg' ),
		'widget' => esc_html__( 'Widget', 'bizberg' )
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'repeater',
	'label'       => esc_html__( 'Social Icons ( Right Header )', 'bizberg' ),
	'section'     => 'primary_header',
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Icon', 'bizberg' ),
	],
	'button_label' => esc_html__('Add New', 'bizberg' ),
	'settings'     => 'last_item_social_links',
	'default'      => [
		[
			'icon' => 'fab fa-facebook',
			'link_url'  => '#',
			'color'  => '#000'
		],
		[
			'icon' => 'fab fa-twitter-square',
			'link_url'  => '#',
			'color'  => '#000'
		],
	],
	'fields' => [
		'icon' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Fontawesome Icon', 'bizberg' ),
			'description' => __( 'You can get icons from here https://fontawesome.com/. eg fab fa-facebook', 'bizberg' ),
			'default'     => 'fab fa-facebook',
		],
		'link_url'  => [
			'type'        => 'text',
			'label'       => esc_html__( 'Link', 'bizberg' ),
			'default'     => '#',
		],
		'color'  => [
			'type'        => 'color',
			'label'       => esc_html__( 'Color', 'bizberg' ),
			'default'     => '#000',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'last_item_header_logo_center',
			'operator' => '==',
			'value'    => 'social_icons',
		],
	],
	'partial_refresh'    => [
		'bizberg_header_social_icon_right' => [
			'selector'        => '.bizberg_header_social_icon_right',
			'render_callback' => function() {
				return bizberg_get_header_social_icons( 'last_item_social_links' );
			},
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'textarea',
	'settings' => 'last_item_html_logo_center',
	'label'    => esc_html__( 'Text / HTML ( Right Header )', 'bizberg' ),
	'section'  => 'primary_header',
	'description' => class_exists( 'WooCommerce' ) ? __( 'You can use there shortcodes. <code>[bizberg_product_search_box], [bizberg_woocommerce_account_menu], 
[bizberg_woocommerce_wishlist], [bizberg_woocommerce_compare], [bizberg_woocommerce_mini_cart]</code>', 'bizberg' ) : '',
	'default'  => apply_filters( 'bizberg_last_item_html_logo_center', '<a href="#" class="btn btn-primary">Contact Us</a>' ),
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'header_2_position',
			'operator' => '==',
			'value'    => 'center',
		],
		[
			'setting'  => 'last_item_header_logo_center',
			'operator' => '==',
			'value'    => 'text',
		],
	],
] );

/**
* End for header middle style
*/

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'primary_header_layout_bottom_border_notice',
    'section'     => 'primary_header',
    'default'     => '<div class="bizberg_customizer_custom_heading_notice">' . __( 'The border will only display, if there is no slider/banner on the page.', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'number',
	'settings'    => 'primary_header_layout_bottom_border_size',
	'label'       => esc_html__( 'Bottom Border Size', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_primary_header_layout_bottom_border_size', 10 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body.home header#masthead, body:not(.home) header#masthead',
			'property' => 'border-bottom-width',
			'value_pattern' => '$px'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'primary_header_layout_top_border_color',
	'label'       => __( 'Top Border Color', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_primary_header_layout_top_border_color', '#eee' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output' => array(
		array(
			'element'  => '.primary_header_2_wrapper',
			'property' => 'border-bottom-color'
		),
	),
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'primary_header_layout_bottom_border_color',
	'label'       => __( 'Bottom Border Color', 'bizberg' ),
	'section'     => 'primary_header',
	'default'     => apply_filters( 'bizberg_primary_header_layout_bottom_border_color', '#eee' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output' => array(
		array(
			'element'  => 'body.home header#masthead, body:not(.home) header#masthead',
			'property' => 'border-bottom-color'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'header_background_image',
	'section'     => 'primary_header',
	'active_callback' => [
		[
			'setting'  => 'primary_header_layout',
			'operator' => '==',
			'value'    => 'center',
		]
	],
	'default'     => apply_filters( 'bizberg_header_background_image', [
		'background-color'      => 'rgba(255,255,255,0)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	])
] );