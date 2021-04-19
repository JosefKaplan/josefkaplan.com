<?php
/**
 * Add accessible tabs scripts and style to the page
 *
 * This function should be added to footer when needed. 
 *
 *@see: https://github.com/batyuvitez/manduca/wiki/Create-accessible-tab-page
 */

  /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)

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

 class Accessible_Tabs{
		  
		  public function __construct (){
					add_action( 'wp_footer', array(
												   $this,
												  'accessible_tabs_js' )
										, 100 );
					add_action( 'wp_footer', array(
												   $this,
												  'accessible_tabs_css' )
										, 100 );
		  }
		  
		  
		  static function accessible_tabs_js() {
			
					printf( "<script src='%s'></script>",
							  get_template_directory_uri() . '/assets/js/accessible-tabs.js'
							  )
					  ;
					  ?>
					   <script>
								(function($) {
										   $(document).ready(function(){
										   $(".tabs").accessibleTabs({
										   tabhead:'h2',
										   fx:"fadeIn",
										   currentInfoText: '<?php _e( 'Current tab:' , 'manduca' ); ?>' 
									   });
								   });
										   })(jQuery);
					 </script>
					<?php
		  }
		  
		  //Add sliding door css. 
		  static function accessible_tabs_css() {
		  		  printf( '<link rel="stylesheet" href="%s" type="text/css" media="screen">',
		  				  get_template_directory_uri() .'/assets/css/sliding-doors.css'
		  				  );
		  }
		  
		  
 }