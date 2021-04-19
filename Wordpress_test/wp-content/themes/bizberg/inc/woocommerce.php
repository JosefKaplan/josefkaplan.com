<?php

/**
* Enqueue WooCommerce Styles & Scripts
*/

add_action( 'wp_enqueue_scripts', 'bizberg_woocommerce_scripts' );
function bizberg_woocommerce_scripts(){
	$my_theme = wp_get_theme();
	$current_version = $my_theme->get( 'Version' ); // Get theme Current Version
	wp_enqueue_style( 'bizberg-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' , array(), $current_version );
	wp_enqueue_script( 'bizberg-woocommerce-scripts', get_template_directory_uri() . '/inc/woocommerce/woocommerce.js', array('jquery'), $current_version, true );
}

/**
* Register Sidebar
*/

add_action( 'widgets_init', 'bizberg_register_woocommerce_widgets' );
function bizberg_register_woocommerce_widgets() {
	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Shop/Category Sidebar', 'bizberg' ),
		'id'            => 'woocommerce-shop-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/**
* Add support for WooCommerce
*/

add_action( 'after_setup_theme', 'bizberg_woocommerce_setup' );
function bizberg_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/**
* Remove WooCommerce Sidebars
*/
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar', 10 );

/**
* Remove Rating on product category page
*/
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 15 );

add_action( 'woocommerce_before_main_content', 'bizberg_add_div_wrapper_before' );
function bizberg_add_div_wrapper_before(){

	$widget_size = bizberg_get_theme_mod( 'shop_page_widget_size' );
	$sidebar_position = bizberg_get_theme_mod( 'shop_page_sidebar_position' );

	if( is_product() ){

		echo '<div class="container">
		<div class="row">
		<div class="col-sm-12">
		<div class="woocommerce_single_page_wrapper">';

	} elseif( is_product_category() || is_shop() || is_product_tag() ){

		echo '<div class="container">
		<div class="row">
		<div class="two-tone-layout">';

		if( is_active_sidebar( 'woocommerce-shop-sidebar' ) ){

			switch ( $widget_size ) {

				case 'small':
					echo '<div class="col-md-9 col-sm-12 col-xs-12 content-wrapper ' . esc_attr( $sidebar_position ) . '" id="content">';
					break;

				case 'big':
					echo '<div class="col-md-8 col-sm-12 col-xs-12 content-wrapper ' . esc_attr( $sidebar_position ) . '" id="content">';
					break;
				
				default:
					echo '<div class="col-sm-12 col-xs-12 content-wrapper" id="content">';
					break;
			}

		} else {

			echo '<div class="col-sm-12 col-xs-12 content-wrapper" id="content">';

		}
		
	}
		
}

add_action( 'woocommerce_after_main_content', 'bizberg_add_div_wrapper_end' , 5 );
function bizberg_add_div_wrapper_end(){

	$widget_size = bizberg_get_theme_mod( 'shop_page_widget_size' );

	if( is_product() ){

		echo '</div>
		</div>
		</div>
		</div>';
		
	} elseif( is_product_category() || is_shop() || is_product_tag() ){

		echo '</div>';

		if( is_active_sidebar( 'woocommerce-shop-sidebar' ) ){

			switch ( $widget_size ) {

				case 'small':
					echo '<div class="col-md-3 col-sm-12">';
					echo '<div id="sidebar" class="sidebar-wrapper">';
					dynamic_sidebar( 'woocommerce-shop-sidebar' );
					echo'</div>';
					echo'</div>';
					break;

				case 'big':
					echo '<div class="col-md-4 col-sm-12">';
					echo '<div id="sidebar" class="sidebar-wrapper">';
					dynamic_sidebar( 'woocommerce-shop-sidebar' );
					echo'</div>';
					echo'</div>';
					break;
				
				default:
					break;
			}

		}

		echo '</div></div></div>';

	}

}

/**
* Default loop columns on product archives.
*/

add_filter( 'loop_shop_columns', 'bizberg_woocommerce_loop_columns' );
function bizberg_woocommerce_loop_columns() {
	return absint( bizberg_get_theme_mod( 'shop_page_column' ) );
}

add_filter('body_class', 'bizberg_woocommerce_class');
function bizberg_woocommerce_class($classes){
    $classes[] = 'bizberg_woocommerce_shop';
   	return $classes;
}

