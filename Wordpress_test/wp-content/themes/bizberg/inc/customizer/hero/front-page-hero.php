<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'slider_banner',
	'label'       => esc_html__( 'Background Type', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_banner_settings', 'banner' ),
	'choices'     => array(
		'banner'   => esc_html__( 'Banner', 'bizberg' ),
		'slider' => esc_html__( 'Slider', 'bizberg' ),
		'video' => esc_html__( 'Video', 'bizberg' ),
		'none' => esc_html__( 'None', 'bizberg' ),
	)
) );

/**
* Video
*/

Kirki::add_field( 'bizberg', [
    'type'            => 'upload',
    'settings'        => 'frontpage_video_url',
    'label'           => esc_html__('Video', 'bizberg'),
    'section'         => 'front_page_hero',
    'default'         => apply_filters( 'bizberg_frontpage_video_url', '' ),
    'active_callback' => array(
        array(
            'setting'  => 'slider_banner',
            'operator' => '==',
            'value'    => 'video'
        ),
    ),
]);

if( function_exists( 'bizberg_kirki_dtm_options' ) ){

    bizberg_kirki_dtm_options( 
        array(
            'display' => array(
                'desktop' => 'desktop',
                'tablet'  => 'tablet',
                'mobile'  => 'mobile'
            ),
            'field_id' => 'bizberg',
            'section'  => 'front_page_hero',
            'settings' => 'bizberg_frontpage_video_url_height',
            'global_active_callback'    => array(
                array(
                    'setting'  => 'slider_banner',
                    'operator' => '==',
                    'value'    => 'video'
                ),
                array(
		            'setting'  => 'frontpage_video_url',
		            'operator' => '!=',
		            'value'    => ''
		        )
            ),
            'fields'   => array(
                'slider' => array(
                    'desktop' => array(
                        'label' => esc_html__( 'Height', 'bizberg' ),
                        'settings' => 'bizberg_frontpage_video_url_height',
                        'default'     => 500,  
                        'choices'     => [
                            'min'  => 100,
                            'max'  => 1000,
                            'step' => 25,
                        ],
                        'transport' => 'auto',
                        'output' => array(
                            array(
                                'element'       => '.bizberg_frontpage_video_wrapper',
                                'property'      => 'height',
                                'value_pattern' => '$px'
                            )
                        ),
                    ),
                    'tablet' => array(
                        'label' => esc_html__( 'Height', 'bizberg' ),
                        'settings' => 'bizberg_frontpage_video_url_height',
                        'default'     => 500,  
                        'choices'     => [
                            'min'  => 100,
                            'max'  => 1000,
                            'step' => 25,
                        ],
                        'transport' => 'auto',
                        'output' => array(
                            array(
                                'element'       => '.bizberg_frontpage_video_wrapper',
                                'property'      => 'height',
                                'value_pattern' => '$px',
                                'media_query'   => '@media (min-width: 481px) and (max-width: 1024px)'
                            )
                        ),
                    ),
                    'mobile' => array(
                        'label' => esc_html__( 'Height', 'bizberg' ),
                        'settings' => 'bizberg_frontpage_video_url_height',
                        'default'     => 500, 
                        'choices'     => [
                            'min'  => 100,
                            'max'  => 1000,
                            'step' => 25,
                        ],
                        'transport' => 'auto',
                        'output' => array(
                            array(
                                'element'       => '.bizberg_frontpage_video_wrapper',
                                'property'      => 'height',
                                'value_pattern' => '$px',
                                'media_query'   => '@media (min-width: 320px) and (max-width: 480px)'
                            )
                        ),
                    )
                ),
            )
            
        ) 
    );

}

