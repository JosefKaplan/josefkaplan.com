<?php
/**
 * Readability toolbar in the header. 
 *
 * @since 17.8
 * */

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
<?php
	$button_args=
		array(
			array (	'name'											=>'high-contrast',
				//translators: Toolbar color scheme selector
				'label'	=>__( 'Color scheme' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'					=>'Abc',
								//translators: Toolbar color scheme selector original colors set
								'desktop_text'			=>__( 'Original' , 'manduca' )),
						
						array( 
								'phone_text'					=>'Abc',
								//translators: Toolbar color scheme set dark background white letters. 
								'desktop_text'			=>__( 'Inverse' , 'manduca' ),
								'aria_label'			=> __( 'Dark background, light letters' , 'manduca' )) ) ),
			
			array (	'name'=>'font-type',
				//translators: Toolbar color scheme selector
				'label'										=>__( 'Font type' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'					=>'Abc',
								//translators: Toolbar font type selector
								'desktop_text'			=>__( 'Default' , 'manduca' )),
						
						array( 
								'phone_text'					=>'Abc',
							//translators: Toolbar font type selector
								'desktop_text'			=>__( 'Dyslexie' , 'manduca' ) ) ) ),
				
				
				array (	'name'=>'font-size',
				//translators: Toolbar color scheme selector
				'label'=>__( 'Font size' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'					=>'Abc',
								//translators: Toolbar font-size selector default font size
								'desktop_text'			=>__( 'Default' , 'manduca' )),
						
						array( 
								'phone_text'					=>'Abc',
							//translators: Toolbar font-size selector large (200%)font size
								'desktop_text'			=>__( 'Large' , 'manduca' ) ) ) ),
				
				array (	'name'=>'line-height',
				//translators: Toolbar line height selector
				'label'=>__( 'Line height' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'			=>__( 'Default' , 'manduca' ) ,
								//translators: Toolbar line height 1.7
								'desktop_text'			=>__( 'Default' , 'manduca' ) ),
						array( 
								'phone_text'			=>__( 'Wide' , 'manduca' ),
							//translators: Toolbar line height 2
								'desktop_text'			=>__( 'Wide' , 'manduca' ) ) ) ),
				
				
				array (	'name'=>'letter-spacing',
				//translators: Toolbar letter psacing selector button
				'label'=>__( 'Letter spacing' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'			=>'Abc',
								//translators: Toolbar line height 1.7
								'desktop_text'			=>__( 'Default' , 'manduca' ) ),
						array( 
								'phone_text'					=>'Abc',
							//translators: Toolbar line height 2
								'desktop_text'			=>__( 'Wide' , 'manduca' ) ) ) ),
				
				
				array (	'name'=>'paragraph-spacing',
				//translators: Toolbar paragrpah spacing selector button
				'label'=>__( 'Paragraph spacing' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'			=>__( 'Default' , 'manduca' ) ,
								'desktop_text'			=>__( 'Default' , 'manduca' ) ),
						array( 
								'phone_text'			=>__( 'Wide' , 'manduca' ),
								'desktop_text'			=>__( 'Wide' , 'manduca' ) ) ) ),
				
				
				array (	'name'=>'word-spacing',
				//translators: Toolbar word spacing selector button
				'label'=>__( 'Word spacing' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'					=>'Ab ce',
								'desktop_text'			=>__( 'Default' , 'manduca' ) ),
						array( 
								'phone_text'					=>'Ab ce',
								'desktop_text'			=>__( 'Wide' , 'manduca' ) ) ) ),
				
				
				
				array (	'name'=>'hyphen',
				//translators: Toolbar color scheme selector
				'label'=>__( 'Hyphenation' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'			=>'Abce',
								//translators: Toolbar font-size selector default font sizet
								'desktop_text'			=>__( 'None' , 'manduca' )),
						array( 
								'phone_text'			=>'Ab-ce',
								//translators: Toolbar font-size selector larger (150%) font sizet
								'desktop_text'			=>__( 'All' , 'manduca' ) ) ) ),
				
				
				
				array (	'name'=>'link-appearance',
				//translators: Toolbar color scheme selector
				'label'=>__( 'Links' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'					=>'link',
								//translators: Toolbar font-size selector default font sizet
								'desktop_text'			=>__( 'Default' , 'manduca' )),
						array( 
								'phone_text'					=>'link',
								//translators: Toolbar font-size selector larger (150%) font sizet
								'desktop_text'			=>__( 'Bold' , 'manduca' ) ) ) ),
				
				
				
				array (	'name'=>'target',
				//translators: Toolbar color scheme selector
				'label'=>__( 'Link target' , 'manduca' ),
				'elements'=>
					array (
						array( 
								'phone_text'			=>manduca_get_svg (array ('icon'=>'minus') ),
								//translators: Toolbar link target selector: links open where specified
								'desktop_text'			=>__( 'Default' , 'manduca' ),
								//translators: Toolbar link target selector: screenreader text. 
								'aria_label'			=>__( 'Leave as it is', 'manduca' ) ),
						array( 
								'phone_text'			=> manduca_get_svg( array ( 'icon'=>'target' ) ),
								//translators: Toolbar link target selector: Links open in same window
								'desktop_text'			=>__( 'Same window' , 'manduca' ),
								//translators: Toolbar link target selector: Links open in same window
								'aria_label'			=>__( 'Always opens link in same window', 'manduca' ) ),
						array( 
								'phone_text'			=>manduca_get_svg( array ( 'icon'=>'extlink' ) ),
								//translators: Toolbar link target seleccotr: Open links in new window
								'desktop_text'			=>__( 'New window' , 'manduca' ),
								//translators: Toolbar link target seleccotr: Open links in new window
								'aria_label'			=>__( 'Always opens link in new window', 'manduca' ) ) ) ) );

\Manduca\helpers\Reading_Options::display_table ($button_args); 