/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Add prduct category on shop page
*/
add_action( 'woocommerce_after_shop_loop_item_title', 'bizberg_show_cat_shop_page', 5 );
function bizberg_show_cat_shop_page(){

    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );

    if ( $product_cats && ! is_wp_error ( $product_cats ) ){

        $cats = array();
        for ($i=0; $i < 2; $i++) { 

        	if( !empty( $product_cats[$i] ) ){

        		$cats[] = '<a class="product_category_title" href="' . esc_url( get_term_link( $product_cats[$i]->term_id ) ) .'">' . esc_html( $product_cats[$i]->name ). '</a>';

        	}
        	
        }

        echo '<div class="bizberg_woocommerce_cat_wrap">';
        echo implode( ', ', array_filter($cats) );
        echo '</div>';

	}

}

/**
 * Add prduct category on shop page
*/
add_action( 'woocommerce_after_shop_loop_item', 'bizberg_add_content_shop_page', 15 );
function bizberg_add_content_shop_page(){

	ob_start();

	$post = get_post( get_the_ID() );
	global $product; ?>
	
	<div class="woocommerce_shop_loop_content">

	 	<div class="product-compare-wishlist">

	 		<?php
	 		if( $product->get_rating_count() > 0 ){

	 			$rating_count = $product->get_rating_count(); ?>

		 		<div class="bizberg_woo_star_rating">
		 			<?php 
		 			echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) );
		 			echo "<span class='bizberg_rating_count'>(" . absint( $rating_count ) . ")</span>"; ?>
		 		</div>

		 		<?php 

		 	}

		 	if( !empty( $post->post_content ) && !is_product() ){ 
		 		$limit = bizberg_get_theme_mod( 'category_product_description' );
		 		if( !empty( $limit ) ){ ?>
	 				<p><?php echo esc_html( wp_trim_words( $post->post_content, $limit ) ); ?></p>
           	 		<?php
           	 	}
           	}

            echo '<div class="bizberg_shop_add_to_cart">';
            echo wp_kses_post( bizberg_add_to_cart_url( $product ) );
            echo '</div>';

            echo '<div class="wishlist_compare_wrapper ' . esc_attr( bizberg_compare_wishlist_check() ) . '">';
            if (function_exists('yith_woocompare_constructor')) {

                global $yith_woocompare;
                $product_id = !is_null($product) ? yit_get_prop($product, 'id', true) : 0;

                // return if product doesn't exist
                if (empty($product_id) || apply_filters('yith_woocompare_remove_compare_link_by_cat', false, $product_id))
                    return;
                $url = is_admin() ? "#" : $yith_woocompare->obj->add_product_url($product_id);
                ?>

                <div class="bizberg_product_compare">
                    <a 
                    class="compare" 
                    rel="nofollow" 
                    data-product_id="<?php echo absint($product_id); ?>" 
                    href="<?php echo esc_url($url); ?>" 
                    title="<?php esc_attr_e('Compare', 'bizberg'); ?>">
                        <i class="fas fa-sync-alt"></i>
                        <?php esc_html_e('Compare', 'bizberg'); ?>
                    </a>
                </div>

                <?php
            }

            if (function_exists('YITH_WCWL')) {
                ?>
                <div class="bizberg_product_wishlist">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                </div>
                <?php
            }
            echo '</div>';
            ?>

        </div>

	</div>

	<?php
	echo ob_get_clean();
}

function bizberg_compare_wishlist_check(){

	if ( function_exists('yith_woocompare_constructor') && function_exists('YITH_WCWL') ) {
		return 'compare_wishlist_both';
	}

}

/***********************************************/
//Sort section Woocommerce category filter show
/***********************************************/

function bizberg_add_to_cart_url($product){
	$cart_url =  apply_filters( 'woocommerce_loop_add_to_cart_link',
	    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button th-button %s %s"><span>%s</span></a>',
	        esc_url( $product->add_to_cart_url() ),
	        esc_attr( $product->get_id() ),
	        esc_attr( $product->get_sku() ),
	        esc_attr( isset( $quantity ) ? $quantity : 1 ),
	        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
	        $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
	        esc_html( $product->add_to_cart_text() )
	    ),$product );
	return $cart_url;
}

