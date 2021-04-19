<?php

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'footer_social_icons_heading',
    'section'     => 'footer_settings',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Social Icons', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'repeater',
	'label'       => esc_html__( 'Social Links', 'bizberg' ),
	'section'     => 'footer_settings',
	'row_label' => array(
		'type' => 'text',
		'value' => esc_html__( 'Social Link', 'bizberg' ),
	),
	'settings'    => 'footer_social_links',
	'fields' => array(
		'icon' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon', 'bizberg' ),
			'description' => sprintf( 
				__( 'You can get icons from %s', 'bizberg' ), 
				'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
			),
			'default' => 'fab fa-facebook-f'
		),
		'link' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link', 'bizberg' ),
			'default' => '#'				
		),	
		'target' => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Open in a new tab ?', 'bizberg' ),
			'default'     => true				
		),	
	),
	'partial_refresh' => array(
		'footer_social_links' => array(
			'selector'        => '.footer_social_links',
			'render_callback' => 'bizberg_get_footer_social_links',
		)
	),
	'active_callback' => array(
		array(
			'setting'  => 'footer_grid_copyright_layout',
			'operator' => '!=',
			'value'    => '3',
		)
	),
	'default'      => [
		[
			'icon' => 'fab fa-facebook-f',
			'link'  => '#',
			'target' => true
		],
		[
			'icon' => 'fab fa-twitter',
			'link'  => '#',
			'target' => true
		],
		[
			'icon' => 'fab fa-instagram',
			'link'  => '#',
			'target' => true
		],
		[
			'icon' => 'fab fa-youtube',
			'link'  => '#',
			'target' => true
		],
	],
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'copyright_footer_color_options',
    'section'     => 'footer_settings',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Color Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'footer_social_icon_color',
	'label'       => esc_html__( 'Social Icon Color', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => apply_filters( 'bizberg_footer_social_icon_color', '#1098c6' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'footer .footer_social_links a i',
			'property' => 'color',
			'suffix'   => ' !important'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'footer_social_icon_background',
	'label'       => esc_html__( 'Social Icon Background Color', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => apply_filters( 'bizberg_footer_social_icon_background', '#f1f1f1' ),
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'  => 'footer .footer_social_links a i',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	),
] );	

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'footer_copyright_background',
	'label'       => esc_html__( 'Background Color', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => apply_filters( 'bizberg_footer_copyright_background', '#1f2024' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'footer#footer.footer-style',
			'property' => 'background',
			'suffix'   => ' !important'
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'footer_copyright_text_color',
	'label'       => esc_html__(  'Text Color', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => '#fff',
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'footer#footer.footer-style p',
			'property' => 'color'
		),
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'footer_color_link',
	'label'       => esc_html__( 'Link Color', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => '#fff',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#footer a',
			'property' => 'color'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'footer_hover_color_link',
	'label'       => esc_html__( 'Link Color ( Hover )', 'bizberg' ),
	'section'     => 'footer_settings',
	'default'     => '#fff',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#footer a:hover',
			'property' => 'color'
		)
	)
) );