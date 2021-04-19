<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'general-settings',
	'label'       => esc_html__( 'Theme Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_theme_color', '#0088cc' ),
	'output'    => apply_filters( 'bizberg_theme_output_css', array(
		array(
			'element'  => 'a:focus',
			'property'      => 'outline',
			'value_pattern' => '1px dashed $'
		),
		array(
			'element'  => '.breadcrumb-wrapper .breadcrumb .active,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover,#blog .blog-post .entry-meta > span > a:hover, nav.comment-navigation a:hover,.bizberg_detail_user_wrapper a:hover,div#respond h3#reply-title small a, .sidebar-wrapper .section-title h3',
			'property' => 'color'
		),
		array(
			'element'  => '.widget_text.widget a',
			'property' => 'color',
			'value_pattern' => '$ !important'
		),
		array(
			'element'  => '.search-form input#searchsubmit,#back-to-top a,.btn-primary, a.btn-primary,.bizberg_woocommerce_shop #respond p.form-submit #submit, .reply a, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"],.result-paging-wrapper ul.paging li.active a, .result-paging-wrapper ul.paging li a:hover,  .widget.widget_tag_cloud a:hover, .tagcloud.tags a:hover,.bizberg_detail_cat:after,.full-screen-search .close,p.form-submit .submit',
			'property' => 'background'
		),
		array(
			'element'  => '.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, nav.comment-navigation a:hover,div#respond h3#reply-title small a',
			'property' => 'border-color'
		),
		array(
			'element'  => '.btn-primary, a.btn-primary, .bizberg_woocommerce_shop #respond p.form-submit #submit, .reply a,p.form-submit .submit, input.wpcf7-form-control.wpcf7-submit, form.post-password-form input[type="submit"]',
			'property' => 'border-color',
			'sanitize_callback' => 'bizberg_adjustBrightness',
			// 'suffix'   => ' !important'
		),
		array(
			'element'  => '.btn-primary:hover, a.btn-primary:hover, .bizberg_woocommerce_shop #respond p.form-submit #submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover,p.form-submit .submit:hover',
			'property' => 'background',
			'sanitize_callback' => 'bizberg_adjustBrightness',
		),
		array(
			'element'  => '.btn-primary:hover, a.btn-primary:hover, .bizberg_woocommerce_shop #respond p.form-submit #submit:hover, .reply a:hover, input.wpcf7-form-control.wpcf7-submit:hover, form.post-password-form input[type="submit"]:hover,.red-btn .btn-primary:hover, .error-section a:hover,p.form-submit .submit:hover',
			'property' => 'border-color',
		),
		array(
			'element'  => '.detail-content.single_page a, .bizberg-list .entry-content p a, .comment-list .comment-content a, .widget_text.widget a',
			'property' => 'text-decoration-color'
		),
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'theme_text_color',
	'label'       => esc_html__( 'Text Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_theme_text_color', '#64686d' ),
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_theme_text_color_output_css', array(
		array(
			'element'  => 'body',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color ( H1 - H6 )', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_heading_color' , '#64686d' ),
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_heading_color_output_css', array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,h3.blog-title,h2.comments-title',
			'property'      => 'color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.bizberg_default_page .single_page h3.blog-title:after',
			'property' => 'border-color',
		),
		array(
			'element' => 'div#respond h3#reply-title:after',
			'property' => 'background'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Link Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_link_color' , '#0088cc' ),
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_link_color_output_css', array(
		array(
			'element'  => 'a,#blog .blog-post.blog-large .entry-title a,#blog .blog-post .entry-meta > span > a,#blog .blog-post .entry-meta > span.bizberg_read_time,#blog .blog-post.blog-large .entry-date a,ul.comment-item li .comment-header > a,.comment-item .comment-time a,.bizberg_detail_user_wrapper a,.bizberg_detail_comment_count,.comment-navigation .nav-previous a, .comment-navigation .nav-next a, .post-navigation .nav-previous a, .post-navigation .nav-next a, .bizberg_post_date a,.header_sidemenu .mhead p:hover span',
			'property'      => 'color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '#blog .blog-post.blog-large .entry-date a:after, .comment-navigation .nav-previous a, .comment-navigation .nav-next a, .post-navigation .nav-previous a, .post-navigation .nav-next a',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.bizberg_post_date a:after',
			'property'      => 'background',
			'value_pattern' => '$'
		),
		array(
			'media_query'   => '@media (max-width: 1100px)',
			'element'       => '.header_sidemenu .mhead p',
			'property'      => 'background',
			'value_pattern' => '$'
		),
		array(
			'media_query'   => '@media (max-width: 1100px)',
			'element'       => '.header_sidemenu .mhead p span',
			'property'      => 'color',
			'value_pattern' => '$'
		),
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'link_color_hover',
	'label'       => esc_html__( 'Link Color ( Hover )', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_link_color_hover' , '#0088cc' ),
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_link_color_hover_output_css', array(
		array(
			'element'  => 'a:hover:not(.slider_btn):not(.wp-block-button__link),a:focus:not(.slider_btn),#blog .blog-post.blog-large .entry-title a:hover,#blog .blog-post .entry-meta > span > a:hover,#blog .blog-post .entry-meta > span.bizberg_read_time:hover,#blog .blog-post.blog-large .entry-date a:hover,ul.comment-item li .comment-header > a:hover,.comment-item .comment-time a:hover,.bizberg_detail_user_wrapper a:hover,.bizberg_detail_comment_count:hover,.comment-navigation .nav-previous a:hover,.comment-navigation .nav-next a:hover, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, #blog #sidebar.sidebar-wrapper .widget li:hover ,.bizberg_post_date a:hover',
			'property'      => 'color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '#blog .blog-post.blog-large .entry-date a:hover:after, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-next a:hover, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover',
			'property'      => 'border-color',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.bizberg_post_date a:hover:after',
			'property'      => 'background',
			'value_pattern' => '$'
		),
		array(
			'element'  => '.elementor-page a:hover,.elementor-page a:focus',
			'property'      => 'color',
			'value_pattern' => 'inherit'
		),
		array(
			'element'  => '#responsive-menu > li > a:focus',
			'property'      => 'color',
			'value_pattern' => '$'
		),
	) )
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'body_background_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Body Background', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'background',
	'settings'    => 'body_background_image',
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_body_background_image', [
		'background-color'      => 'rgba(255,255,255,0)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	] )
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'blog_listing_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Blog Listing Page Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_border',
	'label'       => esc_html__( 'Border Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_border', '#eee' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#blog .blog-post,.blog-nosidebar-1#blog .blog-post',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_background',
	'label'       => esc_html__( 'Background', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_background', 'rgba(255,255,255,0)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#blog .blog-post.bizberg-list',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_box_shadow', '#eee' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg-list:hover,.blog-nosidebar-1#blog .blog-post',
			'property'      => 'box-shadow',
			'value_pattern' => '0px 0px 15px $'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_meta_divider_color',
	'label'       => esc_html__( 'Meta Divider Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_meta_divider_color', '#eee' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#blog .blog-post .entry-meta',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_pagination_border',
	'label'       => esc_html__( 'Pagination Border Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_pagination_border', '#e2e0e0' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_blog_listing_pagination_border_output_css', array(
		array(
			'element'  => '.navigation.pagination a, .navigation.pagination span',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_pagination_text',
	'label'       => esc_html__( 'Pagination Text Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_pagination_text', '#636363' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_blog_listing_pagination_text_output_css', array(
		array(
			'element'  => '.navigation.pagination a, .navigation.pagination span',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_listing_pagination_active_hover_color',
	'label'       => esc_html__( 'Pagination Active / Hover Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_listing_pagination_active_hover_color', '#0088cc' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_blog_listing_pagination_active_hover_color_output_css', array(
		array(
			'element'  => '.navigation.pagination span.current,.navigation.pagination a:hover, .navigation.pagination span:hover',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'blog_detail_page_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Blog Detail Page Settings', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_content_border_color',
	'label'       => esc_html__( 'Content Border Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_content_border_color', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_cocntent_wrapper',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_content_background',
	'label'       => esc_html__( 'Content Background Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_content_background', 'rgba(255,255,255,0)' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_cocntent_wrapper',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_meta_divider_color',
	'label'       => esc_html__( 'Meta Divider Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_meta_divider_color', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_user_comment_wrapper',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_comment_divider_color',
	'label'       => esc_html__( 'Comment Divider Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_comment_divider_color', '#dedede' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => 'div#respond',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_comment_input_border_color',
	'label'       => esc_html__( 'Comment Input Border Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_comment_input_border_color', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#commentform textarea,#commentform input#url,#commentform input#email,#commentform input#author',
			'property'      => 'border-color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_comment_input_background_color',
	'label'       => esc_html__( 'Comment Input Background Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_comment_input_background_color', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#commentform textarea,#commentform input#url,#commentform input#email,#commentform input#author',
			'property'      => 'background',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'blog_detail_comment_input_text_color',
	'label'       => esc_html__( 'Comment Input Text Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_blog_detail_comment_input_text_color', '#000' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '#commentform textarea,#commentform input#url,#commentform input#email,#commentform input#author',
			'property'      => 'color',
			'value_pattern' => '$'
		)
	)
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'sidebar_widget_settings',
    'section'     => 'theme_colors',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Sidebar Widgets Settings', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'radio-buttonset',
	'settings'    => 'sidebar_spacing_status',
	'label'       => esc_html__( 'Outer Spacing', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_spacing_status', '20px' ),
	'choices'     => [
		'20px'   => esc_html__( 'Enable', 'bizberg' ),
		'0px'    => esc_html__( 'Disable', 'bizberg' )
	],
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '#sidebar .widget',
			'property' => 'padding'
		),
	),
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_link_color',
	'label'       => esc_html__( 'Link Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_link_color', '#64686d' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_link_color_output_css', array(
		array(
			'element'  => '#blog #sidebar.sidebar-wrapper .widget a, #blog #sidebar.sidebar-wrapper .widget li',
			'property'      => 'color'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_link_color_hover',
	'label'       => esc_html__( 'Link Color ( Hover )', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_link_color_hover', '#0088cc' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_link_color_hover_output_css', array(
		array(
			'element'  => ' #blog #sidebar.sidebar-wrapper .widget a:hover, #blog #sidebar.sidebar-wrapper .widget li:hover',
			'property'      => 'color'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_background_color',
	'label'       => esc_html__( 'Background Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_background_color', '#fbfbfb' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_background_color_output_css', array(
		array(
			'element'  => '#sidebar .widget',
			'property'      => 'background'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_border_color',
	'label'       => esc_html__( 'Border Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_border_color', '#f1f1f1' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_border_color_output_css', array(
		array(
			'element'  => '#sidebar .widget',
			'property'      => 'border-color'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_title_color',
	'label'       => esc_html__( 'Widget Title Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_title_color', '#0088cc' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_title_color_output_css', array(
		array(
			'element'  => '#sidebar .widget h2.widget-title',
			'property' => 'color'
		),
		array(
			'element'  => '#sidebar .widget h2.widget-title:before',
			'property' => 'background'
		),
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_link_separator',
	'label'       => esc_html__( 'Link Separator Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_link_separator', '#dbdbdb' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_link_separator_output_css', array(
		array(
			'element'  => '#sidebar .widget > ul > li',
			'property' => 'border-color'
		)
	) )
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'sidebar_widget_select_color',
	'label'       => esc_html__( 'Dropdown Text Color', 'bizberg' ),
	'section'     => 'theme_colors',
	'default'     => apply_filters( 'bizberg_sidebar_widget_select_color', '#64686d' ),
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
	'output'    => apply_filters( 'bizberg_sidebar_widget_select_color_output_css', array(
		array(
			'element'  => '#sidebar .widget select,.calendar_wrap tr, .calendar_wrap th, .calendar_wrap td',
			'property' => 'color'
		)
	) )
) );