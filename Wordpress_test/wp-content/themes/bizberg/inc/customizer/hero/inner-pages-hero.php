<?php

/** 
* Start Inner Pages Hero 
*/

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'more_options_for_breadcrumb',
    'section'     => 'inner_pages_hero',
    'default'     => '<div class="bizberg_customizer_custom_heading_notice">' . __( 'More options for the breadcrumb can be found here <strong>Appearance > Customize > Breadcrumb</strong>
', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'inner_page_breadcrumb_title_color',
	'label'       => esc_html__( 'Title Color', 'bizberg' ),
	'section'     => 'inner_pages_hero',
	'default'     => '#fff',
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper.not-home .section-title h1',
			'function' => 'css',
			'property' => 'color',
		],
	],
	'output' => array(
		array(
			'element'  => '.breadcrumb-wrapper.not-home .section-title h1',
			'property' => 'color',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'inner_page_breadcrumb_color',
	'label'       => esc_html__( 'Breadcrumb Color', 'bizberg' ),
	'section'     => 'inner_pages_hero',
	'default'     => '#fff',
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper.not-home .breadcrumb li a,.breadcrumb>li+li:before',
			'function' => 'css',
			'property' => 'color'
		],
	],
	'output' => array(
		array(
			'element'  => '.breadcrumb-wrapper.not-home .breadcrumb li a,.breadcrumb>li+li:before',
			'property' => 'color'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'breadcrumb_text_position',
	'label'       => esc_html__( 'Text Position', 'bizberg' ),
	'section'     => 'inner_pages_hero',
	'default'     => 'left',
	'choices'     => [
		'left'   => esc_html__( 'Left', 'bizberg' ),
		'center' => esc_html__( 'Center', 'bizberg' ),
		'right'  => esc_html__( 'Right', 'bizberg' ),
	],
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper.not-home .section-title',
			'function' => 'css',
			'property' => 'text-align'
		]
	],
	'output' => array(
		array(
			'element'  => '.breadcrumb-wrapper.not-home .section-title',
			'property' => 'text-align'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'dimensions',
	'settings'    => 'inner_page_breadcrumb_spacing',
	'label'       => esc_html__( 'Spacing', 'bizberg' ),
	'section'     => 'inner_pages_hero',
	'default'     => [
		'padding-top'    => '65px',
		'padding-bottom' => '65px',
		'padding-left'   => '0px',
		'padding-right'  => '0px',
	],
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'Top', 'bizberg' ),
			'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' ),
			'padding-left' => esc_html__( 'Left', 'bizberg' ),
			'padding-right' => esc_html__( 'Right', 'bizberg' ),
		],
	],
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper.not-home .section-title',
			'function' => 'css'
		]
	],
	'output' => array(
		array(
			'element'  => '.breadcrumb-wrapper.not-home .section-title'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'inner_page_banner_image_options',
	'section'     => 'inner_pages_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Banner Image Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'inner_page_banner_image',
	'section'     => 'inner_pages_hero',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.breadcrumb-wrapper.not-home'
		],
	],
] );

/** 
* End Inner Pages Hero 
*/