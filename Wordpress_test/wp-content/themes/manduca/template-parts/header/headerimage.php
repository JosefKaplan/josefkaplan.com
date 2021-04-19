<?php
/**
 * Generate header image
 * Header template file
 * 
 * @ Theme: Manduca - focus on accessibility 
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

    
$header_image = get_header_image() ;
$alt = __( 'This image has no alt text, sorry', 'manduca' )  ;    
if( false != $header_image ) :
    
    /*
     * Accessibility function: Get the alt text for header image
     **/
    $data = get_theme_mod( 'header_image_data' ) ;   
    if( $data ) {
        
        if( is_array( $data ) && isset( $data[ 'attachment_id' ] ) ) {
              
            $attachment_id =  $data[ 'attachment_id' ];
    
            $alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
    
        }
    }

    
    if( is_home() || is_front_page() && get_header_image() ) {
       printf( '<img src="%1$s" id="header-image" class="header-image" width="%2$s" height="%3$s" alt="%4$s" />',
              $header_image,
              esc_attr( get_custom_header()->width ),
              esc_attr( get_custom_header()->height ),
              $alt
              );
    }
endif;