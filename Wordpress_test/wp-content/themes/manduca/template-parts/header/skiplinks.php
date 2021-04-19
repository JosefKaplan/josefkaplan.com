<?php
/**
 * Jump links to content and sidebar
 * Header template file
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
<nav id="skip-links" aria-label="<?php _e( 'Jump links' , 'manduca' ) ?>" >

    <a class="skip-link" id="skip-to-content" href="javascript::"><?php _e( 'Skip to main content', 'manduca' ); ?></a>
    
    <a class="skip-link" id="skip-to-sidebar" href="javascript::"><?php _e( 'Skip to sidebar', 'manduca' ); ?></a>
    
    <a class="skip-link" id="skip-to-footer" href="javascript::"><?php _e( 'Skip to footer', 'manduca' ); ?></a>        
        
</nav>