<?php

Kirki::add_field( 'bizberg', [
	'type'        => 'link',
	'settings'    => 'logo_site_title_custom_url',
	'label'       => esc_html__( 'Logo / Site Title Link', 'bizberg' ),
	'section'     => 'title_tagline',
	'default'     => '',
	'priority'    => 9, 
	'description' => esc_html__( 'Add custom link for logo / site title', 'bizberg' )
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'logo_site_title_custom_url_new_tab',
	'label'       => esc_html__( 'Open link in a new tab ?', 'bizberg' ),
	'section'     => 'title_tagline',
	'default'     => '',
	'priority'    => 9,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'logo_height',
	'label'       => esc_html__( 'Logo Height', 'bizberg' ),
	'section'     => 'title_tagline',
	'default'     => 51,
	'priority'    => 9, 
	'choices'     => [
		'min'  => 51,
		'max'  => 200,
		'step' => 1,
	],
	'transport' => 'auto',
	'output'   => array(
		array(
			'element'  => '.bizberg_header_wrapper .logo img,.primary_header_2 a img',
			'property'      => 'max-height',
			'value_pattern' => '$px',
			'media_query' => '@media (min-width: 1025px) and (max-width: 2000px)'
		)
	)
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'sticky_logo_height',
	'label'       => esc_html__( 'Apply default logo height on sticky menu', 'bizberg' ),
	'description' => esc_html__( 'If checked, it will ignore the above height and use default height for the logo on sitcky menu.', 'bizberg' ),
	'section'     => 'title_tagline',
	'default'     => '51px',
	'priority'    => 9,
	'choices'     => [
		'51px'    => esc_html__( 'Enable', 'bizberg' ),
		''   => esc_html__( 'Disable', 'bizberg' )
	],
	'output'   => array(
		array(
			'element'  => '.navbar.sticky .bizberg_header_wrapper .logo img',
			'property'      => 'max-height',
			'value_pattern' => '$'
		)
	)
] );