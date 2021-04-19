<?php
/**
 * Bizberg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bizberg
 */

if ( ! function_exists( 'bizberg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bizberg_setup() {

	    load_theme_textdomain( 'bizberg', get_template_directory() . '/languages' );
		
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'page', 'excerpt' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats' , array( 'aside', 'gallery' , 'standard', 'link', 'image' , 'quote', 'status', 'video', 'audio' , 'chat' ));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bizberg' ),
			'footer' => esc_html__( 'Footer', 'bizberg' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
			'height'      => '300',
 			'width'       => '500'
		) );

		add_image_size( 'bizberg_medium', 300, 300, true );
		add_image_size( 'bizberg_gallery', 500, 400, true );
		add_image_size( 'bizberg_blog_list', 368, 240, true );
		add_image_size( 'bizberg_detail_image', 825, 400, true );
		add_image_size( 'bizberg_detail_image_no_sidebar', 920, 400, true );
		add_image_size( 'bizberg_portfolio_homepage', 600, 400, true );
		add_image_size( 'bizberg_blog_list_no_sidebar_1', 220, 190, true );
	}
endif;
add_action( 'after_setup_theme', 'bizberg_setup' );

add_filter( 'elegant_blocks_bootstrap', 'bizberg_bootstrap' );
function bizberg_bootstrap(){
	return true;
}

add_filter( 'elegant_blocks_fontawesome', 'bizberg_fontawesome' );
function bizberg_fontawesome(){
	return true;
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bizberg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bizberg_content_width', 640 );
}
add_action( 'after_setup_theme', 'bizberg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bizberg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bizberg' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Right Header', 'bizberg' ),
		'id'            => 'bizberg_header',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Header', 'bizberg' ),
		'id'            => 'bizberg_header_left',
		'description'   => esc_html__( 'Add widgets here.', 'bizberg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bizberg_widgets_init' );

/**
 * Enqueue scripts and styles backend.
 */

add_action( 'admin_enqueue_scripts', 'bizberg_custom_wp_admin_style' );
function bizberg_custom_wp_admin_style() {
    wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css' );
    wp_enqueue_script( 'bizberg-install-recommended-plugins', get_template_directory_uri() . '/inc/install-recommended-plugins/admin.js', array( 'jquery' ), false, false );
}

function bizberg_google_fonts(){

	$query_args = array(
   		'family' => 'Lato:wght@300;400;700;900&display=swap'
 	);

 	wp_register_style( 
   		'bizberg-google-fonts', 
   		add_query_arg( $query_args, '//fonts.googleapis.com/css2' ), 
   		array(), 
   		null 
 	);
 	
 	wp_enqueue_style( 'bizberg-google-fonts' );

}

/**
 * Enqueue scripts and styles.
 */
function bizberg_scripts() {

	$my_theme = wp_get_theme();
	$current_version = $my_theme->get( 'Version' ); // Get theme Current Version

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), $current_version );
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/icons/font-awesome-5/css/all.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-main', get_template_directory_uri() . '/assets/css/main.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-component', get_template_directory_uri() . '/assets/css/component.css', array(), $current_version );

	wp_enqueue_style( 'bizberg-style2', get_template_directory_uri() . '/assets/css/style.css' , array(), $current_version);
	wp_enqueue_style( 'bizberg-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $current_version );
	wp_enqueue_style( 'bizberg-style', get_stylesheet_uri() );

	bizberg_google_fonts();

	$scripts = array(
		array(
			'id' => 'bootstrap',
			'url' => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => false
		),
		array(
			'id' => 'mousescroll',
			'url' => get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js',
			'footer' => true
		),
		array(
			'id' => 'inview',
			'url' => get_template_directory_uri() . '/assets/js/jquery.inview.min.js',
			'footer' => true
		),
		array(
			'id' => 'slicknav',
			'url' => get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
			'footer' => true
		),
		array(
			'id' => 'matchHeight',
			'url' => get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
			'footer' => true
		),
		array(
			'id' => 'swiper',
			'url' => get_template_directory_uri() . '/assets/js/swiper.js',
			'footer' => true
		),
		array(
			'id' => 'prognroll',
			'url' => get_template_directory_uri() . '/assets/js/prognroll.js',
			'footer' => true
		),
		array(
			'id' => 'theia-sticky-sidebar',
			'url' => get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js',
			'footer' => true
		),
	);

	wp_enqueue_script('masonry');

	/** 
	* @since 4.1.6
	* If true then enqueue slick slider js
	* This is for the child theme. In child theme there are sliders that uses slick 
	*/

	if( apply_filters( 'bizberg_slick_slider_status', false ) ){
		wp_enqueue_script( 'slick' , get_template_directory_uri() . '/assets/js/slick.js' , array('jquery') , $current_version , true );
	}

	bizberg_add_scripts( $scripts , $current_version );

	wp_register_script( 'bizberg-custom' , get_template_directory_uri() . '/assets/js/custom.js' , array('jquery') , $current_version , true );

	$translation_array = array(
	   'admin_bar_status' => is_admin_bar_showing(),
	   'slider_loop' => bizberg_get_theme_mod( 'slider_loop_status' ),
	   'slider_speed' => bizberg_get_theme_mod( 'slider_speed' ),
	   'autoplay_delay' => bizberg_get_theme_mod( 'autoplay_delay' ),
	   'slider_grab_n_slider' => bizberg_get_theme_mod( 'slider_grab_n_slider' ),
	   'header_menu_color_hover' => bizberg_check_transparent_header() ? bizberg_get_theme_mod( 'transparent_header_menu_color_hover' ) : bizberg_get_theme_mod( 'header_menu_color_hover' ),
	   'header_menu_color_hover_sticky' => bizberg_get_theme_mod( 'header_menu_color_hover_sticky_menu' ),
	   'is_transparent_header' => bizberg_check_transparent_header() ? 'true' : 'false',
	   'primary_header_layout' => bizberg_get_theme_mod( 'primary_header_layout' ),
	   'slide_in_animation' => bizberg_get_theme_mod( 'header_menu_slide_in_animation' ),
	   'sticky_header_status' => apply_filters( 'bizberg_sticky_header_status', 'true' ),
	   'sticky_sidebar_margin_top_status' => apply_filters( 'bizberg_sticky_sidebar_margin_top_status', 110 ),
	   'sticky_sidebar_margin_bottom_status' => apply_filters( 'bizberg_sticky_sidebar_margin_bottom_status', 10 ),
	   'sticky_sidebar_status' => bizberg_get_theme_mod( 'sticky_content_sidebar' )
	);
	wp_localize_script( 'bizberg-custom', 'bizberg_object', apply_filters( 'bizberg_localize_scripts', $translation_array ) );
	 
	// Enqueued script with localized data.
	wp_enqueue_script( 'bizberg-custom' );

    wp_add_inline_style( 'bizberg-style', bizberg_inline_style() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function bizberg_check_transparent_header(){

	if( bizberg_get_theme_mod( 'transparent_header_homepage' ) && ( is_home() || is_front_page() ) ){
		return true;
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return false;
	}

	if( is_page( $pages ) ){
		return true;
	}

	return false;

}

add_action( 'wp_enqueue_scripts', 'bizberg_scripts' );

function bizberg_inline_style(){

	$detail_page_img_position = get_theme_mod( 'detail_page_img_position' , 'left' );
	$slider_banner_status = bizberg_get_theme_mod( 'slider_banner' );
	$inner_page_background_type = bizberg_set_inner_page_background_type();

	// Gradient Slider
	$slider_primary_color = bizberg_get_theme_mod( 'slider_gradient_primary_color' );
	$slider_gradient_secondary_color = bizberg_get_theme_mod( 'slider_gradient_secondary_color' );

	// Banner Text Position
	$banner_text_position = bizberg_get_theme_mod( 'banner_text_position' );

	// Banner Spacing
	$banner_spacing = bizberg_get_theme_mod( 'banner_spacing' );

	// Arrow Style
	$arrow_style = bizberg_get_theme_mod( 'arrow_style' );

	// Background Image and Color
	$body_background_image = bizberg_get_theme_mod( 'body_background_image' );

	// Header Background Image and Color
	$header_background_image = bizberg_get_theme_mod( 'header_background_image' );

	// Top Bar Background Colors
	$top_bar_background_1 = bizberg_get_theme_mod( 'top_bar_background_1' );
	$top_bar_background_2 = bizberg_get_theme_mod( 'top_bar_background_2' );

	// Navbar Background Colors
	$header_navbar_background_1 = bizberg_get_theme_mod( 'header_navbar_background_1' );
	$header_navbar_background_2 = bizberg_get_theme_mod( 'header_navbar_background_2' );

	// Navbar Background Colors Sticky Header
	$header_navbar_background_1_sticky_menu = bizberg_get_theme_mod( 'header_navbar_background_1_sticky_menu' );
	$header_navbar_background_2_sticky_menu = bizberg_get_theme_mod( 'header_navbar_background_2_sticky_menu' );

	// Read More Button Colors
	$read_more_background_color = bizberg_get_theme_mod( 'read_more_background_color' );
	$read_more_background_color_2 = bizberg_get_theme_mod( 'read_more_background_color_2' );

	$inline_css = '';
	if( $detail_page_img_position == 'center' ){
		$inline_css .= "
        .detail-content.single_page img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
		}";
	}

	if( $slider_banner_status == 'none' ){
		$inline_css .= 'body.home header#masthead {
		    border-bottom: 1px solid #eee;
		}';
	}

	if( $inner_page_background_type == 'none' ){
		$inline_css .= 'body:not(.home) header#masthead {
		    border-bottom: 1px solid #eee;
		}';
	}

	$inline_css .= '.banner .slider .overlay {
	   background: linear-gradient(-90deg, ' . esc_attr( $slider_primary_color ) . ', ' . esc_attr( $slider_gradient_secondary_color ) . ');
	}';

	$banner_spacing_attr = array();
	foreach ( $banner_spacing as $key => $value ) {
		$banner_spacing_attr[] = $key . ':' . $value;
	}

	$inline_css .= '.breadcrumb-wrapper .section-title{ text-align:' . esc_attr( $banner_text_position ) . ';' . implode( '; ', $banner_spacing_attr ) . ' }';

	$inline_css .= bizberg_arrow_style_slider( $arrow_style );

	$inline_css .= bizberg_theme_background_image( $body_background_image, $placement = 'body' );

	$inline_css .= bizberg_theme_background_image( $header_background_image, $placement = '.primary_header_2_wrapper' );

	$inline_css .= bizberg_theme_get_gradient_color( $top_bar_background_1, $top_bar_background_2 , 'body:not(.page-template-page-fullwidth-transparent-header) header#masthead #top-bar' );

	$inline_css .= bizberg_theme_get_gradient_color( $header_navbar_background_1, $header_navbar_background_2 , '.navbar-default' );

	$inline_css .= bizberg_theme_get_gradient_color( $header_navbar_background_1_sticky_menu, $header_navbar_background_2_sticky_menu, '.navbar.sticky' );

	$inline_css .= bizberg_theme_get_gradient_color( $read_more_background_color, $read_more_background_color_2, 'a.slider_btn' );

	return apply_filters( 'bizberg_inline_style', $inline_css );

} 

