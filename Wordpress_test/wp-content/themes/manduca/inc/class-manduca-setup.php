<?php
/*
 * This is the main class of the theme
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

class Manduca_Setup {
		
		
	public function init() {
		
		new \Manduca\Enqueue;
		
		new \Manduca\Filter_Nav_Menu; //@since 20.8

		// Open the files which ara not classes.
		$this->load_notclasses();
		
		//scale oEmbed code to a specific width, and insert large images without breaking the main content area. 
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
		
		// Register the themes main parameters: Nav menus, theme support, editor style, textdomain
		
		
		new \Manduca\Theme_Support;
		new \Manduca\Custom_Header_Image;
		
		// remove built-in image sizes and add optimized image sizes and names. 
		$this->image_settings();
		
		/* Link function (add svg, aria etc. )
		 * Filter to disable link function in child theme
		 *@since@18.10.6
		 * */
		$link_function_enable = apply_filters( 'manduca_enable_link_functions', true) ;
		if( $link_function_enable ) {	
			new \Manduca\Link_Functions();
		}
		
		// Link function (add svg, aria etc. )
		new Manduca_Template_Functions();
		
		//Filter page title
		new \Manduca\Filter_Title;
		
		new \Manduca\Register_Sidebar;		
		// Az svg tábla beolvasása globális változóba
		(new \Manduca\Define_Globals ) -> load_svg_to_global();
				
		// Accesssible widget archive
		new \Manduca\Register_Widgets;
		new \Manduca\Widget_Archives;
		new \Manduca\Ajax_Call_Handler;
		
		// Functions of admin size
		if ( is_admin() ){
			
			// Add customizer functions
			new Customizer;
			
			
			// Add tiny MCE functions and stylesheets
			$tinimce = new Tiny_Mce;
			$tinimce->add_hooks_to_wp();
			
			
			// Change jpg quality to best
			add_filter('jpeg_quality', array( $this, 'set_jpg_quality' ) );
			add_filter('wp_editor_set_quality', array( $this, 'set_wp_editor_quality' ) );
		}
		
		/*
		 * Hooks needed only frontend
		 **/
		else {
			// Add accessible more-links Need svg to be loaded. 
			$more_links = new More_Links;
		
			// Remove gallery inline style
			add_filter( 'use_default_gallery_style', '__return_false' );
		
			
			// Add anchor to image anchor insert in post content @ Since 16.10
			add_filter('image_send_to_editor',array( $this, 'add_class_image_anchor' ) ,10,8);
		
			// Correct headings 2-5 on archive pages
			new Manduca\Correct_Headings;
			
			// add alt tag to avatar
			new \Manduca\Avatar_Alt_Text;
			
			// Add homepage when listing page anywhere (e.g. in menu or widget )
			add_filter( 'wp_page_menu_args', array( $this, 'add_home_to_page_menu' ) );
			
			//add aria-current="page to the current menu item. 
			new Accessible_Menu;
			
			new Search_Functions;
			
		}
		
	}
	
	
	
	
	public function image_size_settings() {
		// Uses a custom image size for featured images
		add_theme_support( 'post-thumbnails' );
		add_image_size ('post-size', 890, 592 );
		add_image_size ('excerpt-size', 268, 178 );
		
		//Change the default image sizes to zero 
		update_option( 'medium_size_w', 0 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 0 );
		update_option( 'large_size_h', 0 );
		
	}
	
	
	public function set_jpg_quality () {
		return 100;
	}
	
	public function set_wp_editor_quality () {
		return 100;
	}
		
	
	public function delete_default_image_sizes( $sizes ) {
		unset( $sizes[ 'large' ] );
		unset( $sizes[ 'medium_large' ] );
		return $sizes;
	}
	
	
	
	
   function image_size_names( $sizes ) {
	   $add_sizes = array(
		   'thumbnail-size' 	=> __( 'Thumbnail', 'manduca' ),
		   'post-size' 			=> __( 'Image in Post', 'manduca' ),
		   'full' 				=> __( 'Original size', 'manduca' ),
		   'excerpt-size' 		=> __( 'Excerpt size', 'manduca' )
	   );
	   $new_sizes = array_merge($sizes, $add_sizes);
	   return $new_sizes;
	}
	
	
	public function image_settings() {
		//3 images sizes needed
		add_action( 'after_setup_theme', array($this, 'image_size_settings' ) );

		// Delete WordPress default image sizes / Do not need to waste HD capacity for those image sizes. 
		add_filter( 'intermediate_image_sizes_advanced', array( $this, 'delete_default_image_sizes') );


		// Change name of Manduca specific image sizes		
		add_filter( 'image_size_names_choose', array( $this, 'image_size_names' ) );
		
	}
	
	
	
	
	
	public function add_class_image_anchor($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
		$classes = 'image-link'; 
	  
		if ( preg_match('/<a.*? class=".*?">/', $html) ) {
		  $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
		} else {
		  $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
		}
		return $html;
	}
	

	
	function add_home_to_page_menu( $args ) {
		if ( ! isset( $args['show_home'] ) ) {
			$args['show_home'] = true;
		}
		return $args;
	}
	
	
	 
	
	protected function load_notclasses() {
		$dir = get_template_directory() .'/inc/notclasses/' ;
		
		$files 		= scandir( $dir );
		
		//Get rid of points (libraries )
		$files 		= array_diff( $files, array('..', '.') ) ;
		
		// Open all files in it
		if( !empty ($files ) ) {
			foreach( $files as $file ) {
				if( strpos( $file , '.php' ) !== false ) {
					require_once( $dir .$file );
				}
			}
		}
	}
	
}
