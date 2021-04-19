<?php

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'blank_content',
    'section'     => 'typography',
    'default'     => '',
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'body_content_typo',
    'section'     => 'base-typography',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Body & Content', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'body_content_typo_status',
	'label'       => esc_html__( 'Enable / Disable', 'bizberg' ),
	'description' => esc_html__( 'Tick to enable custom font', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_body_content_typo_status', false ),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'typography_body_content',
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_typography_body_content', [
		'font-family'    => 'Open Sans',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '1.8'
	]),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'body,#blog .blog-post .entry-meta > span > a,#blog .blog-post.blog-large .entry-date a,#sidebar.sidebar-wrapper a,#footer ul.inline-menu > li a,#footer p.copyright,#footer .copyright a,.result-paging-wrapper ul.paging li a, .navigation.pagination a, .navigation.pagination span,.breadcrumb-wrapper.not-home li a,.breadcrumb li .active,.comment-navigation .nav-previous a, .comment-navigation .nav-next a, .post-navigation .nav-previous a, .post-navigation .nav-next a,ul.comment-item li .comment-header > a,.edit_repy_links a,#respond .logged-in-as a,.comments-area label,#respond form input,#respond .comment-form-comment textarea,#cancel-comment-reply-link,.detail-content.single_page p, .comment-content p,p.banner_subtitle, .swiper-content p, .bizberg_detail_cat,.bizberg_detail_user_wrapper a, .bizberg_detail_comment_count, .tag-cloud-heading, .single_page .tagcloud.tags a, .full-screen-search input[type="text"].search-field,.detail-content.single_page ul, .comment-content ul,.bizberg_default_page ul,.bizberg_default_page li,.bizberg_read_time',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'body_content_typo_status',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'base_typography_header_site_title_font_options',
    'section'     => 'base-typography',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Header Site Title Font Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'site_title_font',
	'label'       => esc_html__( 'Site Title Font Options', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_site_title_font', [
		'font-family'    => 'Playfair Display',
		'variant'        => 'regular',
		'font-size'      => '23px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
	]),
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 h3,.bizberg_header_wrapper h3',
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_title_font_tablet',
	'label'       => esc_html__( 'Site Title Font Size ( Tablet )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => 23,
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 h3,.bizberg_header_wrapper h3',
			'media_query' => '@media (min-width: 481px) and (max-width: 1024px)',
			'property' => 'font-size',
			'value_pattern' => '$px !important'
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_title_font_mobile',
	'label'       => esc_html__( 'Site Title Font Size ( Mobile )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => 23,
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 h3,.bizberg_header_wrapper h3',
			'media_query' => '@media (min-width: 320px) and (max-width: 480px)',
			'property' => 'font-size',
			'value_pattern' => '$px !important'
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_title_font_sticky_menu',
	'label'       => esc_html__( 'Site Title Font Size ( Sticky Desktop )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_site_title_font_sticky_menu', 23 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.sticky .bizberg_header_wrapper h3',
			'media_query' => '@media only screen and (min-width: 1025px)',
			'property' => 'font-size',
			'value_pattern' => '$px'
		],
	],
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'base_typography_site_tagline_font_options',
    'section'     => 'base-typography',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Header Site Tagline Font Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'site_tagline_font',
	'label'       => esc_html__( 'Tagline Font Options', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_site_tagline_font', [
		'font-family'    => 'Open Sans',
		'variant'        => '300',
		'font-size'      => '13px',
		'line-height'    => '1.8',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'text-align'     => 'left',
	]),
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 p,.bizberg_header_wrapper p',
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_tagline_font_tablet',
	'label'       => esc_html__( 'Site Tagline Font Size ( Tablet )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => 13,
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 p,.bizberg_header_wrapper p',
			'media_query' => '@media (min-width: 481px) and (max-width: 1024px)',
			'property' => 'font-size',
			'value_pattern' => '$px !important'
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_tagline_font_mobile',
	'label'       => esc_html__( 'Site Tagline Font Size ( Mobile )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => 13,
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.primary_header_2 p,.bizberg_header_wrapper p',
			'media_query' => '@media (min-width: 320px) and (max-width: 480px)',
			'property' => 'font-size',
			'value_pattern' => '$px !important'
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'site_tagline_font_sticky_menu',
	'label'       => esc_html__( 'Site Tagline Font Size ( Sticky Desktop )', 'bizberg' ),
	'section'     => 'base-typography',
	'default'     => apply_filters( 'bizberg_site_tagline_font_sticky_menu', 13 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 80,
		'step' => 1,
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.sticky .bizberg_header_wrapper p',
			'media_query' => '@media only screen and (min-width: 1025px)',
			'property' => 'font-size',
			'value_pattern' => '$px'
		],
	],
] );