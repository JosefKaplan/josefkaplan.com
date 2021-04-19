<?php
/*
 * Functions using in template files
 *@Since 18.9
 **/

 
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
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

 

class Manduca_Template_Functions {
		
	/*
	 * Return page links for paginated posts (i.e. includes the <!--nextpage-->.
     * Quicktag one or more times). This tag must be within The Loop.
     * replacement of WP's link_pages()
	 *
	 *If a post slited into more pages with <!! nextpage --> shortag, this shows the previous and next page
	 *(this is not the default WP setup, but use the built-in wp_link_pages() function
	 *
	 *@return string HTMl markup of navigation area
	 *@since 18.11
	 **/
	public static function manduca_link_pages() {
			$next_link = sprintf( '%s&nbsp;%s ',
								 __( 'Next page of post', 'manduca' ),
								 manduca_get_svg( array( 'icon' => 'angle-circle-right') )
								 );
			$previous_link = sprintf( '%s&nbsp;%s ',
								 manduca_get_svg( array( 'icon' => 'angle-circle-left') ),
								 __( 'Previous page of post', 'manduca' )
								 );
		
			$args = array (
				'before'            => '<div class="post-pagination"><span class="screen-reader-text" role="heading">' . __( 'Pages of this post', 'manduca' ) . ': </span>',
				'after'             => '</div>',
				'link_before'       => '<span class="page-link">',
				'link_after'        => '</span>',
				'next_or_number'    => 'next',
				'separator'         => ' | ',
				'nextpagelink'      => $next_link,
				'previouspagelink'  => $previous_link,
			);
			 
			wp_link_pages( $args );
	}
	
	/*
	 * Displays the navigation to next/previous set of posts, when you re in excerpt tamplate.
	 *
	 * @see template-parts/posts/content-excerpt.php
	 * @return (string) : html markup of navigation
	 * 
	 * */
		public static function post_navigation(){
				if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
						return '';
				}
				$args						= array();
				$args[ 'prev_text']			= sprintf( '%s<span class="screen-reader-text">%s</span>',
												  manduca_get_svg( array( 'icon' => 'angle-left' )),
												__( 'Newer posts', 'manduca' )
												);
				$args[ 'next_text']			= sprintf( '<span class="screen-reader-text">%s</span>%s',
												__( 'Older posts', 'manduca' ),
												manduca_get_svg( array( 'icon' => 'angle-right' )) 
												);
			
				$args[ 'end_size' ]			= 3;
				$args['mid_size' ]           	= 1;
			
				/* The paginate_links() function cloned here and modified in 18.10.14 */
				global $wp_query, $wp_rewrite;
			
				// Setting up default values based on the current URL.
				$pagenum_link = html_entity_decode( get_pagenum_link() );
				$url_parts    = explode( '?', $pagenum_link );
			
				// Get max pages and current page out of the current query, if available.
				$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
				$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			
				// Append the format placeholder to the base URL.
				$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';
			
				// URL base depends on permalink settings.
				$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
				$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
			
				$defaults = array(
					'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
					'format'             => $format, // ?page=%#% : %#% is replaced by the page number
					'total'              => $total,
					'current'            => $current,
					'show_all'           => false,
					'prev_next'          => true,
					'add_args'           => array(), // array of query args to add
					'add_fragment'       => '',
				);
			
				$args = wp_parse_args( $args, $defaults );
			
				// Merge additional query vars found in the original URL into 'add_args' array.
				if ( isset( $url_parts[1] ) ) {
					// Find the format argument.
					$format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
					$format_query = isset( $format[1] ) ? $format[1] : '';
					wp_parse_str( $format_query, $format_args );
			
					// Find the query args of the requested URL.
					wp_parse_str( $url_parts[1], $url_query_args );
			
					// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
					foreach ( $format_args as $format_arg => $format_arg_value ) {
						unset( $url_query_args[ $format_arg ] );
					}
			
					$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
				}
			
				// Who knows what else people pass in $args
				$total = (int) $args['total'];
				if ( $total < 2 ) {
					return;
				}
				$current  = (int) $args['current'];
				$end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
				if ( $end_size < 1 ) {
					$end_size = 1;
				}
				$mid_size = (int) $args['mid_size'];
				if ( $mid_size < 0 ) {
					$mid_size = 2;
				}
				$add_args = $args['add_args'];
				$links = '';
				$page_links = array();
				$dots = false;
			