function bizberg_theme_get_gradient_color( $color_1, $color_2, $selector ){

	return "$selector { background: $color_1;
    background: -moz-linear-gradient(90deg, $color_1 0%, $color_2 100%);
    background: -webkit-linear-gradient(90deg, $color_1 0%, $color_2 100%);
    background: linear-gradient(90deg, $color_1 0%, $color_2 100%);
    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='$color_1', endColorstr='$color_1', GradientType=1); }";

}

function bizberg_theme_background_image( $body_background_image, $placement ){

	$color = !empty( $body_background_image['background-color'] ) ? $body_background_image['background-color'] : 'rgba(255,255,255,0)';
	$image = !empty( $body_background_image['background-image'] ) ? $body_background_image['background-image'] : '';
	$background_repeat = !empty( $body_background_image['background-repeat'] ) ? $body_background_image['background-repeat'] : '';
	$background_position = !empty( $body_background_image['background-position'] ) ? $body_background_image['background-position'] : '';
	$background_size = !empty( $body_background_image['background-size'] ) ? $body_background_image['background-size'] : '';
	$background_attachment = !empty( $body_background_image['background-attachment'] ) ? $body_background_image['background-attachment'] : '';

	return "$placement{ background-image: linear-gradient(to right," . $color . "," . $color . "),url( ". $image ." ); 
	background-repeat : " . $background_repeat . ";" . "
	background-position : " . $background_position . ";" . "
	background-size : " . $background_size . ";" . "
	background-attachment : " . $background_attachment . ";}";
}