/**
 * Remove add to cart on shop page
*/
add_action( 'woocommerce_after_shop_loop_item', 'bizberg_remove_add_to_cart_buttons', 1 );
function bizberg_remove_add_to_cart_buttons() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

/**
 * Add Secondary Image
*/
add_action( 'woocommerce_before_shop_loop_item_title', 'bizbreg_add_second_image_gallery', 5 );
function bizbreg_add_second_image_gallery(){
	global $product;
	$image_id = $product->get_gallery_image_ids();
	if ( !empty( $image_id[0] ) ) {
		$image_attr = wp_get_attachment_image_src( $image_id[0], 'medium_large' );
		if( !empty( $image_attr ) ){
        	echo '<div class="secondary_image" style="background-image:url(' . esc_url( $image_attr[0] ) . ')"></div>';
    	}
    }	
}

add_action( 'woocommerce_before_shop_loop_item_title', 'bizberg_woo_shop_image_wrap_start' , 4 ); 
function bizberg_woo_shop_image_wrap_start(){
    echo '<div class="bizberg_woo_shop_image_wrap">'; 
}

add_action( 'woocommerce_before_shop_loop_item_title', 'bizberg_woo_shop_image_wrap_end' , 11 ); 
function bizberg_woo_shop_image_wrap_end(){
    echo '</div>';
}

/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'bizberg_change_breadcrumb_delimiter' );
function bizberg_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '&nbsp;&nbsp;  /  &nbsp;&nbsp;';
	return $defaults;
}

/**
 * Remove the breadcrumbs 
 */
