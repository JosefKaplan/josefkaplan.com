<?php
/*
 * Essential actions
 * since 1.0
 */

function consultus_do_home_slider(){

	if((is_front_page() || is_home()) && get_theme_mod('slider_in_home_page' , 1)) {
		get_template_part('templates/top', 'slider' );
	}

}
add_action('consultus_home_slider', 'consultus_do_home_slider');

function consultus_do_before_header(){
	get_template_part( 'templates/top', 'banner' ); 
}

add_action('consultus_before_header', 'consultus_do_before_header');


function consultus_do_header(){

		get_template_part( 'templates/contact', 'section' );
		
		do_action('consultus_before_header');
		
		$consultus_header = get_theme_mod('header_layout', 1);
		
		if ($consultus_header == 0) {
			do_action('business_architect_default_header');
			//woocommerce layout
		} else if($consultus_header == 1 && class_exists('WooCommerce')){
			do_action('business_architect_store_header');
			//list layout
		} else if ($consultus_header == 2){
			do_action('business_architect_burger_header');
		} else {
			//default layout			
			do_action('business_architect_default_header');
		}
		
		if(is_front_page()){
			get_template_part( 'templates/top', 'shortcode' );
		}
		


}

add_action('consultus_header', 'consultus_do_header');



/**
 * Theme Breadcrumbs
*/
if( !function_exists('consultus_page_header_breadcrumbs') ):
	function consultus_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = esc_url(home_url());
		$consultus_page_header_layout = get_theme_mod('consultus_page_header_layout', 'consultus_page_header_layout1');
		if($consultus_page_header_layout == 'consultus_page_header_layout1'):
			$breadcrumb_class = 'center-text';	
		else: $breadcrumb_class = 'text-right'; 
		endif;
		
		echo '<ul id="content" class="page-breadcrumb '.esc_attr( $breadcrumb_class ).'">';			
			if (is_home() || is_front_page()) :
					echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','consultus').'</a></li>';
					    echo '<li class="active">'; echo single_post_title(); echo '</li>';
						else:
						echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','consultus').'</a></li>';
						if ( is_category() ) {
							echo '<li class="active"><a href="'. esc_url( consultus_page_url() ) .'">' . esc_html__('Archive by category','consultus').' "' . single_cat_title('', false) . '"</a></li>';
						} elseif ( is_day() ) {
							echo '<li class="active"><a href="'. esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">'. esc_html(get_the_time('Y')) .'</a>';
							echo '<li class="active"><a href="'. esc_url(get_month_link(esc_attr(get_the_time('Y')),esc_attr(get_the_time('m')))) .'">'. esc_html(get_the_time('F')) .'</a>';
							echo '<li class="active"><a href="'. esc_url( consultus_page_url() ) .'">'. esc_html(get_the_time('d')) .'</a></li>';
						} elseif ( is_month() ) {
							echo '<li class="active"><a href="' . esc_url( get_year_link(esc_attr(get_the_time('Y'))) ) . '">' . esc_html(get_the_time('Y')) . '</a>';
							echo '<li class="active"><a href="'. esc_url( consultus_page_url() ) .'">'. esc_html(get_the_time('F')) .'</a></li>';
						} elseif ( is_year() ) {
							echo '<li class="active"><a href="'. esc_url( consultus_page_url() ) .'">'. esc_html(get_the_time('Y')) .'</a></li>';
                        } elseif ( is_single() && !is_attachment() && is_page('single-product') ) {
						if ( get_post_type() != 'post' ) {
							$cat = get_the_category(); 
							$cat = $cat[0];
							echo '<li>';
								echo esc_html( get_category_parents($cat, TRUE, '') );
							echo '</li>';
							echo '<li class="active"><a href="' . esc_url( consultus_page_url() ) . '">'. wp_title( '',false ) .'</a></li>';
						} }  
						elseif ( is_page() && $post->post_parent ) {
							$parent_id  = $post->post_parent;
							$breadcrumbs = array();
							while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li class="active"><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html( get_the_title($page->ID)) . '</a>';
							$parent_id  = $page->post_parent;
                            }
							$breadcrumbs = array_reverse($breadcrumbs);
							foreach ($breadcrumbs as $crumb) echo $crumb;
							echo '<li class="active"><a href="' .  esc_url( consultus_page_url()) . '">'. esc_html( get_the_title() ).'</a></li>';
                        }
						elseif( is_search() )
						{
							echo '<li class="active"><a href="' . esc_url( consultus_page_url() ) . '">'. get_search_query() .'</a></li>';
						}
						elseif( is_404() )
						{
							echo '<li class="active"><a href="' . esc_url( consultus_page_url() ) . '">'.esc_html__('Error 404','consultus').'</a></li>';
						}
						else { 
						    echo '<li class="active"><a href="' . esc_url( consultus_page_url() ) . '">'. esc_html( get_the_title() ) .'</a></li>';
						}
					endif;
			echo '</ul>';
        }
endif;


/**
 * Theme Breadcrumbs Url
*/
function consultus_page_url() {
	global $wp;
	$current_url = esc_url(home_url(add_query_arg(array(), $wp->request)));
	
	return $current_url;
}


