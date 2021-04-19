<?php
/**
 * Message in case of no javascript
 *
 * <button> is removed from <a>
 *@see: https://stackoverflow.com/questions/6393827/can-i-nest-a-button-element-inside-an-a-using-html5
 *
 *@since 19.2
 * */

 
 
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

 
 ?>
<noscript>
				<div id="no-javascript" class="inverse3">
      <?php _e( 'JavaScript is off. Please enable to use all functions.', 'manduca' ); ?>
     <div>
      <a href="/" role="button"><?php _e( 'Ok, I enabled javascript', 'manduca'); ?></a>
     </div>
    </div>
</noscript>
			