function bizberg_arrow_style_slider( $arrow_style ){

	switch ( $arrow_style ) {

		case 'square':
			return '.banner .slider .swiper-button-next, .banner .slider .swiper-button-prev { border-radius: 0px; }';
			break;

		case 'diamond':
			return '.banner .slider .swiper-button-next, .banner .slider .swiper-button-prev { border-radius: 0px; transform: rotate(45deg); } .banner .slider .swiper-button-next:after, .banner .slider .swiper-button-prev:after{ transform: rotate(-45deg); }';
			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_add_scripts( $scripts, $current_version ){

	foreach ( $scripts as $key => $value ) {

		wp_enqueue_script( 
			$value['id'], 
			$value['url'], 
			array( 'jquery' ), 
			$current_version, 
			$value['footer'] 
		);

	}

}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * WP Comment Walker
 */
require get_template_directory() . '/wp-comment-walker.php';

/**
 * Walker Nav Menu
 */
require get_template_directory() . '/wp-menu-walker.php';

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/fontawesome-5-icons.php';

require get_template_directory() . '/inc/plugins/kirki/kirki.php';

require get_template_directory() . '/inc/plugins/advanced-kirki/index.php';

require get_template_directory() . '/inc/install-recommended-plugins/index.php';

if( class_exists( 'WooCommerce' ) ){
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Displays the author name
*/

function bizberg_get_display_name( $post ){
	
	$user_id = $post->post_author;
	if( empty( $user_id ) ){
		return;
	}

	$user_info = get_userdata( $user_id );
	echo esc_html( $user_info->display_name );
}

function bizberg_post_categories( $post , $limit = false , $plain_text = false , $echo = true ){
	
	$post_categories = wp_get_post_categories( $post->ID );
	$cats = array();

	foreach($post_categories as $key =>  $c){

		if( $key === $limit ){
			break;
		}

	    $cat = get_category( $c );
	    if( $plain_text == true ){
	    	$cats[] = esc_html( $cat->name );
	    } else {
	    	if( $limit == 1 ){
	    		$cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '"><i class="far fa-folder"></i> ' . esc_html( $cat->name ) . '</a>';	
	    	} else {
	    		$cats[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';	 
	    	}	    	
	    }   
	}
	
	if( empty( $cats ) ){
		return false;
	} else{
		if( $echo == true ){
			echo wp_kses_post( implode( ' , ' , $cats ) );	
		} else{			
			return implode( ' , ' , $cats );			
		}
	
	}
	
}

function bizberg_numbered_pagination(){

	if( !paginate_links() ){
		return;
	}

	echo '<div class="result-paging-wrapper">';
	the_posts_pagination( 
		array(
			'mid_size' 	=> 1,
			'prev_text' => esc_html__( '&laquo;', 'bizberg' ),
			'next_text' => esc_html__( '&raquo;', 'bizberg' ),
		) 
	);
	echo '</div>';

}

if( !function_exists( 'bizberg_get_custom_logo_link' ) ){

	function bizberg_get_custom_logo_link(){

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

		if ( has_custom_logo() ) {
	        return $logo[0];
		} 

		return;       

	}

}

function bizberg_get_slider_title_design( $title ){

	$slider_title_layout = bizberg_get_theme_mod( 'slider_title_layout' );
	$slider_text_align = bizberg_get_theme_mod( 'slider_text_align' );

	switch ( $slider_title_layout ) {
		case '2':
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' . esc_html( $title ) . '</h1>';
			break;

		case '3':
			$title = explode( " ", $title );
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' .  '<span class="firstword">'.$title[0].'</span>'.substr(implode(" ", $title), strlen($title[0])) . '</h1>';
			break;

		case '4':
			$title = explode( " ", $title );
			$last_space_position = strrpos( implode(" ", $title) , ' ' );
			return '<h1 class="slider_title_layout_' . $slider_title_layout . ' ' . $slider_text_align . '">' . substr( implode(" ", $title) , 0, $last_space_position ) . ' <span class="lastword">'. array_pop( $title ) .'</span>' . '</h1>';
			break;
		
		default:
			return '<h1>' . esc_html( $title ) . '</h1>';
			break;
	}

}

function bizberg_get_all_pages(){

	$args = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);

	$page_query = new WP_Query( $args );
	$pages = array();
	$pages[0] = esc_html__( 'None' , 'bizberg' );

	if( $page_query->have_posts() ):

		while( $page_query->have_posts() ): $page_query->the_post();

			global $post;
			$pages[$post->ID] = get_the_title();

		endwhile;

	endif;

	wp_reset_postdata();

	return $pages;
}

function bizberg_get_slider_page_ids( $data ){
	$page_ids = array();
	foreach ( $data as $key => $value ) {
		$page_ids[] = $value['page_id'];
	}
	return $page_ids;
}

function bizberg_get_read_more_link( $slider_pages ){
	$read_more_links = array();
	foreach ( $slider_pages as $key => $value ) {
		$page_id = $value['page_id'];
		$read_more_link = $value['read_more_link'];
		$read_more_links[$page_id] = $read_more_link;
	}
	return $read_more_links;
}

function bizberg_get_slider_1(){ 

	// Display from slider / pages
	$slider_cat_pages_status = bizberg_get_theme_mod( 'slider_cat_pages' );

	// Get slider pages
	$slider_pages = bizberg_get_theme_mod( 'slider_pages' );
	$slider_page_ids = bizberg_get_slider_page_ids( $slider_pages );
	$slider_page_ids = array_filter( $slider_page_ids );

	// Get read more link of slider pages
	$read_more_links =  bizberg_get_read_more_link( $slider_pages );
	$read_more_links =  array_filter( $read_more_links );

	$args = array(
		'posts_per_page' => 2,
		'post_status' => 'publish'
	);

	// Include pages
	if( $slider_cat_pages_status == 'page' ){
		$args['post__in'] = empty( $slider_page_ids ) ? array( 'none' ) : $slider_page_ids;
		$args['post_type'] = 'page';
		$args['orderby'] = 'post__in';
	} else {
		// Includes category
		$args['cat'] = bizberg_get_theme_mod( 'slider_category' , '0' );
		$args['post_type'] = 'post';
	}

	$query = new WP_Query( $args );
	$count = 0;

	if( $query->have_posts() ): ?>
	
	    <!-- banner starts -->
	    <section class="banner">

	        <div class="slider">

	            <div class="swiper-container-bizberg swiper-container">	            	

	                <div class="swiper-wrapper">

	                	<?php 
		            	while( $query->have_posts() ): $query->the_post(); 

		            		global $post;

		            		$thumbnail_id = get_post_thumbnail_id(); 

		            		// If page is selected for slider, check the custom link
		            		$custom_link = '';
		            		if( $slider_cat_pages_status == 'page' && array_key_exists( $post->ID , $read_more_links ) ){
		            			$custom_link = $read_more_links[$post->ID];
		            		} ?>

		                    <div class="swiper-slide">

		                        <div class="slide-inner">

		                           <div class="slide-image" style="background-image:url(<?php echo esc_url( bizberg_get_image_link_by_id( $thumbnail_id , 'full' ) ); ?>)"></div>

		                           	<div class="swiper-content swiper-content-bizberg">
		                                	
	                                		<?php 

	                                		// Display Title
	                                		echo wp_kses_post(
	                                			bizberg_get_slider_title_design( 
	                                				get_the_title() 
	                                			)
	                                		);  

	                                		// Display Content
	                                		if( has_excerpt() ){

	                                			the_excerpt();

	                                		} else {

	                                			echo '<p class="mar-bottom-20">';
		                                		echo wp_trim_words( 
		                                			sanitize_text_field( get_the_content() ), 
		                                			bizberg_get_theme_mod( 'slider_content_length' ), 
		                                			' [...]'
		                                		);
		                                		echo '</p>';

		                                	} 

		                                	// Display Read More Button

		                                	$slider_read_more_status = bizberg_get_theme_mod( 'slider_read_more_status' );
		                                	
		                                	if( !$slider_read_more_status ){ ?>

			                                	<a 
												href="<?php echo esc_url( $custom_link ? $custom_link : get_permalink() ); ?>" 
												class="slider_btn">
													<span class="slider_btn_text_wrapper">
														<?php 
														echo bizberg_get_slider_read_more_btn();
														?>
													</span>
												</a>

			                                	<?php 

			                                } ?>

		                            </div> 
		                            <div class="overlay"></div>
		                        </div> 
		                    </div>

		                 	<?php

		                endwhile;
		                ?>

	                </div>
	                <!-- Add Arrows -->
	                <div class="swiper-button-next"></div>
	                <div class="swiper-button-prev"></div>
	                <div class="swiper-pagination"></div>	            

	            </div>
	            
	        </div>

	        <div class="bizberg_shape_divider_slider_homepage_wrapper">
	        	<?php echo wp_kses_post( bizberg_get_shape_divider() ); ?>
	        </div>
	        
	    </section>
    	<!-- banner ends -->

		<?php

	endif;

	wp_reset_postdata();
}

function bizberg_get_slider_read_more_btn(){
	return esc_html( bizberg_get_theme_mod( 'slider_read_more_text' ) );
}

function bizberg_get_shape_divider(){

	$shape_divider_bottom = bizberg_get_theme_mod('shape_divider_bottom');
	$shape_divider_flip_horizontal = bizberg_get_theme_mod('shape_divider_flip_horizontal');
	$shape_divider_flip_horizontal_class = $shape_divider_flip_horizontal ? 'shape_divider_flip_horizontal' : '';

	if( $shape_divider_bottom != 'none' ){
		
		return '<div class="bizberg_shape_divider_slider_homepage ' . $shape_divider_flip_horizontal_class . ' "><img src="' . esc_url( get_template_directory_uri() . '/assets/images/shape-divider/' . $shape_divider_bottom ) . '" ></div>';

	}

	return '';

}

function bizberg_get_image_link_by_id( $image_id , $size ){
	$image_attributes = wp_get_attachment_image_src( $image_id , $size );
	if( !empty( $image_attributes[0] ) ){
		return $image_attributes[0];
	}
	return;
}

function bizberg_get_all_posts( $post_type = 'post' ){

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'name',
		'order' => 'ASC'
	);

	$query = new WP_Query($args);
	$data = array();

	if( $query->have_posts() ):

		while( $query->have_posts() ): $query->the_post();

			global $post;
			$data[$post->ID] = esc_html( get_the_title() );

		endwhile;

		wp_reset_postdata();

	endif;

	return $data;
}

function bizberg_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	$data[0] = esc_html__( 'None' , 'bizberg' );
	return $data;

}

function bizberg_sidebar_position(){

	$position =  get_theme_mod( 'sidebar_settings' , apply_filters( 'bizberg_sidebar_settings', '1' ) );

	switch ( $position ) {
		case 1:
			return 'blog-rightsidebar';
			break;
		
		case 2:
			return 'blog-leftsidebar';
			break;

		case 3:
			return 'blog-nosidebar';
			break;

		default:
			return 'blog-nosidebar-1';
			break;
	}

}

function bizberg_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'bizberg_excerpt_length', 999 );

