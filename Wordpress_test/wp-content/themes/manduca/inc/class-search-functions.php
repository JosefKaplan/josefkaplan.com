<?php
/**
 * Search related functions and filters
 * Based on: https://yoast.com/wordpress-search/
 *
 * @ Theme: Manduca focus on accessiblilty 
 * @ since 18.1.5
 *
 **/


class Search_Functions {
	 
	 public function __construct(){
		add_filter( 'wp_trim_excerpt',
				   array( $this, 'custom_trim_excerpt' )
				   );
	 }
	 /**	 * Adds emphasis to the parts passed in $content that are equal to $search_query.
	 *
	 * @param $content The content to alter.
	 * @param $search_query The search query to match against.
	 *
	 * @return string The emphasized text.
	 */
	static function emphasize( $content, $search_query ) {

		$keys = array_map( 'preg_quote', explode(" ", $search_query ) );

		return preg_replace( '/(' . implode('|', $keys ) .')/iu', '<strong class="search-excerpt">\0</strong>', $content );

	 }
	 
	
	 
	 /**
	 * Allows for excerpt generation outside the loop.
	 *
	 * @param string $text  The text to be trimmed
	 * @return string       The trimmed text
	 */
	public static function custom_trim_excerpt( $text = '' ) {
		  if ( !is_search() ) {
			   return;
		  }
		  $text = strip_shortcodes( $text );
		  $text = apply_filters( 'the_content' , $text );
		  $text = str_replace(']]>', ']]&gt;', $text);
	  
		  $excerpt_length = apply_filters('excerpt_length', 55);
	  
		  $trimmed = wp_trim_words( $text, $excerpt_length, '' );
	  
		  $trimmed = self::emphasize( $trimmed, get_search_query() );
		  
		  $more_links = new More_Links;
		  
		  $more_link_html = $more_links->more_link_create_html();
		
		  return $trimmed . $more_link_html;
	 }
	 
	 
	 
	 
 }	