Kirki::add_field( 'bizberg', [
    'type'     => 'radio-image',
    'settings' => 'frontpage_video_gradient_presets',
    'label'    => esc_html__('Choose Gradient Presets', 'bizberg'),
    'section'  => 'front_page_hero',
    'default'  => 'linear-gradient(200deg, #00c9ad 0%, #00b8c6 50%, #00a3da 100%)',
    'choices'  => [
        'linear-gradient(212deg, #667eea 0%, #9866ea 82%, #764ba2 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-1.jpg',
        'linear-gradient(200deg, #00c9ad 0%, #00b8c6 50%, #00a3da 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-2.jpg',
        'linear-gradient(25deg, #6b347e 0%, #1182a4 40%, #2cc389 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-3.jpg',
        'linear-gradient(25deg, #f093fb 0%, #f279be 40%, #f5576c 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-4.jpg',
        'linear-gradient(25deg, #43e97b 0%, #3df1a9 40%, #38f9d7 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-5.jpg',
        'linear-gradient(25deg, #f6d365 0%, #f9bb74 50%, #fda085 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-6.jpg',
        'linear-gradient(25deg, #f44336 0%, #dc336e 50%, #a9458f 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-7.jpg',
        'linear-gradient(62deg, #f9f871 0%, #ace987 50%, #6ed39f 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-8.jpg',
        'linear-gradient(182deg, #b7a6b5 0%, #deabbc 50%, #ffb1b0 100%)'  => get_template_directory_uri() . '/assets/images/gradient-preset-9.jpg',
        'linear-gradient(117deg, #ffcc95 0%, #ee9661 50%, #b26231 100%)' => get_template_directory_uri() . '/assets/images/gradient-preset-10.jpg',
    ],
    'transport' => 'auto',
    'output' => array(
        array(
            'element'       => '.bizberg_gradient_video',
            'property'      => 'background',
            'value_pattern' => '$'
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'slider_banner',
            'operator' => '==',
            'value'    => 'video'
        ),
        array(
            'setting'  => 'frontpage_video_url',
            'operator' => '!=',
            'value'    => ''
        ),
    )
]);

Kirki::add_field( 'bizberg', [
    'type'            => 'select',
    'settings'        => 'frontpage_video_gradient_presets_opacity',
    'label'           => esc_html__('Gradient Opacity', 'bizberg'),
    'section'         => 'front_page_hero',
    'default'         => '0.5',
    'choices'         => [
        '0'   => '0',
        '0.1' => '0.1',
        '0.2' => '0.2',
        '0.3' => '0.3',
        '0.4' => '0.4',
        '0.5' => '0.5',
        '0.6' => '0.6',
        '0.7' => '0.7',
        '0.8' => '0.8',
        '0.9' => '0.9',
    ],
    'transport'       => 'auto',
    'active_callback' => array(
        array(
            'setting'  => 'slider_banner',
            'operator' => '==',
            'value'    => 'video',
        ),
        array(
            'setting'  => 'frontpage_video_url',
            'operator' => '!=',
            'value'    => ''
        ),
    ),
    'output'          => array(
        array(
            'element'  => '.bizberg_gradient_video',
            'property' => 'opacity',
        ),
    ),
]);

/**
* Banner
*/

