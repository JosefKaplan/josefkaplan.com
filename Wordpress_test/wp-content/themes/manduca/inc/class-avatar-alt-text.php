<?php
/*
 * This class provides alt text for avatar images
 *
 *@since 19.3
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


class Avatar_Alt_Text {
	
	public function __construct(){
		add_filter( 'get_avatar',
				   array( $this, 'add_alt_to_avatar' )
				   );
		
	}
	
	public function add_alt_to_avatar( $text ) {
		$alt_text = sprintf( __( 'Avatar of %s', 'manduca' ),
								get_the_author_meta( 'display_name' )
								);
		$text = str_replace( 'alt=""', sprintf('alt="%s"', $alt_text) , $text );
		return $text;
	}
	
	
	
}