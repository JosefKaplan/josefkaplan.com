<?php

Kirki::add_section( 'woocommerce_header', array(
    'title'          => esc_html__( 'Header', 'bizberg' ),
    'priority'       => 1,
    'panel'          => 'woocommerce',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'woocommerce_header_blank_content',
    'section'     => 'woocommerce_header',
    'default'     => '',
) );

Kirki::add_section( 'woocommerce_header_search', array(
    'title'          => esc_html__( 'WooCommerce Search', 'bizberg' ),
    'priority'       => 1,
    'section'          => 'woocommerce_header',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'header_woo_search_placeholder',
	'label'    => esc_html__( 'Placeholder Text', 'bizberg' ),
	'section'  => 'woocommerce_header_search',
	'default'  => esc_html__( 'Search for Product', 'bizberg' )
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'header_woo_search_dropdown_text',
	'label'    => esc_html__( 'Dropdown Text', 'bizberg' ),
	'section'  => 'woocommerce_header_search',
	'default'  => esc_html__( 'All Category', 'bizberg' )
] );

Kirki::add_section( 'woocommerce_account_menu', array(
    'title'          => esc_html__( 'WooCommerce Account Menu', 'bizberg' ),
    'section'        => 'woocommerce_header',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'woocommerce_account_parent_menu_not_logged_in',
	'label'       => esc_html__( 'Select parent menu ( For non logged in users )', 'bizberg' ),
	'section'     => 'woocommerce_account_menu',
	'multiple'    => 1,
	'choices'     => bizberg_get_all_pages()
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'woocommerce_account_parent_menu_not_logged_in_icon',
	'label'    => esc_html__( 'Icon ( For non logged in users )', 'bizberg' ),
	'section'  => 'woocommerce_account_menu',
	'default'  => 'far fa-user',
	'description' => sprintf( 
		__( 'You can get icons from %s', 'bizberg' ), 
		'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a> eg. <code>far fa-user</code>' 
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'select',
	'settings'    => 'woocommerce_account_parent_menu_logged_in',
	'label'       => esc_html__( 'Select parent menu ( For logged in users )', 'bizberg' ),
	'section'     => 'woocommerce_account_menu',
	'multiple'    => 1,
	'choices'     => bizberg_get_all_pages()
] );

Kirki::add_field( 'bizberg', [
	'type'     => 'text',
	'settings' => 'woocommerce_account_parent_menu_logged_in_icon',
	'label'    => esc_html__( 'Icon ( For logged in users )', 'bizberg' ),
	'section'  => 'woocommerce_account_menu',
	'default'  => 'far fa-user',
	'description' => sprintf( 
		__( 'You can get icons from %s', 'bizberg' ), 
		'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a> eg. <code>far fa-user</code>' 
	),
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Select Dropdown Pages', 'bizberg' ),
	'section'     => 'woocommerce_account_menu',
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Pages', 'bizberg' )
	],
	'settings'    => 'woocommerce_account_drop_down_menu_header',
	'fields' => [
		'page_id'  => [
			'type'        => 'select',
			'label'       => esc_html__( 'Page', 'bizberg' ),
			'description' => esc_html__( 'Select a page you want to display on the dropdown', 'bizberg' ),
			'choices'     => bizberg_get_all_pages()
		],
		'label' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Dropdown Title', 'bizberg' ),
			'description' => esc_html__( 'If empty, the selected page title will be displayed.', 'bizberg' ),
		],
		'url' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Link', 'bizberg' ),
			'description' => esc_html__( 'If empty, the selected page link will be displayed.', 'bizberg' ),
		],
		'icon' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Icon', 'bizberg' ),
			'description' => sprintf( 
				__( 'You can get icons from %s', 'bizberg' ), 
				'<a target="_blank" href="' . esc_url( 'https://fontawesome.com/icons/' ) . '">here</a>' 
			),
			'default' => 'fas fa-cog'
		],
	],
	'default'     => [
		[
			'page_id' => 0,
			'label'   => '',
			'url'     => '',
			'icon' => 'fas fa-cog'
		]
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'woocommerce_disable_logout_header_menu',
	'label'       => esc_html__( 'Disable logout link', 'bizberg' ),
	'section'     => 'woocommerce_account_menu',
	'default'     => false,
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'woocommerce_hide_logout_icon_header_menu',
	'label'       => esc_html__( 'Disable logout icon', 'bizberg' ),
	'section'     => 'woocommerce_account_menu',
	'default'     => false,
	'active_callback' => [
		[
			'setting'  => 'woocommerce_disable_logout_header_menu',
			'operator' => '==',
			'value'    => false,
		]
	],
] );