function bizberg_icon( $post_id ){

	$format = get_post_format( $post_id );

	$custom_icon = get_post_meta( $post_id, 'listing_icon', true );

	if( !empty( $custom_icon ) ){
		return $custom_icon;
	}

	switch ( $format ) {
		case 'aside':
			return 'fas fa-file-alt';
			break;

		case 'gallery':
			return 'fas fa-images';
			break;
		
		case 'link':
			return 'fas fa-link';
			break;	

		case 'image':
			return 'fas fa-camera-retro';
			break;	

		case 'quote':
			return 'fas fa-quote-right';
			break;	

		case 'status':
			return 'fas fa-thermometer-three-quarters';
			break;	

		case 'video':
			return 'fas fa-video';
			break;	

		case 'audio':
			return 'fas fa-volume-up';
			break;	

		case 'chat':
			return 'fas fa-comments';
			break;		

		default:
			return 'fas fa-thumbtack';
			break;
	}

}

add_filter( 'get_search_form', 'bizberg_search_form', 100 );
function bizberg_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    	<label for="s">
    		<input placeholder="' . esc_attr__( 'Search ...' , 'bizberg' ) . '" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" class="search-field" />
    		<input class="search-submit" type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' , 'bizberg' ) .'" />
    	</label>    	
    </form>';

    return $form;
}

function bizberg_get_banner_image_properties(){

	$banner_image = bizberg_get_theme_mod( 'banner_image' );

	if( !empty( $banner_image ) && is_array( $banner_image ) ){

		$style = array();
		foreach ( $banner_image as $key => $value ) {

			if( $key == 'background-image' ){
				$style[] = $key  .': url('. $value . ')';
			} else {
				$style[] = $key  .':'. $value;
			}

		}

		return implode( '; ' , $style );
	}

	if( is_string( $banner_image ) ){
		return 'background-image:url(' . $banner_image . ')';
	}

	return false;
	
}

function bizberg_get_video(){

	$video_url = bizberg_get_theme_mod( 'frontpage_video_url' );

	if( empty( $video_url ) ){
		return;
	} ?>

	<div class="bizberg_frontpage_video_wrapper">
		<div class="bizberg_gradient_video"></div>
		<video autoplay muted loop>
		  	<source src="<?php echo esc_url( $video_url ); ?>">
		</video>
	</div>

	<?php

}

function bizberg_get_banner(){ 

	$banner_image_attr = bizberg_get_banner_image_properties(); ?>

	<div 
	class="breadcrumb-wrapper homepage_banner"
	style="<?php echo esc_attr( $banner_image_attr ); ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-title">
						<h1 class="banner_title">
							<?php 
							$banner_title = bizberg_get_theme_mod( 'banner_title' );
							echo esc_html( $banner_title ); ?>
						</h1>
						<p class="banner_subtitle">
							<?php 
							$banner_subtitle = bizberg_get_theme_mod( 'banner_subtitle' );
							echo wp_kses_post( nl2br( $banner_subtitle ) ); 
							?> 
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>

	<?php
}

function bizberg_get_banner_title(){
	return esc_html( bizberg_get_theme_mod( 'banner_title' ) );
}

function bizberg_get_banner_subtitle(){
	return wp_kses_post( nl2br( bizberg_get_theme_mod( 'banner_subtitle' ) ) );
}

function bizberg_set_inner_page_background_type(){

	if( class_exists( 'WooCommerce' ) && is_product() ){
		return 'none';
	}

	if( is_search() ){

		$breadcrumb_search_page = bizberg_get_theme_mod( 'breadcrumb_search_page' );
		if( $breadcrumb_search_page ){
			return 'none';
		}

	}

	if( is_archive() ){

		$breadcrumb_archive_page = bizberg_get_theme_mod( 'breadcrumb_archive_page' );
		if( $breadcrumb_archive_page ){
			return 'none';
		}

	}

	if( is_page() ){

		$breadcrumb_single_page = bizberg_get_theme_mod( 'breadcrumb_single_page' );
		if( $breadcrumb_single_page ){
			return 'none';
		}
		
	}

	if( is_single() ){

		$breadcrumb_single_post = bizberg_get_theme_mod( 'breadcrumb_single_post' );
		if( $breadcrumb_single_post ){
			return 'none';
		}
		
	}

	return false;

}

function bizberg_get_breadcrums(){

	$inner_page_background_type = bizberg_set_inner_page_background_type();

	if( $inner_page_background_type == 'none' ){
		return;
	} ?>

	<div 
	class="breadcrumb-wrapper not-home">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-title">
						<h1><?php bizberg_get_breadcrum_title(); ?></h1>
						<ol class="breadcrumb">
							<?php bizberg_custom_breadcrumbs(); ?>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
	</div>
	<?php
}

function bizberg_get_breadcrum_title(){

	if( is_single() || is_page() ){
		the_title();
	} elseif( is_search() ){
		$search_title = explode( ',' , get_search_query() );
		printf(
			esc_html__( 'Search Results for: %s' , 'bizberg' ),
			esc_html( $search_title[0] )
		);
	} elseif( is_404() ){
		echo esc_html__( 'Error 404' , 'bizberg' );
	} elseif( class_exists( 'WooCommerce' ) && is_shop() ){
		echo esc_html__( 'Shop' , 'bizberg' );
	} else {
		the_archive_title( '', '' );
	}

}

