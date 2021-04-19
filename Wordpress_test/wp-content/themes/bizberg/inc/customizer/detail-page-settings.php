<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_img_position',
	'label'       => esc_html__( 'Image Position', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'left',
	'choices'     => array(
		'left'   => esc_html__( 'Left', 'bizberg' ),
		'center' => esc_html__( 'Center', 'bizberg' )
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_post_date',
	'label'       => esc_html__( 'Post Date', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'show',
	'choices'     => array(
		'show' => esc_html__( 'Show', 'bizberg' ),
		'hide' => esc_html__( 'Hide', 'bizberg' )
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_author_link',
	'label'       => esc_html__( 'Author Link', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'show',
	'choices'     => array(
		'show' => esc_html__( 'Show', 'bizberg' ),
		'hide' => esc_html__( 'Hide', 'bizberg' )
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_comment_stats',
	'label'       => esc_html__( 'Comment Stats', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'show',
	'choices'     => array(
		'show' => esc_html__( 'Show', 'bizberg' ),
		'hide' => esc_html__( 'Hide', 'bizberg' )
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_category',
	'label'       => esc_html__( 'Category', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'show',
	'choices'     => array(
		'show' => esc_html__( 'Show', 'bizberg' ),
		'hide' => esc_html__( 'Hide', 'bizberg' )
	),
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_tags',
	'label'       => esc_html__( 'Tags', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'flex',
	'choices'     => array(
		'flex' => esc_html__( 'Show', 'bizberg' ),
		'none' => esc_html__( 'Hide', 'bizberg' )
	),
	'output' => array(
		array(
			'element'  => '.tag-cloud-wrapper',
			'property' => 'display',
		),
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'detail_page_sidebar',
	'label'       => esc_html__( 'Sidebar', 'bizberg' ),
	'section'     => 'detail_page',
	'default'     => 'left',
	'choices'     => array(
		'left' => esc_html__( 'Right', 'bizberg' ),
		'right' => esc_html__( 'Left', 'bizberg' )
	),
	'transport' => 'postMessage',
    'js_vars'   => array(
		array(
			'element'  => '.blog-detail-page .content-wrapper,.bizberg_default_page .content-wrapper',
			'function' => 'css',
			'property' => 'float',
		),
	),
	'output' => array(
		array(
			'element'  => '.blog-detail-page .content-wrapper,.bizberg_default_page .content-wrapper',
			'property' => 'float',
		),
	)
) );