<?php
/**
 * Customize more-links to be accessible
 
 * @Since 18.1
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

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


Class More_Links {
   
   
      
   protected $args;
   
   public function __construct() {
	  
	  //Translators: text of the read more and excerpt more buttons
		$args[ "text" ] 			= __( 'Continue reading', 'manduca' );
		$args[ 'icon' ] 			= manduca_get_svg( array( 'icon' => 'angle-right' ) ) ;
		$args[ 'classes']			= 'more-link link-button';
		$this->args = apply_filters(
									'manduca_more_links' ,
									$args );
	
		
		add_filter( 'the_content_more_link', array( $this, 'more_link_create_html' ) );
		add_filter( 'excerpt_more', array( $this, 'more_link_create_html' ) );
		add_filter('get_the_excerpt', array( $this , 'manual_excerpt' ) );
	}
	
	
	public function more_link_create_html() {
			
		   return 	sprintf( '<div  class="%2$s"><a href="%1$s" id="post-%3$s-morelink" aria-labelledby="post-%3$s-morelink post-%3$s-title">%4$s %5$s</a></div>',
									   get_permalink(),
									   $this->args[ 'classes' ],
									   get_the_ID(),
									   $this->args[ 'text' ],
									   $this->args[ 'icon' ]
									  );
	   }
 
	
	
	public function manual_excerpt ( $excerpt ) {
	   
		global $post;
		if( $post->post_excerpt ) {
				return $excerpt .$this->more_link_create_html();
		} else {
				return $excerpt;
		}
	}
	
	
	
 }