add_action( 'template_redirect', 'bizberg_woo_remove_wc_breadcrumbs' );
function bizberg_woo_remove_wc_breadcrumbs() {
	if( 
		( is_shop() || is_product_category() ) && 
		bizberg_get_theme_mod( 'woo_shop_breadcrumb_status' ) == false 
	){
    	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}

	if( is_product() ){
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}

// Plus Minus Quantity Buttons @ WooCommerce Single Product Page
add_action( 'woocommerce_before_quantity_input_field', 'bizberg_display_quantity_plus' );
function bizberg_display_quantity_plus(){
    echo '<div class="bizberg-shop-quantity"><button type="button" class="plus" >+</button>';
}

add_action( 'woocommerce_after_quantity_input_field', 'bizberg_display_quantity_minus' );
function bizberg_display_quantity_minus(){
    echo '<button type="button" class="minus" >-</button></div>';
}

add_action( 'woocommerce_single_product_summary', 'bizberg_product_page_breadcrumb', 1 );
function bizberg_product_page_breadcrumb(){
	echo '<div class="bizberg_product_page_breadcrumb">';
	woocommerce_breadcrumb();
	echo '</div>';
}

/**
* Remove heading title from tab @WooCommerce Single Product Tabs
*/
add_filter( 'woocommerce_product_description_heading', '__return_null' );

/**
* Remove additional information heading from tab @WooCommerce Single Product Tabs
*/
add_filter('woocommerce_product_additional_information_heading', 'bizberg_product_additional_information_heading'); 
function bizberg_product_additional_information_heading() {
    echo '';
}

add_filter('woocommerce_gallery_thumbnail_size', 'bizberg_woocommerce_gallery_thumbnail_size'); 
function bizberg_woocommerce_gallery_thumbnail_size( $size ) {
	return 'thumbnail';
}

add_filter( 'bizberg_link_color_output_css', function( $css ){
	$css[] = array(
		'element'       => '.bizberg_woocommerce_shop .bizberg-shop-quantity button:hover, .bizberg_woocommerce_shop div.product form.cart .button, .bizberg_woocommerce_shop #review_form #respond .form-submit input, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table td .button, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table td .button:hover, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page a.checkout-button, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page a.checkout-button:hover, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page p.return-to-shop a, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page p.return-to-shop a:hover, .bizberg_woocommerce_shop.woocommerce-checkout #payment #place_order, .bizberg_woocommerce_shop.woocommerce-checkout #payment #place_order:hover, .bizberg_woocommerce_shop.woocommerce-checkout form.checkout_coupon.woocommerce-form-coupon button, .bizberg_woocommerce_shop.woocommerce-checkout form.checkout_coupon.woocommerce-form-coupon button:hover, .bizberg_woocommerce_shop.woocommerce-checkout form.woocommerce-form-login button, .bizberg_woocommerce_shop.woocommerce-checkout form.woocommerce-form-login button:hover, .bizberg_woocommerce_shop.woocommerce-lost-password button.woocommerce-Button.button, .bizberg_woocommerce_shop.woocommerce-lost-password button.woocommerce-Button.button:hover,.bizberg_woocommerce_shop.woocommerce-wishlist table td.product-add-to-cart a.button,.bizberg_woocommerce_shop.woocommerce-wishlist table td.product-add-to-cart a.button:hover,.bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-name a.yith-wcqv-button:hover, .bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-add-to-cart a,.bizberg_woocommerce_shop .woocommerce-form-login .woocommerce-form-login__submit,.bizberg_woocommerce_shop .woocommerce-form-login .woocommerce-form-login__submit:hover,.bizberg_woocommerce_shop .woocommerce-form-register .woocommerce-form-register__submit,.bizberg_woocommerce_shop .woocommerce-form-register .woocommerce-form-register__submit:hover,.bizberg_woocommerce_shop.woocommerce-wishlist .wishlist_table .product-add-to-cart a:hover,.bizberg_woocommerce_shop.woocommerce-account table.my_account_orders .button,.bizberg_woocommerce_shop.woocommerce-account table.my_account_orders .button:hover,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-pagination a, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-pagination a:hover, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-info a, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-info a:hover,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content p button,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content p button:hover,.bizberg_woocommerce_shop.woocommerce-account form.woocommerce-EditAccountForm p button,.bizberg_woocommerce_shop .bizberg_header_mini_cart_wrapper p.woocommerce-mini-cart__buttons.buttons a,.header_sidemenu_in .woocommerce_cart_sidebar>p.buttons a,.header_sidemenu .mhead p span,.header_sidemenu .mhead p:hover',
		'property'      => 'background',
		'value_pattern' => '$'
	);
	$css[] = array(
		'element'           => '.bizberg_woocommerce_shop div.product form.cart .button::before, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table td .button::before, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page a.checkout-button::before, .bizberg_woocommerce_shop.woocommerce-cart .detail-content.single_page p.return-to-shop a::before, .bizberg_woocommerce_shop.woocommerce-checkout #payment #place_order::before, .bizberg_woocommerce_shop.woocommerce-checkout form.checkout_coupon.woocommerce-form-coupon button::before, .bizberg_woocommerce_shop.woocommerce-checkout form.woocommerce-form-login button::before, .bizberg_woocommerce_shop.woocommerce-lost-password button.woocommerce-Button.button::before,.bizberg_woocommerce_shop.woocommerce-wishlist table td.product-add-to-cart a.button::before,.bizberg_woocommerce_shop .woocommerce-form-login .woocommerce-form-login__submit::before,.bizberg_woocommerce_shop .woocommerce-form-register .woocommerce-form-register__submit::before,.bizberg_woocommerce_shop.woocommerce-account table.my_account_orders .button::before,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-info a::before,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-content p button::before, .bizberg_woocommerce_shop.woocommerce-account form.woocommerce-EditAccountForm p button::before,.bizberg_woocommerce_shop .bizberg_header_mini_cart_wrapper p.woocommerce-mini-cart__buttons.buttons a::before',
		'property'          => 'background',
		'sanitize_callback' => 'bizberg_add_to_cart_border_color'
	);
	$css[] = array(
		'element'       => '.bizberg_woocommerce_shop div.product .woocommerce-tabs ul.tabs li.active',
		'property'      => 'border-color',
		'sanitize_callback' => 'bizberg_add_to_cart_border_color'
	);

	$css[] = array(
		'element'       => '.bizberg_woocommerce_shop div.product .woocommerce-tabs ul.tabs li.active',
		'property'      => 'background-color',
		'media_query'   => '@media (max-width: 639px)'
	);

	$css[] = array(
		'element'       => '.bizberg_woocommerce_shop div.product form.cart .reset_variations::before',
		'property'      => 'color'
	);

	return $css;
});

add_filter( 'bizberg_theme_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop .woocommerce-breadcrumb',
		'property' => 'border-left-color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .bizberg_woocommerce_shop form.woocommerce-product-search button, .bizberg_woocommerce_shop .woocommerce-message a, .bizberg_woocommerce_shop .woocommerce-message a:hover, .bizberg_woocommerce_shop.woocommerce-cart table.shop_table thead, .bizberg_woocommerce_shop.woocommerce-checkout table.shop_table thead, .bizberg_woocommerce_shop.woocommerce-account table.shop_table thead,.bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover, .bizberg_woocommerce_shop.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,.bizberg_woocommerce_shop #bizberg-product-search-box form.woocommerce-product-search button::before,.bizberg_woocommerce_shop .bizberg_wishlist_wrapper a span, .bizberg_woocommerce_shop .bizberg_compare_wrapper a span, .bizberg_woocommerce_shop a.cart-contents span.cart_content_count,.bizberg_woocommerce_shop .bizberg_header_mini_cart_wrapper ul.woocommerce-mini-cart::-webkit-scrollbar, .bizberg_woocommerce_shop.woocommerce-wishlist table.shop_table thead,.header_sidemenu_in .m-contentmain::-webkit-scrollbar',
		'property' => 'background-color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop .widget.widget_product_tag_cloud a:hover, .yith-woocompare-widget a.compare:hover',
		'property' => 'background-color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-message::before',
		'property' => 'color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.woocommerce-message,.woocommerce-info,.bizberg_woocommerce_shop.woocommerce-checkout p.woocommerce-thankyou-order-received',
		'property' => 'border-color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.woocommerce-info::before, .bizberg_woocommerce_shop.woocommerce-checkout p.woocommerce-thankyou-order-received',
		'property' => 'color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_sidebar_widget_link_color_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop #sidebar .widget a, .bizberg_woocommerce_shop .widget.widget_product_categories ul li a::before',
		'property' => 'color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_link_color_hover_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop ul.products li.product .bizberg_product_compare a:hover,.bizberg_woocommerce_shop ul.products li.product .bizberg_product_wishlist .yith-wcwl-add-to-wishlist a:hover',
		'property' => 'color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_sidebar_widget_link_color_hover_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop #sidebar .widget a:hover, .bizberg_woocommerce_shop .widget.widget_product_categories ul li a:hover::before',
		'property' => 'color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_blog_listing_pagination_border_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop nav.woocommerce-pagination ul li a',
		'property' => 'border-color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_blog_listing_pagination_text_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop nav.woocommerce-pagination ul li a',
		'property' => 'color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_blog_listing_pagination_active_hover_color_output_css', function( $css ){

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop nav.woocommerce-pagination ul li span.current, .bizberg_woocommerce_shop nav.woocommerce-pagination ul li a:focus, .bizberg_woocommerce_shop nav.woocommerce-pagination ul li a:hover',
		'property' => 'background-color',
		'value_pattern' => '$'
	);

	$css[] = array(
		'element'  => '.bizberg_woocommerce_shop nav.woocommerce-pagination ul li span.current, .bizberg_woocommerce_shop nav.woocommerce-pagination ul li a:focus, .bizberg_woocommerce_shop nav.woocommerce-pagination ul li a:hover',
		'property' => 'border-color',
		'value_pattern' => '$'
	);

	return $css;

});

