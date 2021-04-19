<?php
/**
 * Displays top navigation
 *
 * for duplicating HTML5 and ARIA landmark:
 * @see: https://dequeuniversity.com/assets/html/jquery-summit/html5/slides/landmarks.html
 * 
 * @ since 17.4
 * @last modification: 18.10.16
 */

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
	// Translators: name of the main menu for screen reader users. 
	$menu_name = __( 'Main navigation', 'manduca' ) ;
	
	printf( '<button id="menu-toggle" class="menu-toggle link-button" aria-label="%3$s" aria-expanded="false">%1$s%2$s<span>%3$s</span></button>',
		   manduca_get_svg( array( 'icon' => 'bars' ) ),
		   manduca_get_svg( array( 'icon' => 'close' ) ),
		   $menu_name
		  );
?>

<div id="site-header-menu" class="site-header-menu">
	
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
	
		<div id="site-navigation" class="main-navigation">
			
			<nav id="megamenu"
				 class="megamenu"
				 aria-label="<?php echo $menu_name; ?>"
				 role="navigation">
				<?php
					wp_nav_menu (array(
					   'theme_location'  => 'primary',
					   'menu'            => 'primary Menu',
					   'menu_class'      => 'nav-menu',
					   'container'       => false,
					   'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
					   'depth'           => 3,
					   'walker'          => new Manduca_accessible_walker() 
					   ));
				?>
			</nav>
			
		</div>
		
	<?php endif; ?>
	
</div>
<div class="clearfix"></div>
