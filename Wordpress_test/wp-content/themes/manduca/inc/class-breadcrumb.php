<?php
/**
 * WordPress breadcrumb navigation
 *
 * 
**/


/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Original work Copyright Dominik Schilling (version 0.1.1 )
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)

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

 

abstract class Breadcrumb {
	/**
	 * The list of breadcrumb items.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	public $breadcrumb;

	/**
	 * Templates for link, current/standard state and before/after.
	 *
	 * @var array
	 */
	public $templates;

	/**
	 * Various strings.
	 *
	 * @var array
	 */
	public $strings;

	/**
	 * Various options.
	 *
	 * @var array
	 * @access public
	 */
	public $options;

	/*
	 * Function has to be declared in the template file
	 * tempalte-parts/header/breadcrumb
	 *
	 * set the customized variables to the breadcrumb 
	**/	
	abstract function customize_breadcrumb();

	/**
	 * Return the final breadcrumb.
	 *
	 * @return string
	 */
	public function output() {
		if ( empty( $this->breadcrumb ) ) {
			$this->generate();
		}
		
		$breadcrumb = (string) implode( '' , $this->breadcrumb );

		return $this->templates['before'] . $breadcrumb . $this->templates['after'];
	}

	/**
	 * Build the item based on the type.
	 *
	 * @param string|array $item
	 * @param string $type
	 * @return string
	 */
	protected function template( $item, $type = 'standard' ) {
		if ( is_array( $item ) )
			$type = 'link';

		switch ( $type ) {
			case'link':
				return $this->template(
					sprintf(
						$this->templates['link'],
						esc_url( $item['link'] ),
						$item['title']
					)
				);
				break;
			case 'current':
				return sprintf( $this->templates['current'], $item );
				break;
			case 'standard':
				return sprintf( $this->templates['standard'],  $item, $this->options[ 'separator' ] );
				break;
		}
	}

	/**
	 * Helper to generate taxonomy parents.
	 *
	 * @param mixed $term_id
	 * @param mixed $taxonomy
	 * @return void
	 */
	protected function generate_tax_parents( $term_id, $taxonomy ) {
		$parent_ids = array_reverse( get_ancestors( $term_id, $taxonomy ) );

		foreach ( $parent_ids as $parent_id ) {
			$term = get_term( $parent_id, $taxonomy );
			$this->breadcrumb["archive_{$taxonomy}_{$parent_id}"] = $this->template( array(
				'link' => get_term_link( $term->slug, $taxonomy ),
				'title' => $term->name
			) );
		}
	}

