<?php
/**
 * Correct headings in archive pages. 
 * Add ARIA, screen-reader-text and svg icons to links
 * urgent need to refactor
 *
 *
 
 *@since 1.0
 * */

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2020  Zsolt Edelényi (ezs@web25.hu)

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

  
Class Correct_Headings {
   
   
   public function __construct () {
         add_filter( 'the_content', array( $this, 'correct_headings' ) );
   }
   
   public function correct_headings ( $content ) {
		if ( is_archive() || is_category() || is_tag() ) {
			$content = str_replace( '<h4>', '<h5>', $content );
			$content = str_replace( '</h4>', '</h5>', $content );
			$content = str_replace( '<h3>', '<h4>', $content );
			$content = str_replace( '</h3>', '</h4>', $content );
			$content = str_replace( '<h2>', '<h3>', $content );
			$content = str_replace( '</h2>', '</h3>', $content );
         $content = str_replace ('<h2 class="js-expandmore">', '<h3 class="js-expandmore">',$content);
		}
		return $content;
   }
 }