add_filter( 'bizberg_recommended_plugins', function( $plugins ){

	$plugins[] = array(
        'name' => esc_html__( 'YITH WooCommerce Compare', 'bizberg' ),
        'slug' => 'yith-woocommerce-compare',
        'required' => false
    );

    $plugins[] = array(
        'name' => esc_html__( 'YITH WooCommerce Quick View', 'bizberg' ),
        'slug' => 'yith-woocommerce-quick-view',
        'required' => false
    );

    $plugins[] = array(
        'name' => esc_html__( 'YITH WooCommerce Wishlist', 'bizberg' ),
        'slug' => 'yith-woocommerce-wishlist',
        'required' => false
    );

    return $plugins;

});

add_action( 'wp_footer', 'bizberg_floating_menus' );
function bizberg_floating_menus() { 

 	$status = bizberg_get_theme_mod( 'woocommerce_floating_menu_status' );

 	if( empty( $status ) ){
 		return;
 	} 

 	$floating_menu_content = bizberg_get_theme_mod( 'floating_menu_content' );

 	if( empty( $floating_menu_content ) ){
 		return;
 	}

 	?>
    
    <div class="header_sidemenu">

        <div class="mhead">

        	<?php 

        	foreach ( $floating_menu_content as $key => $value ) { 

        		switch ( $value ) {

        		 	case 'cart': 
        		 		bizberg_get_cart_icon_floating_menu();
        		 		break;

        		 	case 'wishlist':
        		 		bizberg_get_wishlist_icon_floating_menu();
        		 		break;

        		 	case 'compare':
        		 		bizberg_get_compare_icon_floating_menu();
        		 		break;
        		 	
        		 	default:
        		 		# code...
        		 		break;
        		 }

        	} ?>

        </div>

    </div>

    <div class="header_sidemenu">
        <div class="header_sidemenu_in">
            <div class="menu">                
                 <div class="m-contentmain">
                 	<div class="woocommerce_cart_sidebar">
                 		<div class="title">
                 			<?php 
                 			esc_html_e( 'Your Cart', 'bizberg' );
                 			?>
                 			<div class="close-menu">
			                    <i class="fa fa-times white"></i>
			                </div>
                 		</div>
	                    <?php 
						woocommerce_mini_cart(); 
						?>
					</div> 
                </div>    
            </div>
            <div class="overlay hide"></div>
        </div>
    </div>
        
    <?php
}