Kirki::add_field( 'bizberg', array(
	'type'        => 'text',
	'settings'    => 'banner_title',
	'label'       => esc_html__( 'Title', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_title', esc_attr__( 'Blog', 'bizberg' ) ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'partial_refresh' => array(
		'banner_title' => array(
			'selector'        => '.banner_title',
			'render_callback' => 'bizberg_get_banner_title',
		)
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'banner_title_color',
	'label'       => __( 'Title Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_title_color', '#fff' ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.homepage_banner h1.banner_title',
			'property' => 'color',
		),
	)
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'textarea',
	'settings'    => 'banner_subtitle',
	'label'       => esc_html__( 'Subtitle', 'bizberg' ),
	'default'     => apply_filters( 'bizberg_banner_subtitle', esc_attr__( "Lorem Ipsum has been the industry's standard dummy", 'bizberg' ) ),
	'section'     => 'front_page_hero',
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'partial_refresh' => array(
		'banner_subtitle' => array(
			'selector'        => '.banner_subtitle',
			'render_callback' => 'bizberg_get_banner_subtitle',
		)
	),
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'banner_subtitle_color',
	'label'       => __( 'Subtitle Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_subtitle_color', '#fff' ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.homepage_banner p.banner_subtitle',
			'property' => 'color',
		),
	)
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'banner_text_position',
	'label'       => esc_html__( 'Text Position', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_text_position', 'left' ),
	'choices'     => [
		'left'   => esc_html__( 'Left', 'bizberg' ),
		'center' => esc_html__( 'Center', 'bizberg' ),
		'right'  => esc_html__( 'Right', 'bizberg' ),
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper .section-title',
			'function' => 'css',
			'property' => 'text-align'
		]
	]
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'dimensions',
	'settings'    => 'banner_spacing',
	'label'       => esc_html__( 'Spacing', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_spacing', [
		'padding-top'    => '65px',
		'padding-bottom' => '65px',
		'padding-left'   => '0px',
		'padding-right'  => '0px',
	]),
	'choices'     => [
		'labels' => [
			'padding-top'  => esc_html__( 'Top', 'bizberg' ),
			'padding-bottom'  => esc_html__( 'Bottom', 'bizberg' ),
			'padding-left' => esc_html__( 'Left', 'bizberg' ),
			'padding-right' => esc_html__( 'Right', 'bizberg' ),
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element'  => '.breadcrumb-wrapper .section-title',
			'function' => 'css'
		]
	]
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'banner_image_options',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Banner Image Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'banner_image',
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_banner_image', [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => get_template_directory_uri() . '/assets/images/breadcrum.jpg',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	]),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'banner',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio',
	'settings'    => 'slider_cat_pages',
	'label'       => esc_html__( 'Slider Type', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => 'category',
	'choices'     => [
		'category'   => esc_html__( 'From Category', 'bizberg' ),
		'page' => esc_html__( 'From Pages', 'bizberg' )
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

/**
* Slider Category
*/

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'slider_category',
	'label'       => esc_html__( 'Select Slider Category', 'bizberg' ),
	'description' => sprintf(
		esc_html__( 
			'In free version, only 2 slides will be displayed. %s', 
			'bizberg' 
		),
		'<a target="_blank" href="' . esc_url( bizberg_get_pro_link() ) . '">' . esc_html__( 'Upgrade to PRO', 'bizberg' ) . '</a>'
	),
	'section'     => 'front_page_hero',
	'multiple'    => 1,
	'choices'     => bizberg_get_post_categories(),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_cat_pages',
			'operator' => '==',
			'value'    => 'category',
		),
	),
) );

/**
* Slider Page
*/

