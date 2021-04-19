<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'hide_homepage_page_title',
	'label'       => esc_html__( 'Hide title on homepage ?', 'bizberg' ),
	'description' => esc_html__( 'If you select custom homepage or posts page from below options, then you can hide the title.', 'bizberg' ),
	'section'     => 'static_front_page',
	'priority'    => 9,
	'default'     => 'block',
	'choices'     => [
		'block'  => esc_html__( 'Show', 'bizberg' ),
		'none' => esc_html__( 'Hide', 'bizberg' ),
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.home .bizberg_default_page .two-tone-layout .entry-content header.entry-header',
			'property'      => 'display',
			'value_pattern' => '$'
		)
	),
	'active_callback' => [
		[
			'setting'  => 'show_on_front',
			'operator' => '!=',
			'value'    => 'posts',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'hide_homepage_page_featured_image',
	'label'       => esc_html__( 'Hide featured image on homepage ?', 'bizberg' ),
	'description' => esc_html__( 'If you select custom homepage or posts page from below options, then you can hide the feaured image.', 'bizberg' ),
	'section'     => 'static_front_page',
	'priority'    => 9,
	'default'     => 'block',
	'choices'     => [
		'block'  => esc_html__( 'Show', 'bizberg' ),
		'none' => esc_html__( 'Hide', 'bizberg' ),
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.home .bizberg_default_page .two-tone-layout .entry-content img.bizberg_featured_image',
			'property'      => 'display',
			'value_pattern' => '$'
		)
	),
	'active_callback' => [
		[
			'setting'  => 'show_on_front',
			'operator' => '!=',
			'value'    => 'posts',
		]
	],
] );