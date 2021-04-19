<?php if( ! defined( 'ABSPATH' ) ) exit;
	
/**
 * Read More Button
 */

	function shops_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
        return '<p class="link-more"><a class="myButt " href="'. esc_url(get_permalink( get_the_ID() ) ) . '">' . shops_return_read_more_text (). '</a></p>';
	}
	add_filter( 'excerpt_more', 'shops_excerpt_more' );	
	
	function shops_excerpt_length( $length ) {
			if ( is_admin() ) {
					return $length;
			}
			return 42;
	}
	add_filter( 'excerpt_length', 'shops_excerpt_length', 999 );
	
	function shops_return_read_more_text () {
		return __( 'Read More','shops');
	}