Kirki::add_field( 'bizberg', [
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Select Slider Pages', 'bizberg' ),
	'description' => sprintf(
		esc_html__( 
			'In free version, only 2 slides will be displayed. %s', 
			'bizberg' 
		),
		'<a target="_blank" href="' . esc_url( bizberg_get_pro_link() ) . '">' . esc_html__( 'Upgrade to PRO', 'bizberg' ) . '</a>'
	),
	'section'     => 'front_page_hero',
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Pages', 'bizberg' )
	],
	'settings'    => 'slider_pages',
	'fields' => [
		'page_id'  => [
			'type'        => 'select',
			'label'       => esc_html__( 'Page', 'bizberg' ),
			'description' => esc_html__( 'Select a page you want to display on the slider', 'bizberg' ),
			'choices'  => bizberg_get_all_pages()
		],
		'read_more_link' => [
			'type'        => 'text',
			'label'       => esc_attr__( 'Read More Link', 'bizberg' ),
			'description' => esc_attr__( 'If left blank, it will take the page link.', 'bizberg' ),
		],
	],
	'default'     => [
		[
			'page_id' => 0,
			'read_more_link' => ''
		]
	],
	'choices' => [
		'limit' => 2
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_cat_pages',
			'operator' => '==',
			'value'    => 'page',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_content_length',
	'label'       => esc_html__( 'Content Length', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => 50,
	'choices'     => [
		'min'  => 5,
		'max'  => 50,
		'step' => 1,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'zoom_in_out_status',
	'label'       => esc_html__( 'Disable Zoom In Out Effect ?', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => 'none',
	'choices'     => [
		'none'   => esc_html__( 'Disable', 'bizberg' ),
		'kbrns_zoomInOut 15s linear 0s infinite alternate' => esc_html__( 'Enable', 'bizberg' ),
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
	'output' => array(
		array(
			'element'  => '.banner .slider .slide-inner .slide-image',
			'property' => 'animation',
			'value_pattern' => '$'
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'slider_loop_status',
	'label'       => esc_html__( 'Enable Loop ?', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => true,
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'slider_grab_n_slider',
	'label'       => esc_html__( 'Grab Cursor & Slider ?', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => true,
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_speed',
	'label'       => esc_html__( 'Slide Speed ( Second )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => 3,
	'choices'     => [
		'min'  => 1,
		'max'  => 10,
		'step' => 1,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'autoplay_delay',
	'label'       => esc_html__( 'Autoplay Delay ( Second )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => 6,
	'choices'     => [
		'min'  => 1,
		'max'  => 10,
		'step' => 1,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'slider_text_align',
	'label'       => esc_html__( 'Text Align', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_text_align', 'left' ),
	'choices'     => [
		'left'   => esc_html__( 'Left', 'bizberg' ),
		'center' => esc_html__( 'Center', 'bizberg' ),
		'right'  => esc_html__( 'Right', 'bizberg' ),
	],
	'output' => array(
		array(
			'element'  => '.banner .slider .swiper-content,.banner > .slider .swiper-pagination',
			'property' => 'text-align',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'slider_title_options',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Title Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'slider_title_font_desktop_tablet',
	'label'       => esc_html__( 'Title Font ( Desktop / Tablet )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_title_font_desktop_tablet', [
		'font-family'    => 'Playfair Display',
		'variant'        => 'regular',
		'font-size'      => '44px',
		'line-height'    => '1.2',
		'letter-spacing' => '0',
		'color'          => '#fff',
		'text-transform' => 'none',
	]),
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.banner .slider .swiper-content h1'
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'slider_title_font_mobile',
	'label'       => esc_html__( 'Title Font ( Mobile )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => [
		'variant'        => '700',
		'font-size'      => '30px',
		'line-height'    => '1.2',
		'letter-spacing' => '0',
		'color'          => '#fff',
		'text-transform' => 'none',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.banner .slider .swiper-content h1',
			'media_query' => '@media (min-width: 0px) and (max-width: 480px)',
			'suffix' => ' !important'
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'slider_title_layout',
	'label'       => esc_html__( 'Layout', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_title_layout', '2' ),
	'choices'     => [
		'1' => 'Default',
		'2' => 2,
		'3' => 3,
		'4' => 4,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'slider_title_box_highlight_color',
	'label'       => __( 'Highlight Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_title_box_highlight_color', '#0088cc' ),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.slider_title_layout_2:before',
			'property' => 'background',
			'suffix' => ' !important'
		),
		array(
			'element'  => '.slider_title_layout_3 .firstword,.slider_title_layout_4 .lastword',
			'property' => 'color'
		),
	),
	'active_callback' => [
		[
			'setting'  => 'slider_title_layout',
			'operator' => '!=',
			'value'    => 1,
		],
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'paginations_options',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Paginations Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'slider_arrow_background_color',
	'label'       => __( 'Arrow Hover Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     =>  apply_filters( 'bizberg_slider_arrow_background_color', '#0088cc' ),
	'output' => array(
		array(
			'element'  => '.banner .slider .swiper-button-prev:hover, .banner .slider .swiper-button-next:hover',
			'property' => 'background',
			'value_pattern' => '$'
		)
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'slider_dot_active_color',
	'label'       => __( 'Dot Active Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_dot_active_color', '#0088cc' ),
	'output' => array(
		array(
			'element'  => '.banner .slider .swiper-pagination-bullet-active',
			'property' => 'background',
			'value_pattern' => '$'
		)
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'arrow_style',
	'label'       => esc_html__( 'Style', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_arrow_style', 'circle' ),
	'multiple'    => 1,
	'choices'     => [
		'circle' => esc_html__( 'Circle', 'bizberg' ),
		'square' => esc_html__( 'Square', 'bizberg' ),
		'diamond' => esc_html__( 'Diamond', 'bizberg' )	
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'arrow_size',
	'label'       => esc_html__( 'Size', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_arrow_size', 40 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.banner .slider .swiper-button-next,.banner .slider .swiper-button-prev',
			'property' => 'height',
			'value_pattern' => '$px'
		),
		array(
			'element'  => '.banner .slider .swiper-button-next,.banner .slider .swiper-button-prev',
			'property' => 'width',
			'value_pattern' => '$px'
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'opacity_slider',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Opacity Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'slider_gradient_primary_color',
	'label'       => __( 'Gradient Primary Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_gradient_primary_color', 'rgba(0,136,204,0.6)' ),
	'choices'     => [
		'alpha' => true,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'slider_gradient_secondary_color',
	'label'       => __( 'Gradient Secondary Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_gradient_secondary_color', 'rgba(0,12,20,0.36)' ),
	'choices'     => [
		'alpha' => true,
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'read_more_section_title',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Read More Options', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'toggle',
	'settings'    => 'slider_read_more_status',
	'label'       => esc_html__( 'Disable read more?', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => false,
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'slider_read_more_text',
	'label'    => esc_html__( 'Read More Text', 'bizberg' ),
	'section'  => 'front_page_hero',
	'default'  => esc_html__( 'Read More', 'bizberg' ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'partial_refresh'    => [
		'slider_btn_text_wrapper' => [
			'selector'        => '.slider_btn_text_wrapper',
			'render_callback' => 'bizberg_get_slider_read_more_btn',
		],
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'typography',
	'settings'    => 'slider_read_more_font',
	'label'       => esc_html__( 'Font', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_read_more_font', [
		'font-family'    => 'Lato',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '1.2',
		'letter-spacing' => '1',
		'color'          => '#fff',
		'text-transform' => 'uppercase'
	]),
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'a.slider_btn'
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'read_more_background_color',
	'label'       => __( 'Background Color 1', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_read_more_background_color', '#0088cc' ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'read_more_background_color_2',
	'label'       => __( 'Background Color 2', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_read_more_background_color_2', '#0088cc' ),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	)
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'dimensions',
	'settings'    => 'slider_btn_border_radius',
	'label'       => esc_html__( 'Border Radius', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 
		'bizberg_slider_btn_border_radius', 
		[
			'border-top-left-radius'  => '0px',
			'border-top-right-radius'  => '0px',
			'border-bottom-right-radius' => '0px',
			'border-bottom-left-radius' => '0px',
		] 
	),
	'choices'     => [
		'labels' => [
			'border-top-left-radius'  => esc_html__( 'Top Left Radius', 'bizberg' ),
			'border-top-right-radius'  => esc_html__( 'Top Right Radius', 'bizberg' ),
			'border-bottom-right-radius' => esc_html__( 'Bottom Right Radius', 'bizberg' ),
			'border-bottom-left-radius' => esc_html__( 'Bottom Left Radius', 'bizberg' ),
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'a.slider_btn'
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'dimensions',
	'settings'    => 'slider_btn_padding',
	'label'       => esc_html__( 'Padding', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_btn_padding', [
		'top'  => '12px',
		'bottom'  => '12px',
		'left' => '20px',
		'right' => '20px',
	]),
	'choices'     => [
		'labels' => [
			'top'  => esc_html__( 'Top', 'bizberg' ),
			'bottom'  => esc_html__( 'Bottom', 'bizberg' ),
			'left' => esc_html__( 'Left', 'bizberg' ),
			'right' => esc_html__( 'Right', 'bizberg' ),
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'a.slider_btn',
			'property' => 'padding'
		)
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'color',
	'settings'    => 'read_more_border_color',
	'label'       => __( 'Border Color', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_read_more_border_color', '#026191' ),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => 'a.slider_btn',
			'property' => 'border-color',
			'value_pattern' => '$ !important'
		)
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'dimensions',
	'settings'    => 'read_more_border_dimensions',
	'label'       => esc_html__( 'Border Width', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 
		'bizberg_read_more_border_dimensions', 
		array(
			'top-width'  => '0px',
			'bottom-width'  => '0px',
			'left-width' => '0px',
			'right-width' => '0px',
		) 
	),
	'choices'     => array(
		'labels' => array(
			'top-width'  => esc_html__( 'Top', 'bizberg' ),
			'bottom-width'  => esc_html__( 'Bottom', 'bizberg' ),
			'left-width' => esc_html__( 'Left', 'bizberg' ),
			'right-width' => esc_html__( 'Right', 'bizberg' ),
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
		array(
			'setting'  => 'slider_read_more_status',
			'operator' => '==',
			'value'    => false,
		)
	),
	'output'    => array(
		array(
			'property' => 'border',
			'element'  => 'a.slider_btn',
			// 'suffix'   => ' !important'
		),
	)
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'slider_height',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Height', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_height_monitor',
	'label'       => esc_html__( 'Monitor ( 1400px > )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_height_monitor', 800 ),
	'choices'     => [
		'min'  => 400,
		'max'  => 1000,
		'step' => 10,
	],
	'output'      => [
		[
			'element' => '.banner > .slider',
			'property' => 'height',
			'value_pattern' => '$px'
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_height_desktop',
	'label'       => esc_html__( 'Laptop ( 1025px - 1400px )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_height_desktop', 600 ),
	'choices'     => [
		'min'  => 400,
		'max'  => 1000,
		'step' => 10,
	],
	'output'      => [
		[
			'element' => '.banner > .slider',
			'property' => 'height',
			'value_pattern' => '$px',
			'media_query' => '@media (min-width: 1025px) and (max-width: 1400px)'
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_height_tablet',
	'label'       => esc_html__( 'Tablet ( 481px - 1024px )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_height_tablet', 700 ),
	'choices'     => [
		'min'  => 400,
		'max'  => 1000,
		'step' => 10,
	],
	'output'      => [
		[
			'element' => '.banner > .slider',
			'property' => 'height',
			'value_pattern' => '$px',
			'media_query' => '@media (min-width: 481px) and (max-width: 1024px)',
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'slider_height_mobile',
	'label'       => esc_html__( 'Mobile ( 320px - 480px )', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_slider_height_mobile', 550 ),
	'choices'     => [
		'min'  => 400,
		'max'  => 1000,
		'step' => 10,
	],
	'output'      => [
		[
			'element' => '.banner > .slider',
			'property' => 'height',
			'value_pattern' => '$px',
			'media_query' => '@media (min-width: 320px) and (max-width: 480px)',
		],
	],
	'active_callback'    => array(
		array(
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		),
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'custom',
	'settings'    => 'slider_shape_divider',
	'section'     => 'front_page_hero',
	'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Shape Divider', 'bizberg' ) . '</div>'
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'shape_divider_bottom',
	'label'       => esc_html__( 'Bottom Shape Divider', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => apply_filters( 'bizberg_shape_divider_bottom', '10.png' ),
	'choices'     => [
		'none' => esc_html__( 'None', 'bizberg' ),
		'1.png' => 1,
		'2.png' => 2,
		'3.png' => 3,
		'4.png' => 4,
		'5.png' => 5,
		'6.png' => 6,
		'7.png' => 7,
		'8.png' => 8,
		'9.png' => 9,
		'10.png' => 10,
		'11.png' => 11,
		'12.png' => 12,
		'13.png' => 13,
		'14.png' => 14,
		'15.png' => 15,
		'16.png' => 16,
		'17.png' => 17,
		'18.png' => 18,
	],
	'partial_refresh'    => [
		'bizberg_shape_divider_slider_homepage_wrapper' => [
			'selector'        => '.bizberg_shape_divider_slider_homepage_wrapper',
			'render_callback' => 'bizberg_get_shape_divider',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'shape_divider_flip_horizontal',
	'label'       => esc_html__( 'Flip Horizontal', 'bizberg' ),
	'section'     => 'front_page_hero',
	'default'     => true,
	'partial_refresh'    => [
		'shape_divider_flip_horizontal' => [
			'selector'        => '.bizberg_shape_divider_slider_homepage_wrapper',
			'render_callback' => 'bizberg_get_shape_divider',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'slider_banner',
			'operator' => '==',
			'value'    => 'slider',
		],
		[
			'setting'  => 'shape_divider_bottom',
			'operator' => '!=',
			'value'    => 'none',
		]
	],
] );