function bizberg_custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__( 'Home' , 'bizberg' );
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'destinations';
       
    // Get the query & post information
    global $post,$wp_query;

    if( class_exists( 'WooCommerce' ) && ( is_shop() || is_product() ) ){
        // Don't display breadcrumb
    } elseif ( !is_front_page() ) { // Do not display on the homepage
           
        // Home page
        echo '<li class="item-home cyclone-blog-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '">' . esc_html( $home_title ) . '</a></li>';
        
        if ( is_single() ) {
              
            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = array_slice($category, -1);
                $last_category = array_pop( $last_category );
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'. wp_kses_post( $parents ) .'</li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );

                if( !empty( $taxonomy_terms ) && is_array( $taxonomy_terms ) ){

                	$cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;

                }
                
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {

                $allowed_html = array(
                	'li' => array(
                		'class' => array()
                	),
                	'a' => array(
                		'href' => array()
                	)
                );

                echo wp_kses( $cat_display , $allowed_html );
                echo '<li class="item-current"><span class="bread-current active">' . esc_html( get_the_title() ) . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat"><a class="bread-cat" href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';

                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                  
            }
              
        } elseif ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } elseif ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                $parents = '';
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( get_permalink($ancestor) ) . '">' . esc_html( get_the_title($ancestor) ) . '</a></li>';
                }
                   
                // Display parent pages

                echo wp_kses( 
                	$parents, 
                	array(
                		'li' => array(
                			'class' => array()
                		),
                		'a' => array(
                			'class' => array(),
                			'href' => array(),
                			'title' => array()
                		),
                	)
                );
                   
                // Current page
                echo '<li class="item-current"><span class="active"> ' . esc_html( get_the_title() ) . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_title() ) . '</span></li>';
                   
            }
               
        } elseif ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current"><span class="active">' . esc_html( $get_term_name ) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month link
            echo '<li class="item-month"><a class="bread-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('M') ) . '</a></li>';
               
            // Day display
            echo '<li class="item-current"><span class="active bread-current"> ' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year"><a class="bread-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
               
            // Month display
            echo '<li class="item-month"><span class="active bread-month">' . esc_html( get_the_time('M') ) . '</span></li>';
               
        } elseif ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current"><span class="active bread-current">' . esc_html( get_the_time('Y') ) . ' </span></li>';
               
        } elseif ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            /* translators: %s is replaced with "string". It will display the author name */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Author: %s', 'bizberg' ) , esc_html( $userdata->display_name ) ) . '</span></li>';
           
        } elseif ( is_search() ) {
           
           $search_title = explode( ',' , get_search_query() );

            /* translators: %s is replaced with "string". It will display the search title */
            echo '<li class="item-current"><span class="active bread-current">' . sprintf( esc_html__( 'Search results for: %s' , 'bizberg' ) , esc_html( $search_title[0] ) ) . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li class="active">' . esc_html__( 'Error 404' , 'bizberg' ) . '</li>';
        } elseif( is_tax() ){

        	$term = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );

	        $tmpTerm = $term;
	        $tmpCrumbs = array();
	        while ($tmpTerm->parent > 0){
	            $tmpTerm = get_term($tmpTerm->parent, get_query_var("taxonomy"));
	            $crumb = '<li><a href="' . esc_url( get_term_link($tmpTerm, get_query_var('taxonomy')) ) . '">' . esc_html( $tmpTerm->name ) . '</a></li>';
	            array_push($tmpCrumbs, $crumb);
	        }
	        echo implode('', array_reverse($tmpCrumbs));
	        echo '<li class="item-current item-cat"><span class="active bread-current bread-cat">' . esc_html( $term->name ) . '</span></li>';

        }
                  
    }
       
}

if( !function_exists( 'bizberg_get_copyright_section' ) ){

	function bizberg_get_copyright_section(){

		esc_html_e( 'Copyright &copy;', 'bizberg' ); 
		echo date_i18n( __( 'Y' , 'bizberg' ) ); ?> 
				
		<?php bloginfo( 'name' ); ?>

		<?php 

		esc_html_e( '. All rights reserved. ', 'bizberg' ); 

		echo '<span class="bizberg_copyright_inner">';

		printf( 
			esc_html__( 'Powered %1$s by %2$s', 'bizberg' ), 
			'', 
			'<a href="https://wordpress.org/" target="_blank">WordPress</a>' ); 

		?>

	    <span class="sep"> &amp; </span>

	    <?php esc_html_e( 'Designed by', 'bizberg' ); ?> 

	    <a href="<?php echo esc_url( 'https://bizbergthemes.com/'); ?>" target="_blank">
	    	<?php esc_html_e( 'Bizberg Themes', 'bizberg' ); ?>
	    </a>

	    <?php

	    echo '</span>';

	}

}

function bizberg_get_comments_number( $post ){

	$no_of_comments = get_comments_number( $post->ID );

	echo '<a href="' . esc_url( get_comments_link() ) . '"><i class="far fa-comments"></i> ';
	echo absint( $no_of_comments );	
	echo '</a>';

}

add_action( 'admin_notices', 'bizberg_admin_notice_demo_data' );
function bizberg_admin_notice_demo_data() {

	// Hide bizberg admin message
	if( !empty( $_GET['status'] ) && $_GET['status'] == 'bizberg_hide_msg' ){
		update_option( 'bizberg_hide_msg', true );
	}

	$status = get_option( 'bizberg_hide_msg' );
	if( $status == true ){
		return;
	} 

	$recommended_plugins = apply_filters( 'bizberg_plugins', $plugins = array() );
	
	if( empty( $recommended_plugins ) ){
		return;
	}

	$my_theme = wp_get_theme();
	$theme_name = $my_theme->get( 'Name' );
	$nonce = wp_create_nonce("bizberg_install_plugins");

	?>

    <div class="theme-info-start notice notice-info">

    	<div class="theme-info-wrapper" style="padding: 20px 20px 20px 5px;">

	        <?php 
	        echo '<strong style="font-size: 20px; padding-bottom: 10px; display: block;">';
	        printf(
	        	esc_html__( 'Thank you for installing %1$s', 'bizberg' ),
	        	$theme_name
	        ); 
	        echo '</strong>';
	        echo '<p>' . esc_html__( "It comes with prebuild templates so that you don't have to build it from the start. Clicking the button below will install all the recommended plugins for this theme." , 'bizberg' ) . '</p>';
	        ?>

	        <div class="button_wrapper_theme" style="margin-top: 20px;">
		        <a 
		        href="javascript:void(0)" 
		        class="button button-primary button-hero bizberg_install_plugins" 
		        data-nonce="<?php echo esc_attr( $nonce ); ?>"
		        data-redirect="<?php echo esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ); ?>"
		        >
		        <i class="fas fa-sync fa-spin" style="display: none;"></i>
		        <span><?php esc_html_e( 'Get Started', 'bizberg' ) ?></span>
		    	</a>

		        <a 
		        href="<?php echo esc_url( admin_url('/?status=bizberg_hide_msg') ); ?>" 
		        class="button button-default button-hero bizberg_dismiss" ><?php esc_html_e( 'Close', 'bizberg' ) ?></a>
	        </div>

        </div>
        
    </div>
    
    <?php
}

add_filter( 'bizberg_plugins', function(){

	$plugins = array(
		array(
			'slug' => 'one-click-demo-import/one-click-demo-import.php',
			'zip'  => 'one-click-demo-import'
		),
		array(
			'slug' => 'contact-form-7/wp-contact-form-7.php',
			'zip'  => 'contact-form-7'
		),
		array(
			'slug' => 'elementor/elementor.php',
			'zip'  => 'elementor'
		),
		array(
			'slug' => 'essential-addons-for-elementor-lite/essential_adons_elementor.php',
			'zip'  => 'essential-addons-for-elementor-lite'
		),	
		array(
			'slug' => 'cyclone-demo-importer/index.php',
			'zip'  => 'cyclone-demo-importer'
		)			
	);

	return $plugins;

});

