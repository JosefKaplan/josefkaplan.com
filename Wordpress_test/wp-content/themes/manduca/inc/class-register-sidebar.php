<?php
/*
 * Register Main Sidebar
 *
 * Theme Execution begins here:
 *  -add static controller function
 * - autoload all files,
 * - Initiate Manduca functions
 *
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2020  Zsolt Edelényi (ezs@web25.hu)

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

namespace Manduca;

class Register_Sidebar {
	
	public function __construct () {
		add_action( 'widgets_init', array( $this, 'sidebar')  );		
	}
	
	
	public function sidebar ()
	{
		register_sidebar( array(
			// translators: name of the sidebar
			'name' =>__( 'Sidebar', 'manduca' ),
			'id' => 'main_sidebar',
			// translators: sidebar description
			'description' => __( 'Appears all pages except when using full page template', 'manduca' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' =>'</h2>'
		) );
	}
	
}
