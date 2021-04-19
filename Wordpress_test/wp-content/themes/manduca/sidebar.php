<?php
/**
 * Display sidebar 
 *
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
?>

<?php if ( is_active_sidebar( 'main_sidebar' ) &&  ! is_page_template( 'page-templates/full-width.php' ) ) : ?>
	
	<aside id="secondary" class="widget-area" >
	
		<h1 class="skip-link" tabindex="0" ><?php _e( 'Sidebar area' , 'manduca' ); ?></h1>
			
		<?php dynamic_sidebar( 'main_sidebar' ); ?>
	</aside>

<?php endif; ?>