add_action( 'tgmpa_register', 'bizberg_register_required_plugins' );
function bizberg_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_html__( 'One Click Demo Import', 'bizberg' ),
			'slug' => 'one-click-demo-import',
			'required'=> false,
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'bizberg' ),
			'slug' => 'contact-form-7',
			'required'=> false,
		),
		array(
            'name' => esc_html__( 'Elementor Page Builder', 'bizberg' ),
            'slug' => 'elementor',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Essential Addons for Elementor', 'bizberg' ),
            'slug' => 'essential-addons-for-elementor-lite',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Cyclone Demo Importer', 'bizberg' ),
            'slug' => 'cyclone-demo-importer',
            'required' => false
        ),

	);

	$plugins = apply_filters( 'bizberg_recommended_plugins', $plugins );

	$config = array(
		'id'           => 'bizberg_tgmpa',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => ''                   // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

function bizberg_get_homepage_style_class(){

	if( is_page_template( 'page-templates/page-fullwidth-transparent-header.php' ) ){
		return 'page-fullwidth-transparent-header theme-sticky';
	} elseif( is_page_template( 'page-templates/page-fullwidth-transparent-header-border.php' ) ){
		return 'page-fullwidth-transparent-header-border';
	} elseif( is_page_template( 'page-templates/full-width.php' ) ){
		return 'page-fullwidth';
	}

}

add_filter('wp_nav_menu_items', 'bizberg_add_items_on_menus', 10, 2);
function bizberg_add_items_on_menus( $items, $args ) {

    if( $args->theme_location == 'menu-1' ){ 

    	$search_status = bizberg_get_theme_mod( 'header_search' );
    	$header_button = bizberg_get_theme_mod( 'header_button' );

    	ob_start(); 

    	/**
		* @param boolean $search_status
		* If true show the search icon
    	*/

    	if( empty( $search_status ) ){ ?>

	    	<li class="menu-item search_wrapper">
	    		<div class="header-search">
					<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
				</div>
	    	</li>

	    	<?php 
	    } 

	    if( empty( $header_button ) ){ ?>

		    <li class="menu-item header_search_wrapper header_btn_wrapper">
		    	<?php bizberg_get_menu_btn(); ?>
		    </li>

	    	<?php
	    }

    	$content = ob_get_clean();
      	$items .= $content;
    }

    return $items;

}

/**
* @param boolean $header_button
* If true show the button
*/

function bizberg_get_menu_btn(){

	$header_button = get_theme_mod( 'header_button', false );
	if( !empty( $header_button ) ){
		return;
	}
	
    $header_button_label = get_theme_mod( 'header_button_label', 'Buy Now' );
    $header_button_link = get_theme_mod( 'header_button_link', '#' ); ?>
    	
	<a href="<?php echo esc_url( $header_button_link ); ?>" class="btn btn-primary menu_custom_btn">
		<?php 
		echo esc_html( $header_button_label );
		?>
	</a>
        
    <?php

}

if( !function_exists( 'bizberg_get_footer' ) ){
	function bizberg_get_footer(){ 
		bizberg_get_footer_5();
	}
}

function bizberg_get_footer_social_links(){

	$social_icons = bizberg_get_theme_mod( 'footer_social_links' );
	$content = '';

    if( !empty( $social_icons ) && is_array( $social_icons ) ){

    	ob_start();

        echo '<ul class="social-net">';
        $count = 0.2;
        foreach( $social_icons as $value ){
            echo '<li class="wow fadeInUp animated" data-wow-delay="' . esc_attr( $count ) . 's" data-wow-offset="50"><a target="' . ( !empty( $value['target'] ) ? 'blank' : '' ) . '" href="' . esc_url( $value['link'] ) . '"><i class="' . esc_attr( $value['icon'] ) . '"></i></a></li>';
            $count = $count + 0.2;
        }
        echo '</ul>';

        $content = ob_get_clean();
        return $content;

    }

    return $content;

}

function bizberg_get_footer_5(){ 

	$social_icons = bizberg_get_footer_social_links(); ?>

	<footer 
	id="footer" 
	class="footer-style"
	style="<?php echo ( empty( $social_icons ) ? 'padding-top: 20px;' : '' ); ?>">

	    <div class="container">

	    	<?php 
	    	if( !empty( $social_icons ) ){ ?>
		    	<div class="footer_social_links">
			        <?php 
			        echo wp_kses_post( $social_icons );
			        ?>
		        </div>
		        <?php 
		    } ?>

	        <?php
	        wp_nav_menu( array(
	            'theme_location' => 'footer',
	            'menu_class'=>'inline-menu',
	            'container' => 'ul',
	            'depth' => 1
	        ) );
	        ?>

	        <p class="copyright">
	            <?php bizberg_get_copyright_section(); ?>
	        </p>
	    </div>
	</footer>

	<?php
}

if( !function_exists('bizberg_adjustBrightness') ){

	function bizberg_adjustBrightness( $hexCode, $adjustPercent = '-0.2' ) {

	  	$hexCode = ltrim($hexCode, '#');

	    if (strlen($hexCode) == 3) {
	        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
	    }

	    $hexCode = array_map('hexdec', str_split($hexCode, 2));

	    foreach ($hexCode as & $color) {
	        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
	        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

	        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
	    }

	    return '#' . implode($hexCode);

	}

}

add_filter( 'kirki_telemetry', '__return_false' );

function bizberg_check_sidebar_active_inactive_class(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){

		return 'col-md-8 col-sm-12 content-wrapper bizberg_blog_content';
		
	}
	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_blog_title_class(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){
		return 'col-sm-12';
	}

	return 'col-sm-10 col-sm-offset-1';

}

function bizberg_check_sidebar_active_inactive_class_home(){

	if( is_active_sidebar( 'sidebar-2' ) || in_array( bizberg_sidebar_position() , array( 'blog-nosidebar-1' , 'blog-nosidebar'  ) ) ){
		return 'col-md-8 col-sm-12 content-wrapper bizberg_blog_content';
	}

	return 'col-sm-10 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

function bizberg_check_sidebar_active_inactive_class_page(){

	if( class_exists( 'WooCommerce' ) ){

		if( is_cart() || is_checkout() || is_account_page() ){

			return 'col-sm-12 col-xs-12 content-wrapper';

		}

	}

	if( is_active_sidebar( 'sidebar-2' ) ){
		return 'col-md-8 col-sm-12 col-xs-12 content-wrapper bizberg_blog_content';
	}

	return 'col-sm-10 col-xs-12 content-wrapper col-sm-offset-1 content-wrapper-no-sidebar';

}

if ( ! function_exists( 'bizberg_get_theme_mod' ) ) {
  	function bizberg_get_theme_mod( $field_id, $default_value = '' ) {
    	if ( $field_id ) {
      	if ( !$default_value ) {
        		if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
          		$default_value = Kirki::$fields[ $field_id ]['default'];
        		}
      	}
      	$value = get_theme_mod( $field_id, $default_value );
      	return $value;
    	}
    	return false;
  	}
}

function bizberg_blog_read_time( $post ){

	$words_per_minute = 225;
	$words_per_second = $words_per_minute / 60;

	// Count the words in the content.
	$word_count = str_word_count( strip_tags( $post->post_content ) );

	// [UNUSED] How many minutes?
	$minutes = floor( $word_count / $words_per_minute );

	// [UNUSED] How many seconds (remainder)?
	$seconds_remainder = floor( $word_count % $words_per_minute / $words_per_second );

	// How many seconds (total)?
	$seconds_total = floor( $word_count / $words_per_second );

	echo wp_kses_post( '<i class="far fa-clock"></i> ' . bizberg_blog_convert_read_time($seconds_total) );

}

function bizberg_blog_convert_read_time( $seconds ){

    $string = "";

	$days = intval(intval($seconds) / (3600*24));
	$hours = (intval($seconds) / 3600) % 24;
	$minutes = (intval($seconds) / 60) % 60;
	$seconds = (intval($seconds)) % 60;

	if($days> 0){
	    $string .= "$days " . esc_html__( 'days read', 'bizberg' );
	    return $string;
	}
	if($hours > 0){
	    $string .= "$hours " . esc_html__( 'hrs read', 'bizberg' );
	    return $string;
	}
	if($minutes > 0){
	    $string .= "$minutes " . esc_html__( 'min read', 'bizberg' );
	    return $string;
	}
	if ($seconds > 0){
	    $string .= "$seconds " . esc_html__( 'sec read', 'bizberg' );
	    return $string;
	}

	return $string;
}

