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

class Custom_Header_Image
{
	
	
	public function __construct ()
	{
		add_action( 'after_setup_theme', array( $this, 'manduca_custom_header_setup'));
	}
	
	
	
	public function manduca_custom_header_setup() {
		$args = array(
			// Text color and image (empty to use none).
			'default-text-color'     => '222222',
			'default-image'          => '',
	
			// Set height and width, with a maximum value for the width.
			'height'                 => 200,
			'width'                  => 1267,
			'max-width'              => 1267,
	
			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => true,
	
			// Random image rotation off by default.
			'random-default'         => false,
	
			// Callbacks for styling the header and the admin preview.
			'wp-head-callback'       => 'manduca_header_style',
			'admin-head-callback'    => 'manduca_admin_header_style',
			'admin-preview-callback' => 'manduca_admin_header_image');
		add_theme_support( 'custom-header', $args );
	}
}