				if ( $args['prev_next'] && $current && 1 < $current ) :
					$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $current - 1, $link );
					if ( $add_args )
						$link = add_query_arg( $add_args, $link );
					$link .= $args['add_fragment'];
					$page_links[] = sprintf(
								'<h4><a class="prev page-numbers inverse3" href="%1$s">%2$s</a></h4>',
								$link,
								$args['prev_text']
					);
				endif;
				for ( $n = 1; $n <= $total; $n++ ) :
					if ( $n == $current ) :
						// usage of aria-current: http://design-patterns.tink.uk/aria-current/
						// but some screen announce it after the title. This is the reason I use screen-reader-text
						//@since 18.11
						$page_links[] = sprintf(
								'<span class="page-numbers current"><span class="screen-reader-text">%s </span>%s</span>',
								__( 'Current page', 'manduca' ),
								number_format_i18n( $n )
								);
						
						$dots = true;
					else :
						if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
							$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
							$link = str_replace( '%#%', $n, $link );
							if ( $add_args )
								$link = add_query_arg( $add_args, $link );
							$link .= $args['add_fragment'];
			
							
							//translators: screen reader text for numbered list items in post navigation
							$screen_reader_text = sprintf( __( '<span class="screen-reader-text">Page</span> %s', 'manduca' ),
														  number_format_i18n( $n )
														 );
							$page_links[] = sprintf(
								'<a class="page-numbers" href="%1$s">
								%2$s
								</a>',
										$link,
										$screen_reader_text
										);
								
							$dots = true;
						elseif ( $dots && ! $args['show_all'] ) :
							$page_links[] = sprintf(
													'<span class="page-numbers dots" aria-label="%1$s">%2$s</span>',
													//translators: This is the dots announcement in post navigation
													__( 'Not indicated pages', 'manduca'),
													manduca_get_svg( array( 'icon' => 'dots' ) ) 
																   );
							$dots = false;
						endif;
					endif;
				endfor;
				if ( $args['prev_next'] && $current && $current < $total ) :
					$link = str_replace( '%_%', $args['format'], $args['base'] );
					$link = str_replace( '%#%', $current + 1, $link );
					if ( $add_args )
						$link = add_query_arg( $add_args, $link );
					$link .= $args['add_fragment'];
					$page_links[] = sprintf(
								'<h4><a class="next page-numbers inverse3" href="%1$s" >%2$s</a></h4>',
								$link,
								$args['next_text']
								);
				endif;
		
				$links = join("\n", $page_links);
				if ( !$links ) {
					return;
				}
					
			
				$nav = sprintf( '<nav class="navigation pagination">
							   <h3 class="screen-reader-text">%1$s</h3>
							<div class="nav-links">%2$s</div>
							</nav>',
							__( 'Posts navigation' ),
							$links
							);
			
				return $nav;

		}
	
		public static function get_info_button_html( $class = NULL ) {
				/* Add information button, if there is a link to it.
				*
				* Return @array: 'url' :		the url of the info page
				* 				 'title' : 		the tooltip, screen-reader text of the link
				* 				 'anchor text': the anchor text of the link
				*/
				
				$info_button_data = apply_filters ( 'manduca_toolbar_info_button' , false );
				
				if( $info_button_data === false ) {
						return '';
				}
		
				$class = $class ? ' '.$class : '';
				
				return sprintf( '<div class="more-link link-button %5$s">	<a href="%1$s" class="info-button" title="%2$s">%3$s<span class="desktop-text">%4$s</span></a></div>' ,
				   esc_html( $info_button_data[ 'url' ] ), 
				   esc_html( $info_button_data[ 'title' ] ),
				   manduca_get_svg( array( 'icon' => 'info' ) ),
				   esc_html( $info_button_data[ 'anchor-text' ] ),
				   $class
				   );
	}
	
	public static function display_excerpt(){
		$more_link 	= new More_Links;
		$html 		.=$more_link->more_link_create_html();
		return $html;
	}
	
	
	/*
	 * Creating the excerpt
	 *
	 * @param $morelink_flag : depretiated in #20.1
	 * @param int $len       : If no excerpt provided in post, the number of words from the beggining. 
	 * @return (string): HTML content of excerpt with readmore link. 
	 *
	 * */
	
	public static function get_the_excerpt ($morelink_flag=false, int $len=45 ){
		$post 		= get_post();
		$post_content = $post->post_content;
		
		if( has_excerpt() === true ) {
				$html 		= $post->post_excerpt;
				$morelink_flag=TRUE;
		}
		
		elseif( false !==  strpos( $post_content, '<!--more-->' ) ) {
				$paragpraphs = 	explode( '<!--more-->', $post_content ) ;
				$morelink_flag=TRUE;
				if( isset( $paragpraphs[0] ) ) {
					$html = $paragpraphs[ 0 ];
				}
		}
		else {
				$html = self::trim_excerpt ($post_content, $len);
		}
		$html = strip_shortcodes( $html);
		if( $morelink_flag )
			$html=self::add_morelink ($html);
		return $html;
	}
	
	
	
	
	
	
	/*
	 * Create Human readable excerpt from the content.
	 * Breaking sentence at the end, or at the end of HTML tag
	 *
	 * @param (string) HTML content
	 * * @param (int) $len : number of words stripped from beginning. 
	 * @return (string) excerpt in HTML 
	 * @see: https://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt/141136#141136
	 */
    protected static function trim_excerpt( string $content, int $excerpt_word_count ) {
		$allowed_tags =  '<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<video>,<audio>,<h2>,<h3>,<h4>'; 
		$excerpt = strip_shortcodes( $content );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
		$excerpt = strip_tags( $excerpt, $allowed_tags ); 

		
		//Filter depretiated as of 20.4
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
		$tokens = array();
		$excerptOutput = '';
		$count = 0;

		// Divide the string into tokens; HTML tags, or words, followed by any whitespace
		preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $excerpt, $tokens);

		$morelink_flag =FALSE;
		foreach ($tokens[0] as $token) {
			if ($count++ >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
			// Limit reached, continue until , ; ? . or ! occur at the end
				$excerptOutput .= trim($token);
				$morelink_flag =TRUE;
				break;
			}
			$excerptOutput .= $token;// Append what's left of the token
		}
		$excerpt = trim(force_balance_tags($excerptOutput));
		if( $morelink_flag )
			$excerpt=self::add_morelink ($excerpt);
		return $excerpt;   
	}
	
	
	/*
	 *Add morelink to the end of HTML
	 *
	 *@param string $html HTML code
	 *@return string HTML code with morelink
	 **/
	protected static function add_morelink ($html)
	{
		$more_link = new More_Links;
		return $html.$more_link->more_link_create_html();
	}
	
	
	
	/*
	 * Link html provided to previous post in the same category of single post
	 * Replacement of Wp get_previous_post_link() method
	 *
	 * @return  string HTMl markup of <a> element
	 * @see template-parts/posts/navigation
	 * @since 18.10.8
	 **/
	public static function previous_post_link_html() {
			if ( is_attachment() ){
					$post = get_post( get_post()->post_parent );
			}
			else {
					$post = get_adjacent_post( false , '' , true , 'category' );
			}

			if ( ! $post ) {
				$output = '';
			} else {
					$output = sprintf( '<a href="%1$s" rel="prev"><span class="screen-reader-text">%4$s</span>%3$s %2$s<span aria-hidden="true"</a>',
						   get_permalink( $post ),
						   $post->post_title,
						   manduca_get_svg( array( 'icon' => 'angle-circle-left') ),
						   __( 'Previous post', 'manduca' ) .' '
						   );
			}
			return $output;
	}
	
	/*
	 * Link html provided to next post in the same category of single post
	 * Replacement of Wp get_next_post_link() method
	 *
	 * @return  string HTMl markup of <a> element
	 * @see template-parts/posts/navigation
	 * @since 18.10.8
	 **/
	public static function next_post_link_html() {
			$post = get_adjacent_post( false , '' , false , 'category' );
			if ( ! $post ) {
				$output = '';
			} else {
					$output = sprintf( '<a href="%1$s" rel="next"><span class="screen-reader-text">%4$s</span>%2$s %3$s</a>',
						   get_permalink( $post ),
						   $post->post_title,
						   manduca_get_svg( array( 'icon' => 'angle-circle-right') ),
							__( 'Next post', 'manduca' ) .' '
						   );
			}
			return $output;
	}
		
		
		
	/*
	 *Additional classes for header
	 *
	 *@since 20.2.
	 **/
	public static function body_classes() {
		$background_color 	= get_background_color();
		$background_image 	= get_background_image();
		$classes			= array();
		if ( empty( $background_image ) ) {
			if ( empty( $background_color ) ) {
				$classes[] = 'custom-background-empty';
			}
			elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) {
				$classes[] = 'custom-background-white';
			}
		}
		
		if ( ! is_multi_author() ) {
			$classes[] = 'single-author';
		}
		
		//Detect visitors OS and browser and add to body tag	
		$classes=array_merge( $classes , (new User_Agent_Detect() )->get_classes() );
		return $classes;
	}
}

