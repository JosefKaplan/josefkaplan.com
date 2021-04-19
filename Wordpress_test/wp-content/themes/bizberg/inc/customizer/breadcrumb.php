<?php

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'more_options_breadcrumb',
    'section'     => 'breadcrumb',
    'default'     => '<div class="bizberg_customizer_custom_heading_notice">' . __( 'More options for the breadcrumb can be found here <strong>Appearance > Customize > Hero > Inner Pages Hero</strong>
', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'separator_breadcrumb',
	'label'    => esc_html__( 'Separator', 'bizberg' ),
	'section'  => 'breadcrumb',
	'default'  => '/\00a0',
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.breadcrumb>li+li:before',
			'property' => 'content',
			'value_pattern' => '"$"',
		),
	),
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'breadcrumb_search_page_heading',
    'section'     => 'breadcrumb',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Search Page', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_search_page',
	'label'       => esc_html__( 'Disable on Search Page?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => true,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_search_page_custom_image',
	'label'       => esc_html__( 'Upload Custom Image?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => false,
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_search_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'custom_search_page_image',
	'section'     => 'breadcrumb',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.search .breadcrumb-wrapper',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_search_page_custom_image',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'breadcrumb_search_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'breadcrumb_archive_page_heading',
    'section'     => 'breadcrumb',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Archive Page', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_archive_page',
	'label'       => esc_html__( 'Disable on Archive Page?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => true,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_archive_page_custom_image',
	'label'       => esc_html__( 'Upload Custom Image?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => false,
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_archive_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'custom_archive_page_image',
	'section'     => 'breadcrumb',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.archive .breadcrumb-wrapper',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_archive_page_custom_image',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'breadcrumb_archive_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'breadcrumb_single_page_heading',
    'section'     => 'breadcrumb',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Single Page', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_single_page',
	'label'       => esc_html__( 'Disable on Single Page?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => true,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_single_page_custom_image',
	'label'       => esc_html__( 'Upload Custom Image?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => false,
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_single_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'custom_single_page_image',
	'section'     => 'breadcrumb',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.page .breadcrumb-wrapper',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_single_page_custom_image',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'breadcrumb_single_page',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'breadcrumb_single_post_heading',
    'section'     => 'breadcrumb',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Single Post', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_single_post',
	'label'       => esc_html__( 'Disable on Single Post?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => true,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'breadcrumb_single_post_custom_image',
	'label'       => esc_html__( 'Upload Custom Image?', 'bizberg' ),
	'section'     => 'breadcrumb',
	'default'     => false,
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_single_post',
			'operator' => '==',
			'value'    => false,
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'custom_single_post_image',
	'section'     => 'breadcrumb',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.single .breadcrumb-wrapper',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'breadcrumb_single_post_custom_image',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'breadcrumb_single_post',
			'operator' => '==',
			'value'    => false,
		]
	],
] );