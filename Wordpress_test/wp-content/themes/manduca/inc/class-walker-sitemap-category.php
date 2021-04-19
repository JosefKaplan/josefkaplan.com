<?php

 /* Used by Sitemap class to display posts by categories in hidable headings 
  *
  *@since 19.3
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

class Walker_Sitemap_Category extends \Walker_Category {
   	/**
	 * This walker returns the post links to the current category.
	 * If there is Yoast Seo, post inlcudes only in the primary category. 
	 *
	 *
	 * @param string $output   Used to append additional content (passed by reference).
	 * @param object $category Category data object.
	 * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
	 * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
	 * @param int    $id       Optional. ID of the current category. Default 0.
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = esc_attr( $category->name );

		// Don't generate an element if the category name is empty.
		if ( '' === $cat_name ) {
			return;
		}

		if ( !$depth ) {
         $output .= '<h3 class="js-expandmore">';
         $heading = 3;
		}
		else{
		   $heading = $depth +3;
		   $output .= "\t<h". $heading .' class="js-expandmore">';
		}
		$output.= $category->name .'</h' .$heading .">\n";
		
		$posts  = new  \WP_Query( [
					  'category__in' 			=> $category->cat_ID, 
					  'posts_per_page' => -1
				  ]);
		
			
		if( $posts->have_posts() ) {
			$list_html = '';
			while ( $posts->have_posts() ) {
				$posts->the_post();
				// If the post has more than 1 categories, check yoast for primary
				if( count(get_the_category() )!== 1 ){
					$yoast_primary_cat = (int) get_post_meta( get_the_ID(), '_yoast_wpseo_primary_category', true );
					if( $yoast_primary_cat && $yoast_primary_cat !== $category->cat_ID  ) {
							continue;
					}
				}
				$list_html.= sprintf( '<li><a href="%1$s">%2$s</a></li>',
					   get_permalink(),
					   get_the_title()
					  );
			}
			
			if( $list_html ){
				$output .= sprintf( '<ul class="js-to_expand">%s</ul>',
								   $list_html
					) ;	
			}
			
		}
		
	}
	
	
	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</div>\n";
	}
	
	
	/**
	 * Starts the list before the elements are added.
	 *
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent<div class='js-to_expand is-opened children'>\n";
	}
	
	
	/**
	 * Ends the element output, if needed.
	 *
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $page   Not used.
	 * @param int    $depth  Optional. Depth of category. Not used.
	 * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
	 *                       to output. See wp_list_categories(). Default empty array.
	 */
	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		return ;
	}

}