function bizberg_get_primary_header_logo(){

	$logo_url = bizberg_get_theme_mod( 'logo_site_title_custom_url' );
	$logo_url = $logo_url ? $logo_url : home_url('/');
	
	$new_tab = bizberg_get_theme_mod( 'logo_site_title_custom_url_new_tab' ) ? '_blank' : '_self'; ?>

	<a 
    class="logo pull-left <?php echo ( has_custom_logo() || !empty( get_bloginfo( 'description' ) ) ? '' : 'bizberg_no_tagline' ); ?>" 
    href="<?php echo esc_url( $logo_url ); ?>" 
    target="<?php echo esc_attr( $new_tab ); ?>">

    	<?php 
    	$transparent_header_logo = bizberg_get_theme_mod( 'transparent_header_logo' );

    	/**
		* If transparent header is enabled on the page
    	*/

    	if ( bizberg_check_transparent_header() && !empty( $transparent_header_logo ) ) { ?>

        	<img 
        	src="<?php echo esc_url( bizberg_get_custom_logo_link() ); ?>" 
        	alt="<?php esc_attr_e( 'Logo', 'bizberg' ) ?>" 
        	class="site_logo transparent_header_logo_image1">
        	<?php 
        	do_action( 'bizberg_top_logo' );

        } elseif( has_custom_logo() ){ ?>

        	<img 
        	src="<?php echo esc_url( bizberg_get_custom_logo_link() ); ?>" 
        	alt="<?php esc_attr_e( 'Logo', 'bizberg' ) ?>" 
        	class="site_logo">

        	<?php

        } else {
        	echo '<h3 class="header_site_title">' . esc_html( get_bloginfo( 'name' ) ) . '</h3>';

        	if( !empty( get_bloginfo( 'description' ) ) ){
        		echo '<p class="header_site_description">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
        	}

        } ?>

    </a>

	<?php
}

add_action( 'bizberg_top_logo', 'bizberg_display_transparent_sticky_logo_on_menu' );
function bizberg_display_transparent_sticky_logo_on_menu(){

	// get sticky logo
	$sticky_transparent_header_logo = bizberg_get_theme_mod( 'sticky_transparent_header_logo' );

	// if no sticky logo, take the transparent header logo
	$sticky_transparent_header_logo = empty( $sticky_transparent_header_logo ) ? bizberg_get_custom_logo_link() : $sticky_transparent_header_logo;

	// Check if transparent header is active or not on the page
	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );

	if( !empty( $sticky_transparent_header_logo ) && bizberg_check_transparent_header() ){
		echo '<img src="' . esc_url( $sticky_transparent_header_logo ) . '" alt="' . esc_attr__( 'Logo', 'bizberg' ) . '" class="transparent_sticky_logo_header" style="display:none;"/>';	
	}	
}

