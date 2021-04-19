<?php
/**
 * Readability toolbar in the header. 
 *
 * @since 17.8
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

?>

<?php

printf( '<button id="toolbar-buttons-open" aria-label="%3$s" class="toolbar-buttons-open link-button" aria-expanded="false">%1$s%2$s<span class="desktop-text">%3$s</span></button>',
		   manduca_get_svg( array( 'icon' => 'eye' ) ),
		   manduca_get_svg( array( 'icon' => 'close' ) ),
		   //Translators: Name of options button (text size, color etc) at the header.
					__( 'Display options', 'manduca' )
		  );
?>
 <div id="toolbar-buttons" class="toolbar-buttons featured-scheme">
	<h1 aria-hidden="true"><?php _e( 'Display options', 'manduca' ); ?></h1>
	<p><?php
			//Translators: cookie consent only if user change the default option with Display Options. 
			_e( 'When using non-default reading options you accept that cookies will be saved in your browser.', 'manduca' ) ; ?></p>
	
<div id="toolbar-buttons-table" role="presentation" class= "featured-scheme toolbar-buttons-table">
	
								
		<?php 	get_template_part ('/template-parts/header/toolbarinner');?>
				
	
</div>		
	
																
	 
		 <?php echo Manduca_Template_Functions::get_info_button_html( 'inverse3' ); ?>
	  
		<span role="button" id="buttons-close" class="buttons-close inverse-scheme" aria-label="<?php _e( 'Close' ) ; ?>">
				<?php echo manduca_get_svg( array( 'icon' => 'close' ) ); ?>
	   </span>
		
</div>


