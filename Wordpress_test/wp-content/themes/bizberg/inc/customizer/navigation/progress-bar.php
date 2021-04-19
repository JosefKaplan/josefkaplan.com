<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'progress_bar_status',
	'label'       => esc_html__( 'Enable', 'bizberg' ),
	'section'     => 'progress_bar',
	'default'     => apply_filters( 'bizberg_progress_bar_status', 'none' ),
	'transport' => 'auto',
	'choices'     => [
		'block'   => esc_html__( 'Show', 'bizberg' ),
		'none' => esc_html__( 'Hide', 'bizberg' )
	],
	'output' => array(
		array(
			'element'  => '.prognroll-bar',
			'property' => 'display',
			'value_pattern' => '$'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'progress_bar_color',
	'label'       => __( 'Background Color', 'bizberg' ),
	'section'     => 'progress_bar',
	'default'     => apply_filters( 'bizberg_progress_bar_color', '#2fbeef' ),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.prognroll-bar',
			'property' => 'background-color',
			'value_pattern' => '$ !important'
		),
	),
	'active_callback' => [
		[
			'setting'  => 'progress_bar_status',
			'operator' => '==',
			'value'    => 'block',
		]
	],
] );	