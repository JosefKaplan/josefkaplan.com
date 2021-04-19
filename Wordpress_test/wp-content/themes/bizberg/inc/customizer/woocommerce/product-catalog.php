<?php

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'shop_page_widget_size',
	'label'       => esc_html__( 'Widget Size', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_page_widget_size', 'small' ),
	'choices'     => array(
		'none'   => esc_html__( 'No Widget', 'bizberg' ),
		'small'  => esc_html__( 'Small', 'bizberg' ),
		'big'    => esc_html__( 'Big', 'bizberg' )
	),
	'multiple'    => 1
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'shop_page_sidebar_position',
	'label'       => esc_html__( 'Sidebar Position', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_page_sidebar_position', 'left' ),
	'choices'     => array(
		'left'  => esc_html__( 'Left', 'bizberg' ),
		'right' => esc_html__( 'Right', 'bizberg' )
	),
	'multiple'    => 1,
	'active_callback' => [
		[
			'setting'  => 'shop_page_widget_size',
			'operator' => '!=',
			'value'    => 'none'
		]
	]
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'select',
	'settings'    => 'shop_page_column',
	'label'       => esc_html__( 'Column', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_page_column', '4' ),
	'choices'     => array(
		'5' => 5,
		'4' => 4,
		'3' => 3,
		'2' => 2
	),
	'multiple'    => 1
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'slider',
	'settings'    => 'category_product_description',
	'label'       => esc_html__( 'Category Product Description Limit', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_category_product_description', 15 ),
	'choices'     => [
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	],
] );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'woo_shop_breadcrumb_status',
	'label'       => esc_html__( 'Enable Breadcrumb ?', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_woo_shop_breadcrumb_status', true )
] );

Kirki::add_field( 'bizberg', array(
    'type'        => 'custom',
    'settings'    => 'woocommerce_product_catalog_colors',
    'section'     => 'woocommerce_product_catalog',
    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Color Options', 'bizberg' ) . '</div>',
) );

Kirki::add_field( 'bizberg', [
	'type'        => 'checkbox',
	'settings'    => 'woo_product_color_status',
	'label'       => esc_html__( 'Enable Custom Colors ?', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_woo_product_color_status', false )
] );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'shop_sale_tag_color',
	'label'       => esc_html__( 'Sale Tag Color', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_sale_tag_color', '#333' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_woocommerce_shop ul.products li.product .onsale, .bizberg_woocommerce_shop .woocommerce_single_page_wrapper span.onsale, .woocommerce #yith-quick-view-modal span.onsale',
			'property' => 'background'
		),
		array(
            'element'  => '.bizberg_woocommerce_shop ul.products li.product .onsale::after, .bizberg_woocommerce_shop .woocommerce_single_page_wrapper span.onsale::after',
            'property' => 'border-top-color',
            'sanitize_callback' => 'bizberg_sale_tag_border_color'
        )
	),
	'active_callback' => [
		[
			'setting'  => 'woo_product_color_status',
			'operator' => '==',
			'value'    => true
		]
	]
) );

function bizberg_sale_tag_border_color( $value ) {
  	return Kirki_Color::adjust_brightness( $value, -15 ); 
}

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'shop_quick_view_background',
	'label'       => esc_html__( 'Quick View Background', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_quick_view_background', '#f34f3f' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_woocommerce_shop ul.products li.product .yith-wcqv-button.button',
			'property' => 'background'
		),
		array(
            'element'  => '.bizberg_woocommerce_shop ul.products li.product .yith-wcqv-button.button::before',
            'property' => 'background',
            'sanitize_callback' => 'bizberg_sale_tag_border_color'
        )
	),
	'active_callback' => [
		[
			'setting'  => 'woo_product_color_status',
			'operator' => '==',
			'value'    => true
		]
	]
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'shop_price_color',
	'label'       => esc_html__( 'Price Color', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_price_color', '#f34f3f' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_woocommerce_shop ul.products li.product .price,.bizberg_woocommerce_shop .bizberg_header_mini_cart_wrapper ul.woocommerce-mini-cart li.woocommerce-mini-cart-item span.quantity,.header_sidemenu_in .woocommerce_cart_sidebar ul li span.quantity',
			'property' => 'color'
		)
	),
	'active_callback' => [
		[
			'setting'  => 'woo_product_color_status',
			'operator' => '==',
			'value'    => true
		]
	]
) );

Kirki::add_field( 'bizberg', array(
	'type'        => 'color',
	'settings'    => 'shop_add_to_cart_background',
	'label'       => esc_html__( 'Add to Cart Background', 'bizberg' ),
	'section'     => 'woocommerce_product_catalog',
	'default'     => apply_filters( 'bizberg_shop_add_to_cart_background', '#2d2d2d' ),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.bizberg_woocommerce_shop ul.products li.product .button, .bizberg_woocommerce_shop ul.products li.product a.added_to_cart',
			'property' => 'background'
		),
		array(
            'element'  => '.bizberg_woocommerce_shop ul.products li.product .button::before, .bizberg_woocommerce_shop ul.products li.product a.added_to_cart::before',
            'property' => 'background',
            'sanitize_callback' => 'bizberg_add_to_cart_border_color'
        )
	),
	'active_callback' => [
		[
			'setting'  => 'woo_product_color_status',
			'operator' => '==',
			'value'    => true
		]
	]
) );

function bizberg_add_to_cart_border_color( $value ) {
  	return Kirki_Color::adjust_brightness( $value, -15 ); 
}