add_filter( 'woocommerce_add_to_cart_fragments', 'bizberg_woocommerce_sidebar_add_to_cart_content' );
function bizberg_woocommerce_sidebar_add_to_cart_content( $fragments ) {

	ob_start();
	?>

	<div class="woocommerce_cart_sidebar">
		<div class="title">
 			<?php 
 			esc_html_e( 'Your Cart', 'bizberg' );
 			?>
 			<div class="close-menu">
                <i class="fa fa-times white"></i>
            </div>
 		</div>
		<?php 
		woocommerce_mini_cart(); 
		?>
	</div>

	<?php
	
	$fragments['.woocommerce_cart_sidebar'] = ob_get_clean();

	return $fragments;

}

add_filter( 'woocommerce_add_to_cart_fragments', 'bizberg_woocommerce_sidebar_add_to_cart_count' );
function bizberg_woocommerce_sidebar_add_to_cart_count( $fragments ) {

	ob_start();
	?>

	<a href="#" class="floating_cart_content_wrapper">
    	<i class="fas fa-shopping-cart"></i>
    	<span class="cart_content_count">
    		<?php echo absint( WC()->cart->get_cart_contents_count() ); ?>
    	</span>
    </a>

	<?php
	
	$fragments['a.floating_cart_content_wrapper'] = ob_get_clean();

	return $fragments;

}

function bizberg_get_cart_icon_floating_menu(){ 

	global $woocommerce; ?>

	<p class="menu-ham">
        <a href="#" class="floating_cart_content_wrapper">
        	<i class="fas fa-shopping-cart"></i>
        	<span class="cart_content_count">
        		<?php echo absint( WC()->cart->get_cart_contents_count() ); ?>
        	</span>
        </a>
    </p>

	<?php
}

function bizberg_get_wishlist_icon_floating_menu(){

	if( !function_exists('YITH_WCWL') ){
		return;
	} ?>

	<p>
        <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
        	<i class="fas fa-heart"></i>
        	<span class="wishlist_count"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
        </a>
    </p>

	<?php
}

function bizberg_get_compare_icon_floating_menu(){

	if( !function_exists('yith_woocompare_constructor') ){
		return;
	}

	global $yith_woocompare;
	
	$count = !empty( $yith_woocompare->obj->products_list ) && is_array( $yith_woocompare->obj->products_list ) ? count( $yith_woocompare->obj->products_list ) : '0'; ?>

	<p class="yith-woocompare-widget">
	    <a href="<?php echo esc_url( site_url() ); ?>/?action=yith-woocompare-view-table&iframe=yes" class="compare">
	    	<i class="fas fa-sync-alt"></i>
	    	<span class="compare_count">
	    		<?php echo absint( $count ); ?>
	    	</span>
	    </a>
	</p>  

	<?php
}