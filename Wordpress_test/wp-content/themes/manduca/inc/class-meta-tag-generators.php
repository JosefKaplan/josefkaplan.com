<?php
/**
 * Create html output for meta tags
 
 * @theme Manduca - focus on accessibility
 * @since  17.1
 * @moved to independent class: 18.7
 **/

 
class Meta_Tag_Generators{
    
	public function get_post_date() {
		return sprintf( '<time datetime="%s">%s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);	
	}
	
	public function get_authors() {
		return sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'All posts by %s', 'manduca' ), get_the_author() ) ),
				get_the_author()
			);
	}
	
	public function get_modified_date() {
			return sprintf( '<time class="updated" datetime="%1$s">%2$s</time>',
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date( ) )
				);
	}		
}