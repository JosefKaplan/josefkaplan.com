<?php
/* The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @since 1.0
 **/
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2021  Zsolt Edelényi (ezs@web25.hu)

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
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	

	<body id="total" <?php body_class(Manduca_Template_Functions::body_classes()); ?>>
	    <?php get_template_part( '/template-parts/header/backgroundimages' ); ?>
		<?php wp_body_open(); ?>
		<div id="page" class="hfeed site">
			<?php get_template_part( '/template-parts/header/nojavascript' ); ?>
			<div  id="top-bar" class="top-bar inverse-scheme"></div>
			<?php get_template_part( '/template-parts/header/skiplinks' ); ?>
			<div id="masthead" class="site-header megamenu-parent" >
				<div id="header-bar" class="header-bar">
					<header>											
						<?php get_template_part( '/template-parts/header/sitetitle' ); ?>
						<?php get_template_part( '/template-parts/header/toolbar' ); ?>
					</header>
				</div>			
				<?php get_template_part( '/template-parts/header/headerimage' ); ?>
				<?php get_template_part( '/template-parts/header/menu' ); ?>
				<?php get_template_part( '/template-parts/header/searchform' ); ?>					
			</div>
			<?php get_template_part( '/template-parts/wrapper/wrapper', 'top' ); ?>
				