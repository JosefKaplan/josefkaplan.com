<?php
/*
 * This class provide the sitemap to Manduca sitemap page
 *
 *@since 17.10
 *
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

    Source code is available at https://github.com/batyuvitez/manduca
    Manduca is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/

namespace Manduca;


class Sitemap {
	
	
	public function authors() {
		$args = array(
					  'exclude_admin' 	=> true,
					  'echo'			=> false
					  ); 
	
		return '<ol>' .wp_list_authors( $args ) .'</ol>';
	}
	
	/*
	 *@param: $excludes (array): Contains the post_id of the pages to exclude from sitemap
	 **/
	public function pages( $excludes = NULL) {
		$args = array(
			'depth'        => 0,
			'show_date'    => '',
			'date_format'  => get_option( 'date_format' ),
			'child_of'     => 0,
			'exclude'      => '',
			'title_li'     => '',
			'echo'         => false,
			'authors'      => '',
			'sort_column'  => 'post_title',
			'link_before'  => '',
			'link_after'   => '',
			'item_spacing' => 'preserve',
			'walker'       => '',
		);
		$pages = get_pages( $args );
		$current_page = get_queried_object_id();
		$output = '';
		foreach( $pages as $page ) {
			if( $excludes && in_array( $page->ID, $excludes ) ) {
				continue;
			}
			if( $page->ID == $current_page ) {
				$item = sprintf( '<span class="screen-reader-text">%1$s </span><span>%2$s</span>',
								   __( 'Current page', 'manduca' ),
								   $page->post_title 
				);
			}
			else{
				$item = sprintf( '<a href="%1$s">%2$s</a>',
								   get_permalink( $page->ID ),
								   $page->post_title );
			}
			$output .= sprintf( '<li>%s</li>', $item );
			
		}
		return sprintf( '<ul>%s</ul>', $output );
	}
 
 
	 
	public function posts_by_category( $exclude_categories = array() ){
		$defaults = array(
			'child_of'            => 0,
			'current_category'    => 0,
			'depth'               => 0,
			'echo'                => false,
			'exclude'             => '',
			'exclude_tree'        => '',
			'hide_empty'          => 1,
			'hide_title_if_empty' => false,
			'hierarchical'        => true,
			'order'               => 'ASC',
			'orderby'             => 'name',
			'separator'           => '<br />',
			'show_count'          => 0,
			'show_option_all'     => '',
			'show_option_none'    => __( 'No categories' ),
			'style'               => 'list',
			'taxonomy'            => 'category',
			'title_li'            => __( 'Categories' ),
			'use_desc_for_title'  => 1,
		);
		
		$categories = get_categories( $defaults );
		foreach( $categories as $key => $category){
				if( in_array( $category->term_id, $exclude_categories )  ) {
					unset( $categories[ $key ] );
				}
		}
		$args = array( $categories, '', $defaults);
		$walker = new Walker_Sitemap_Category;
		return  call_user_func_array( array( $walker, 'walk' ), $args );		
				
	}
 
 
 
 
	
	public function posts_in_abc() {
		$html = '<ol>';	
		$list_posts = new \WP_Query( array( 
			'post_type'       => 'post', 
			'posts_per_page'  => -1, 
			'post_status'     => 'publish',
			'order'           => 'ASC',
			'orderby'         => 'title'
			) );
	
		$html .= $this->create_list_elements( $list_posts );
		$html .= '</ol>';
		return $html;
	}
	
	
	public function images() {
		$html = '<ol>';
		$query_images_args = array(
		  'post_type' => 'attachment',
		  'post_mime_type' =>'image',
		  'post_status' => 'inherit',
		  'posts_per_page' => -1,
		  'order'           => 'ASC',
		  'orderby'         => 'title'
	  );
			  
		$query_images = new \WP_Query( $query_images_args );
		$images = array();
		foreach ( $query_images->posts as $image) {
			setup_postdata( $image );
			
			$post_title = $image->post_title;
			// This can be empty 
			if( empty( $post_title)  ) {
				//translators: When image has no title, indicated with this text in sitemap.
				$post_title = __( 'No title', 'manduca' ) ;
			}
			
			$html .= sprintf( '<li><a href="%1$s">%2$s</a></li>',
				   get_attachment_link( $image->ID ),
				   $post_title
				   );
			
		}
		
		$html .= '</ol>';
		return $html;
	}

	
	
	public function pdfs(){
		$query_pdf = new \WP_Query( array(
				'post_type' => 'attachment',
				'post_mime_type' =>'application/pdf',
				'post_status' => 'inherit',
				'posts_per_page' => -1,
				'order'           => 'ASC',
				'orderby'         => 'title'
			)
		);
		
		$pdf = array();
	   
		//If is there any PDF? 
		If( $query_pdf->post_count  > 0 ) {
				$html = '<ol>';
		 
				foreach ( $query_pdf->posts as $pdf) {
						setup_postdata($pdf);
			
						$html .= sprintf( '<li><a href="%1$s">%2$s</a></li>',
							   wp_get_attachment_url( $pdf->ID ),
							   $pdf->post_title
							   );			
				}
				$html .= '</ol>';
				return $html;
		}
		else {
				return '';
		}
	  
	}
	
	
	/*
	 * Create list elements from query
	 * */
	protected function create_list_elements( $query ) {
		$html = '';
		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= sprintf( '<li><a href="%1$s">%2$s</a></li>',
				   get_permalink(),
				   get_the_title()
				  );
		}
		return $html;
	}
}