function bizberg_get_last_item_header(){

	$last_item_header = bizberg_get_theme_mod( 'last_item_header' );
	$last_item_html = bizberg_get_theme_mod('last_item_html');

	switch ( $last_item_header ) {

		case 'text':
			echo do_shortcode( $last_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_last_item_header_logo_center(){

	$last_item_header = bizberg_get_theme_mod( 'last_item_header_logo_center' );
	$last_item_html = bizberg_get_theme_mod('last_item_html_logo_center');

	switch ( $last_item_header ) {

		case 'text':
			echo do_shortcode( $last_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;

		case 'social_icons':

			echo '<div class="bizberg_header_social_icon_right">';
			echo bizberg_get_header_social_icons( 'last_item_social_links' );
			echo '</div>';

			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_first_item_header_logo_center(){

	$first_item_header = bizberg_get_theme_mod( 'first_item_header_logo_center' );
	$first_item_html = bizberg_get_theme_mod('first_item_html_logo_center');

	switch ( $first_item_header ) {

		case 'text':
			echo do_shortcode( $first_item_html );
			break;

		case 'widget':
			if( is_active_sidebar( 'bizberg_header_left' ) ){
				echo '<div class="header_widget_section">';
				dynamic_sidebar( 'bizberg_header_left' );
				echo '</div>';
			} else {
				if( current_user_can( 'administrator' ) ){
					echo '<a href="' . esc_url( admin_url( '/customize.php?autofocus[panel]=widgets' ) ) . '">' . esc_html__( 'ADD WIDGET', 'bizberg' ) . '</a>';
				}
			}		
			break;

		case 'social_icons':

			echo '<div class="bizberg_header_social_icon_left">';
			echo bizberg_get_header_social_icons( 'first_item_social_links' );
			echo '</div>';

			break;
		
		default:
			# code...
			break;
	}

}

function bizberg_get_header_social_icons( $name ){

	ob_start();

	$first_item_social_links = bizberg_get_theme_mod( $name );

	if( !empty( $first_item_social_links ) && is_array( $first_item_social_links ) ){

		foreach ( $first_item_social_links as $key => $value ) {

		 	$icon = !empty( $value['icon'] ) ? sanitize_text_field( $value['icon'] ) : '';
		 	$link_url = !empty( $value['link_url'] ) ? sanitize_text_field( $value['link_url'] ) : '#';
		 	$color = !empty( $value['color'] ) ? sanitize_text_field( $value['color'] ) : '#000'; ?>

			<a 
			href="<?php echo esc_url( $link_url ); ?>" 
			class="bizberg_header_icon"
			style="color: <?php echo esc_attr( $color ); ?>">
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			</a>

			<?php

		}

	}

	return ob_get_clean();

}

function bizberg_upgrade_msg( $msg = '', $btn_link = '#', $btn_label = '' ){

    ob_start();

    if( empty( $btn_label ) ){
        $btn_label = esc_html__( 'Upgrade to PRO' , 'bizberg' );
    } ?>

    <div class="upgrade_pro">        
        <p><?php echo esc_html( $msg ); ?></p>
        <a href="<?php echo esc_html( $btn_link ); ?>" target="_blank">
            <?php echo esc_html( $btn_label ); ?>        
        </a>
    </div>

    <?php

    return ob_get_clean();
}

add_action( 'bizberg_top_header', 'bizberg_top_header_pro' );
function bizberg_top_header_pro(){ 

	$top_header_status = bizberg_get_theme_mod( 'top_header_status' );
	$top_header_status_mobile = bizberg_get_theme_mod( 'top_header_status_mobile' );

	/**
	* @param $top_header_status (boolean)
	* if true, don't show the top header
	*/

	if( $top_header_status == true ){
		return;
	} ?>

	<div id="top-bar" class="<?php echo esc_attr( $top_header_status_mobile ? 'enable_top_bar_mobile' : '' ); ?>">
		<div class="container">
			<div class="row">
				<div class="top_bar_wrapper">
					<div class="col-sm-4 col-xs-12">

						<?php 
						bizberg_get_header_social_links();
						?>

					</div>
					<div class="col-sm-8 col-xs-12">
						<div class="top-bar-right">
		                   	<ul class="infobox_header_wrapper">	                   		
		                   		<?php 
		                   		bizberg_get_infobox_header();
		                   		?>
		                   	</ul>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
}

function bizberg_get_infobox_header(){

	$icon1 = get_theme_mod( 'top_header_fontawesome_1' , 'fas fa-mobile-alt' );
	$icon2 = get_theme_mod( 'top_header_fontawesome_2' , 'far fa-comment-alt' );
	$icon3 = get_theme_mod( 'top_header_fontawesome_3' , 'fas fa-map-marker' );

	$label1 = get_theme_mod( 'top_header_text_1' , '9849-xxx-xxx' );
	$label2 = get_theme_mod( 'top_header_text_2' , 'noreply@example.com' );
	$label3 = get_theme_mod( 'top_header_text_3' , esc_html__( 'Tyagal, Patan, Lalitpur' , 'bizberg' ) );

	$infobox1 = get_theme_mod( 'top_header_infobox_1', true );
	$infobox2 = get_theme_mod( 'top_header_infobox_2', true );
	$infobox3 = get_theme_mod( 'top_header_infobox_3', true ); 

	$url1 = get_theme_mod( 'infobox_link_1', '' ); 
	$url2 = get_theme_mod( 'infobox_link_2', '' ); 
	$url3 = get_theme_mod( 'infobox_link_3', '' ); 

	$target_1 = bizberg_get_theme_mod( 'open_in_new_tab_1' ); 
	$target_2 = bizberg_get_theme_mod( 'open_in_new_tab_2' ); 
	$target_3 = bizberg_get_theme_mod( 'open_in_new_tab_3' ); 

	if( !empty( $infobox1 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url1 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_1 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url1 ); ?>">
				<?php
			}
			?>	

				<i class="<?php echo esc_attr( $icon1 ); ?>"></i> <?php echo esc_html( $label1 ); ?>

			<?php 
			if( !empty( $url1 ) ){ ?>
				</a>
				<?php
			}
			?>			
		</li>
		<?php 
	} 

	if( !empty( $infobox2 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url2 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_2 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url2 ); ?>">
				<?php
			}
			?>

				<i class="<?php echo esc_attr( $icon2 ); ?>"></i> <?php echo esc_html( $label2 ); ?>

			<?php 
			if( !empty( $url2 ) ){ ?>
				</a>
				<?php
			}
			?>	
		</li>
		<?php 
	}  

	if( !empty( $infobox3 ) ){ ?>
		<li>
			<?php 
			if( !empty( $url3 ) ){ ?>
				<a 
				target="<?php echo !empty( $target_3 ) ? '_blank' : ''; ?>"
				href="<?php echo esc_url( $url3 ); ?>">
				<?php
			}
			?>
			
				<i class="<?php echo esc_attr( $icon3 ); ?>"></i> <?php echo esc_html( $label3 ); ?>

			<?php 
			if( !empty( $url3 ) ){ ?>
				</a>
				<?php
			}
			?>
		</li>
		<?php 
	} 

}

function bizberg_get_header_social_links(){
	
	$social_links_header = get_theme_mod( 'header_social_links' , array() );

	if( !empty( $social_links_header ) && is_array( $social_links_header ) ){ ?>

		<div id="top-social-left" class="header_social_links">

			<ul>
				<?php 
				foreach ($social_links_header as $key => $value) { ?>

				 	<li>
						<a 
						href="<?php echo esc_url( $value['link'] ); ?>"
						class="<?php echo 'social_links_header_' . $key; ?>"
						target="<?php echo ( !empty( $value['target'] ) ? '_blank' : '_self' ); ?>">
							<span class="ts-icon">
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							</span>
							<span class="ts-text">
								<?php echo esc_html( $value['label'] ); ?>
							</span>
						</a>
					</li>	
					<style>
						#top-social-left li:hover a.<?php echo 'social_links_header_' . $key; ?> {
						    background: <?php echo esc_attr( $value['backgroundColor'] ); ?>;
						}
					</style>

				 	<?php
				} ?>								
			
			</ul>

		</div>

		<?php 
	} 

}

/**
* Transparent Header
*/

add_filter( 'body_class', 'bizberg_transparent_header_class' );
function bizberg_transparent_header_class( $classes ) {

	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );

	if( $transparent_header_homepage && ( is_home() || is_front_page() ) ){
		$classes[] = 'bizberg_transparent_header';
		return $classes;
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return $classes;
	}

    if ( is_page( $pages ) ) {
        $classes[] = 'bizberg_transparent_header';
    }

    return $classes;
}

function bizberg_get_transparent_header_page_ids(){

	$transparent_header_pages = bizberg_get_theme_mod('transparent_header_pages');
	
	if( empty( $transparent_header_pages ) ){
		return;
	}

	$pages = array();
	foreach ( $transparent_header_pages as $value ) {
		$pages[] = $value['page_id'];
	}

	return $pages;

}

add_filter( 'theme_mod_custom_logo', 'bizberg_set_page_options_custom_logo' , 999 );
function bizberg_set_page_options_custom_logo( $default ){
	return bizberg_get_page_options_header( 'transparent_header_logo' , $default );
}

function bizberg_get_page_options_header( $name , $default ){

	$transparent_header_homepage = bizberg_get_theme_mod( 'transparent_header_homepage' );
	$transparent_header_logo_id = bizberg_get_theme_mod( $name );

	if( $transparent_header_homepage && ( is_home() || is_front_page() ) ){
		if( empty( $transparent_header_logo_id ) ){
			return $default;
		} else {
			return $transparent_header_logo_id;
		}
	}

	$pages = bizberg_get_transparent_header_page_ids();

	if( empty( $pages ) ){
		return $default;
	}

	if( !is_page( $pages ) ){
		return $default;
	}

	if( empty( $transparent_header_logo_id ) ){
		return $default;
	}

	return $transparent_header_logo_id;

}

function bizberg_get_pro_link(){
	
	$theme = wp_get_theme();
	$textdomain = $theme->get( 'TextDomain' );

	switch ( $textdomain ) {

		case 'bizberg':
			return 'https://bizbergthemes.com/downloads/bizberg-pro/';
			break;

		case 'happy-wedding-day':
			return 'https://bizbergthemes.com/downloads/happy-wedding-day-pro/';
			break;

		case 'dr-life-saver':
			return 'https://bizbergthemes.com/downloads/dr-life-saver-pro/';
			break;

		case 'pizza-hub':
			return 'https://bizbergthemes.com/downloads/pizza-hub-pro/';
			break;

		case 'professional-education-consultancy':
			return 'https://bizbergthemes.com/downloads/professional-education-consultancy-pro/';
			break;

		case 'green-eco-planet':
			return 'https://bizbergthemes.com/downloads/green-eco-planet-pro/';
			break;

		case 'education-business':
			return 'https://bizbergthemes.com/downloads/education-business-pro/';
			break;

		case 'building-construction-architecture':
			return 'https://bizbergthemes.com/downloads/building-construction-architecture-pro/';
			break;

		case 'ngo-charity-fundraising':
			return 'https://bizbergthemes.com/downloads/ngo-charity-fundraising-pro/';
			break;

		case 'business-event':
			return 'https://bizbergthemes.com/downloads/business-event-pro/';
			break;

		case 'my-travel-blogs':
			return 'https://bizbergthemes.com/downloads/my-travel-blogs-pro/';
			break;

		case 'eye-catching-blog':
			return 'https://bizbergthemes.com/downloads/eye-catching-blog-pro/';
			break;

		case 'bizberg-consulting-dark':
			return 'https://bizbergthemes.com/downloads/bizberg-consulting-dark-pro/';
			break;

		case 'omg-blog':
			return 'https://bizbergthemes.com/downloads/omg-blog-pro/';
			break;

		case 'next-level-blog':
			return 'https://bizbergthemes.com/downloads/next-level-blog-pro/';
			break;

		case 'bizberg-shop':
			return 'https://bizbergthemes.com/downloads/bizberg-shop-pro/';
			break;

		case 'oh-my-blog':
			return 'https://bizbergthemes.com/downloads/oh-my-blog-pro/';
			break;
		
		default:
			return false;
			break;
	}

}