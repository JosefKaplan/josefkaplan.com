<?php

/**
 * template of Accessible archive widget
 * So far I cannot use, since parameters cannot pass into template part in Wp. 
 * @since 19.2
 */

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

    This program is free software: you can redistribute it and/or modify
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

?>


<label class="screen-reader-text" for="<?php echo 'year-' .esc_attr( $dropdown_id ); ?>"><?php _e( 'Select Year' ) ; ?></label>
	<select id="manduca-year-selector" name="manduca-year-selector" >

<label class="screen-reader-text" for="manduca-year-selector"><?php _e( 'Select Month' ) ; ?></label>
	<select id="manduca-month-selector" name="manduca-month-selector" >