	/**
	 * Generate the breadcrumb.
	 *
	 * @return void
	 */
	public function generate() {
		$post_type = get_post_type();
		$queried_object = get_queried_object();
		$this->options['show_pagenum'] = ( $this->options['show_pagenum'] && is_paged() ) ? true : false;


		// Home & Front Page
		$this->breadcrumb['home'] = $this->template( $this->strings['home'], 'current' );
		$home_linked = $this->template( array(
			'link' => home_url( '/' ),
			'title' => $this->strings['home']
		) );


		if ( $this->options['posts_on_front'] ) {
			if ( ! is_home() || $this->options['show_pagenum'] )
				$this->breadcrumb['home'] = $home_linked;
		} else {
			if ( ! is_front_page() )
				$this->breadcrumb['home'] = $home_linked;

			if ( is_home() && !$this->options['show_pagenum'] )
				$this->breadcrumb['blog'] = $this->template( get_the_title( $this->options['page_for_posts'] ), 'current' );

			if ( ( 'post' == $post_type && ! is_search() && ! is_home() ) || ( 'post' == $post_type && $this->options['show_pagenum'] ) ) {
				$permalink = get_permalink( $this->options['page_for_posts'] );
				if( $permalink != get_permalink() ) {
					$this->breadcrumb['blog'] = $this->template( array(
						'link' => $permalink,
						'title' => get_the_title( $this->options['page_for_posts'] )
				) );
				}
			}
		}

		// Post Type Archive as index
		if ( $this->options['show_pta'] ) {
			if ( is_singular() || ( is_archive() && ! is_post_type_archive() ) || is_search() || $this->options['show_pagenum'] ) {
				
				$post_type_link = get_post_type_archive_link( $post_type );
				if ( $post_type_link  ) {
						
					$post_type_label = get_post_type_object( $post_type )->labels->name;
					
					$this->breadcrumb["archive_{$post_type}"] = $this->template(
						array(
						'link' => $post_type_link, 
						'title' => $post_type_label
					) );
				}
				
			}
			
		}
		
		
		// Show taxonomy
		if ( isset( $this->options['show_tax'] ) && $this->options['show_tax'] ) {
			
			if ( is_singular() ) {
			
				$taxonomy = $this->options['show_tax'];
				$term = get_the_terms( get_the_id(), $taxonomy );
							
				if( $term ) {
				 
				 	// Only the first term's parents. If Yoast Seo is active, you can check for the primary term. 
					$parents = get_ancestors( $term[0]->term_id, $taxonomy, 'taxonomy' );
								
					foreach ( array_reverse( $parents ) as $parent ) {
						
						$parent = get_term( $parent, $taxonomy );
				
						$link = esc_url( get_term_link( $parent->term_id, $taxonomy ) ); 
						
						$this->breadcrumb["archive_{$parent->term_id}"] = $this->template(
							array(
							'link' => $link, 
							'title' => $parent->name
						) );
					}
				}
			}
		}

		if ( is_singular() ) { // Posts, (Sub)Pages, Attachments and Custom Post Types
			if ( ! is_front_page() ) {
				if ( $this->options['show_htfpt'] ) {
					$_id = $queried_object->ID;
					$_post_type = $post_type;

					if ( is_attachment() ) {
						// Show terms of the parent page
						$_id = $queried_object->post_parent;
						$_post_type = get_post_type( $_id );
					}

					$taxonomies = get_object_taxonomies( $_post_type, 'objects' );
					$taxonomies = array_values( wp_list_filter( $taxonomies, array(
						'hierarchical' => true
					) ) );

					if ( ! empty( $taxonomies ) ) {
						$taxonomy = $taxonomies[0]->name; // Get the first taxonomy
						$terms = get_the_terms( $_id, $taxonomy );
						if( is_array ( $terms ) ) {
						$terms = array_values( $terms );
							if ( ! empty( $terms ) ) {
								$term = $terms[0];
								
								// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
								//since 18.10.17
								if ( 'category' == $taxonomy && class_exists('WPSEO_Primary_Term') ) {
									$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy , get_the_id() );
									$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
									if( $wpseo_primary_term ) { 
										$term = get_term( $wpseo_primary_term );
									}
								}
								if ( 0 != $term->parent ) {
									$this->generate_tax_parents( $term->term_id, $taxonomy );
								}
								$this->breadcrumb["archive_{$taxonomy}"] = $this->template( array(
									'link' => get_term_link( $term->slug, $taxonomy ),
									'title' => $term->name
								) );
							}
						}
					}
				}

				if ( 0 != $queried_object->post_parent ) { // Get Parents
					$parents = array_reverse( get_post_ancestors( $queried_object->ID ) );
					foreach ( $parents as $parent ) {
						$this->breadcrumb["archive_{$post_type}_{$parent}"] = $this->template( array(
							'link' => get_permalink( $parent ),
							'title' => get_the_title( $parent )
						) );
					}
				}

				$this->breadcrumb["single_{$post_type}"] = $this->template( get_the_title(), 'current' );
			}
		} elseif ( is_search() ) { // Search
			$total = $GLOBALS['wp_query']->found_posts;
			$text = sprintf( $this->strings['search'],
				$total,
				get_search_query()
			);
			
			
			$this->breadcrumb['search'] = $this->template( $text, 'current' );

			if ( $this->options['show_pagenum'] )
				$this->breadcrumb['search'] = $this->template( array(
					'link' => home_url( '?s=' . urlencode( get_search_query( false ) ) ),
					'title' => $text
				) );
		} elseif ( is_archive() ) { // All archive pages
			if ( is_category() || is_tag() || is_tax() ) { // Categories, Tags and Custom Taxonomies
				$taxonomy = $queried_object->taxonomy;

				if ( 0 != $queried_object->parent && is_taxonomy_hierarchical( $taxonomy ) ) // Get Parents
					$this->generate_tax_parents( $queried_object->term_id, $taxonomy );

				$this->breadcrumb["archive_{$taxonomy}"] = $this->template( $queried_object->name, 'current' );

				if ( $this->options['show_pagenum'] )
					$this->breadcrumb["archive_{$taxonomy}"] = $this->template( array(
						'link' => get_term_link( $queried_object->slug, $taxonomy ),
						'title' => $queried_object->name
					) );

			} elseif ( is_date() ) { // Date archive
				if ( is_year() ) { // Year archive
					$this->breadcrumb['archive_year'] = $this->template( get_the_date( 'Y' ), 'current' );

					if ( $this->options['show_pagenum'] )
						$this->breadcrumb['archive_year'] = $this->template( array(
							'link' => get_year_link( get_query_var( 'year' ) ),
							'title' => get_the_date( 'Y' )
						) );
				} elseif ( is_month() ) { // Month archive
					$this->breadcrumb['archive_year'] = $this->template( array(
						'link' => get_year_link( get_query_var( 'year' ) ),
						'title' => get_the_date( 'Y' )
					) );
					$this->breadcrumb['archive_month'] = $this->template( get_the_date( 'F' ), 'current' );

					if ( $this->options['show_pagenum'] )
						$this->breadcrumb['archive_month'] = $this->template( array(
							'link' => get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ),
							'title' => get_the_date( 'F' )
						) );
				} elseif ( is_day() ) { // Day archive
					$this->breadcrumb['archive_year'] = $this->template( array(
						'link' => get_year_link( get_query_var( 'year' ) ),
						'title' => get_the_date( 'Y' )
					) );
					$this->breadcrumb['archive_month'] = $this->template( array(
						'link' => get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ),
						'title' => get_the_date( 'F' )
					) );
					$this->breadcrumb['archive_day'] = $this->template( get_the_date( 'j' ) );

					if ( $this->options['show_pagenum'] )
						$this->breadcrumb['archive_day'] = $this->template( array(
							'link' => get_month_link(
								get_query_var( 'year' ),
								get_query_var( 'monthnum' ),
								get_query_var( 'day' )
							),
							'title' => get_the_date( 'F' )
						) );
				}
			} elseif ( is_post_type_archive() && ! is_paged() ) { // Custom Post Type Archive
				$post_type_label = get_post_type_object( $post_type )->labels->name;
				$this->breadcrumb["archive_{$post_type}"] = $this->template( $post_type_label, 'current' );
			} elseif ( is_author() ) { // Author archive
				$this->breadcrumb['archive_author'] = $this->template( $queried_object->display_name, 'current' );
			}
		} elseif ( is_404() ) {
			$this->breadcrumb['404'] = $this->template( $this->strings['404_error'], 'current' );
		}

		if ( $this->options['show_pagenum'] )
			$this->breadcrumb['paged'] = $this->template(
				sprintf(
					$this->strings['paged'],
					get_query_var( 'paged' )
				),
				'current'
			);
	}
	
}
