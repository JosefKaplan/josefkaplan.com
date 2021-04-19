<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'top_header_status',
	'label'       => esc_html__( 'Disable Top Bar', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_top_header_status', true )
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_background_1',
	'label'       => __( 'Background Color 1', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_background_color_1', '#3a4cb4' ),
	'choices'     => [
		'alpha' => true,
	],
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_background_2',
	'label'       => __( 'Background Color 2', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_background_color_2', '#fd1d1d' ),
	'choices'     => [
		'alpha' => true,
	],
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_border_bottom_color',
	'label'       => __( 'Border Bottom Color', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_top_bar_border_bottom_color', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'body:not(.page-template-page-fullwidth-transparent-header) header#masthead #top-bar',
			'property' => 'border-bottom-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_icon_separator_color',
	'label'       => __( 'Social Icons Separator Color', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_top_bar_icon_separator_color', 'rgba(255,255,255,0.22)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '#top-social-left li:first-child a,#top-social-left li a',
			'property' => 'border-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_icon_color',
	'label'       => __( 'Social Icons Color', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => apply_filters( 'bizberg_top_bar_icon_color', '#fff' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '#top-social-left li a',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'top_bar_info_box_color',
	'label'       => __( 'Info Box Color', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => '#fff',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.infobox_header_wrapper li a, .infobox_header_wrapper li',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'top_bar_layout_width',
	'label'       => esc_html__( 'Width', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => '',
	'choices'     => [
		'100%' => esc_html__( 'Full Width', 'bizberg' ),
		'' => esc_html__( 'Content Width', 'bizberg' )
	],
	'output' => array(
		array(
			'element'  => '#top-bar .container',
			'property' => 'width',
		),
		array(
			'element'  => '#top-bar .container',
			'property' => 'max-width',
		)
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'top_header_status_mobile',
	'label'       => esc_html__( 'Enable Top Bar on Mobile', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => false,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'top_header_infobox_1',
	'label'       => esc_html__( 'Enable Infobox 1', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_fontawesome_1',
	'label'       => esc_html__( 'Icon 1', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => 'fas fa-mobile-alt',
	'description' => sprintf( 
		__( 'You can get icons from %s. eg. fas fa-mobile-alt', 'bizberg' ), 
		'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_1',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_text_1',
	'label'       => esc_html__( 'Label 1', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => '9849-xxx-xxx',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_1',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'partial_refresh' => array(
		'top_header_text_1' => array(
			'selector'        => '.infobox_header_wrapper',
			'render_callback' => 'bizberg_get_infobox_header',
		)
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'open_in_new_tab_1',
	'label'       => esc_html__( 'Open in a new tab ?', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_1',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'     => 'url',
	'settings' => 'infobox_link_1',
	'label'    => esc_html__( 'URL 1', 'bizberg' ),
	'section'  => 'top-header',
	'default'  => '',
	'description' => 'If not empty the infobox will be clickable.',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_1',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'top_header_infobox_2',
	'label'       => esc_html__( 'Enable Infobox 2', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_fontawesome_2',
	'label'       => esc_html__( 'Icon 2', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => 'far fa-comment-alt',
	'description' => sprintf( 
		__( 'You can get icons from %s. eg. far fa-comment-alt', 'bizberg' ), 
		'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_2',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_text_2',
	'label'       => esc_html__( 'Label 2', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => 'info@example.com',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_2',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'partial_refresh' => array(
		'top_header_text_2' => array(
			'selector'        => '.infobox_header_wrapper',
			'render_callback' => 'bizberg_get_infobox_header',
		)
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'open_in_new_tab_2',
	'label'       => esc_html__( 'Open in a new tab ?', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_2',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'     => 'url',
	'settings' => 'infobox_link_2',
	'label'    => esc_html__( 'URL 2', 'bizberg' ),
	'section'  => 'top-header',
	'default'  => '',
	'description' => 'If not empty the infobox will be clickable.',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_2',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'checkbox',
	'settings'    => 'top_header_infobox_3',
	'label'       => esc_html__( 'Enable Infobox 3', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_fontawesome_3',
	'label'       => esc_html__( 'Icon 3', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => 'fas fa-map-marker',
	'description' => sprintf( 
		__( 'You can get icons from %s. eg. fas fa-map-marker', 'bizberg' ), 
		'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_3',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'top_header_text_3',
	'label'       => esc_html__( 'Label 3', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => 'Tyagal, Patan, Lalitpur',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_3',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'partial_refresh' => array(
		'top_header_text_3' => array(
			'selector'        => '.infobox_header_wrapper',
			'render_callback' => 'bizberg_get_infobox_header',
		)
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'open_in_new_tab_3',
	'label'       => esc_html__( 'Open in a new tab ?', 'bizberg' ),
	'section'     => 'top-header',
	'default'     => true,
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_3',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'     => 'url',
	'settings' => 'infobox_link_3',
	'label'    => esc_html__( 'URL 3', 'bizberg' ),
	'section'  => 'top-header',
	'default'  => '',
	'description' => 'If not empty the infobox will be clickable.',
	'active_callback' => array(
		array(
			'setting'  => 'top_header_infobox_3',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	),
) );

/**
* Top Header Social Icons
*/

Kirki::add_field( 'bizberg', array(
	'type'        => 'repeater',
	'label'       => esc_html__( 'Social Links', 'bizberg' ),
	'section'     => 'top-header',
	'row_label' => array(
		'type' => 'text',
		'value' => esc_html__( 'Social Link', 'bizberg' ),
	),
	'settings'    => 'header_social_links',
	'fields' => array(
		'icon' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon', 'bizberg' ),
			'description' => sprintf( 
				__( 'You can get icons from %s', 'bizberg' ), 
				'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons' ) . '">here</a>' 
			),
			'default' => 'fab fa-facebook-f'
		),
		'link' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link', 'bizberg' ),
			'default' => '#'				
		),	
		'label' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Hover Label', 'bizberg' ),
			'default' => esc_html__( 'Facebook', 'bizberg' )		
		),	
		'backgroundColor' => array(
			'type'        => 'color',
			'label'       => esc_html__( 'Background Hover Color', 'bizberg' ),
			'default' => '#3b5998',
			'choices'     => array(
				'alpha' => true,
			),
		),	
		'target' => array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Open in a new tab ?', 'bizberg' ),
			'default'     => true		
		),		
	),
	'default'      => [
		[
			'icon' => 'fab fa-facebook-f',
			'link'  => '#',
			'label'  => esc_html__( 'Facebook', 'bizberg' ),
			'backgroundColor' => '#3b5998',
			'target' => true
		],
		[
			'icon' => 'fab fa-twitter',
			'link'  => '#',
			'label'  => esc_html__( 'Twitter', 'bizberg' ),
			'backgroundColor' => '#00acee',
			'target' => true
		],
		[
			'icon' => 'fab fa-instagram',
			'link'  => '#',
			'label'  => esc_html__( 'Instagram', 'bizberg' ),
			'backgroundColor' => '#ea3a7e',
			'target' => true
		],
		[
			'icon' => 'fab fa-youtube',
			'link'  => '#',
			'label'  => esc_html__( 'Youtube', 'bizberg' ),
			'backgroundColor' => '#cd201f',
			'target' => true
		],
	],
	'partial_refresh' => array(
		'header_social_links' => array(
			'selector'        => '.header_social_links',
			'render_callback' => 'bizberg_get_header_social_links',
		)
	),
	'active_callback' => array(
		array(
			'setting'  => 'top_header_status',
			'operator' => '==',
			'value'    => false,
		)
	)
) );
