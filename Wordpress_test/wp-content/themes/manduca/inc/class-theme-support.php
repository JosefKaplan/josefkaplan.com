<?php
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

class Theme_Support
{
	
	
	public function __construct ()
	{
		add_action( 'after_setup_theme', array($this, 'theme_supports' ) );
	}
	
	
	
	public function theme_supports() {
		// Styles the visual editor with editor-style.css
		add_editor_style();
		
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		
		// Switch default core markup to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'caption', 'gallery'
		) );
		
		//Allows themes to add document title tag
		add_theme_support( 'title-tag' );
		
		//Register navigation menus
		//translators: name of main menu for admin and for screen reader users also
		register_nav_menu( 'primary', __( 'Main navigation', 'manduca' ) );
		//translators: name of menu in footer for admin and screen reader users also
		register_nav_menu( 'footer', __( 'Footer navigation', 'manduca' ) );
		
		//Makes translation-ready
		load_theme_textdomain( 'manduca', get_template_directory() . '/assets/lang' );
		
		 //Supports custom background color and image
		add_theme_support( 'custom-background', array(
			'default-color' => 'f3f3f5',
		) );
		
		
	}
	
	
}



