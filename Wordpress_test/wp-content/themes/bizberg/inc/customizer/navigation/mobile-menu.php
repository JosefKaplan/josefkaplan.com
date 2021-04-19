<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'slider',
	'settings'    => 'main_menu_dropdown_height',
	'label'       => esc_html__( 'Dropdown Menu Height ( Mobile )', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_main_menu_dropdown_height' , 200 ),
	'choices'     => array(
		'min'  => 200,
		'max'  => 300,
		'step' => 10,
	),
	'output'    => array(
		array(
			'element'  => '.navbar .slicknav_nav',
			'property' => 'max-height',
			'value_pattern' => '$px',
			'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
		),
		array(
			'element'  => '.navbar .slicknav_nav',
			'property' => 'overflow-y',
			'value_pattern' => 'scroll',
			'media_query' => '@media (min-width: 320px) and (max-width: 1024px)'
		),
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_toggle_color_mobile',
	'label'       => esc_html__( 'Toggle Button Color', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_header_menu_toggle_color_mobile', '#434343' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.slicknav_btn.slicknav_open:before, .slicknav_btn.slicknav_collapsed:before',
			'property' => 'color'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_background_mobile',
	'label'       => esc_html__( 'Background Color', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_header_menu_background_mobile' , '#1F1D26' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.slicknav_nav,.slicknav_nav ul li',
			'property' => 'background'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_background_hover_mobile',
	'label'       => esc_html__( 'Background Color ( Hover )', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_header_menu_background_hover_mobile' , '#443E56' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.slicknav_nav .slicknav_row:hover, .slicknav_nav a:hover, .slicknav_nav .menu_custom_btn:hover',
			'property' => 'background',
			'suffix' => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_font_mobile',
	'label'       => esc_html__( 'Font Color', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_header_menu_font_mobile' , '#B6B3C4' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.slicknav_nav a,.slicknav_nav a:focus,.slicknav_nav a:hover',
			'property' => 'color'
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'header_menu_border_color_mobile',
	'label'       => esc_html__( 'Border Color', 'bizberg' ),
	'section'     => 'mobile_menu',
	'default'     => apply_filters( 'bizberg_header_menu_border_color_mobile' , '#3b3844' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'  => '.slicknav_nav li.menu-item > a,.slicknav_nav .slicknav_row,.slicknav_nav a.slicknav_item',
			'property' => 'border-color'
		),
	)
) );