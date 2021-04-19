<?php
/**
 * Template for displaying search forms in Manduca
 * applied in widget and in serach result page. 
 *
 *@Since 16.9
 */

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

 

?>

<form role="search" method="get" class="widget-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div role="search" >
		<label for="s" ><?php _e( 'Search', 'manduca' ) ?></label><label class="screen-reader-text" for="ws" ><?php _e( 'Search', 'manduca' ) ?></label>
		<input type="text" placeholder="<?php echo esc_attr_e( 'Search', 'manduca' ) ?>"  name="s"  id="s" />
		<button type="submit" class="search-submit inverse2" id="widget-search-submit" aria-label="<?php _e( 'Start search', 'manduca' ) ?>" >
			<span class="screen-reader-text">
				<?php _e( 'Search', 'manduca' ) ?>
			</span>
			
			<?php echo  manduca_get_svg( array( 'icon'=>'search') ) ;?>
			
		</button>
	</div>
</form>
			