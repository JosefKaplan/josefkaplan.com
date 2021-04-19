<?php
 
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *  Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

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


 class User_Agent_Detect{
  
    public function __construct() {
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'] ;
    }
  
    public function get_classes(){
        return array( $this->get_browser_type(), $this->get_operating_system() ); 
    }
    
  
	/**
    * Get informations about user agent. 
    *
    *@since 18.6 (before 19.2 class named Browser_Type)
    *@see: http://www.wpbeginner.com/wp-themes/how-to-add-user-browser-and-os-classes-in-wordpress-body-class/
    * 
    *@return string : browser type
    *
    */

	public function get_browser_type() {
            
				  $browser ='unknown-browser';
				  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
				  
				  if( $is_lynx ) $classes[] = 'lynx';
				  elseif( $is_gecko ) $browser = 'gecko';
				  elseif( $is_opera ) $browser = 'opera';
				  elseif( $is_NS4 ) $browser = 'ns4';
				  elseif( $is_safari ) $browser = 'safari';
				  elseif( $is_chrome ) $browser = 'chrome';
				  elseif( $is_IE ) {
					    $browser = 'ie';
					    if( preg_match( '/MSIE ( [0-9]+ )( [a-zA-Z0-9.]+ )/', $this->user_agent, $browser_version ) )
					    $browser = 'ie'.$browser_version[1];
				  }
				 				  
				  return $browser;
		 }
         
    /*
     * Find the operating system of the session user
     *
     *@since 19.2
     *@see: https://stackoverflow.com/questions/18070154/get-operating-system-info
     *
     *@return string shortname of OS type. 
     */
         
    public function get_operating_system() { 
        
        $os_platform  ='unknown-os';    
        $os_array     = array(
                              '/windows nt 10/i'      =>  'win10',
                              '/windows nt 6.3/i'     =>  'win8',
                              '/windows nt 6.2/i'     =>  'win8',
                              '/windows nt 6.1/i'     =>  'win7',
                              '/windows nt 6.0/i'     =>  'vista',
                              '/windows nt 5.2/i'     =>  'winserver',
                              '/windows nt 5.1/i'     =>  'xp',
                              '/windows xp/i'         =>  'sp',
                              '/windows nt 5.0/i'     =>  'win2000',
                              '/windows me/i'         =>  'winme',
                              '/win98/i'              =>  'win98',
                              '/win95/i'              =>  'win95',
                              '/win16/i'              =>  'win3',
                              '/macintosh|mac os x/i' =>  'macosx',
                              '/mac_powerpc/i'        =>  'macos9',
                              '/linux/i'              =>  'linux',
                              '/ubuntu/i'             =>  'ubuntu',
                              '/iphone/i'             =>  'iphone',
                              '/ipod/i'               =>  'ipod',
                              '/ipad/i'               =>  'ipad',
                              '/android/i'            =>  'android',
                              '/blackberry/i'         =>  'blackBerry',
                              '/webos/i'              =>  'mobile'
                        );
    
        foreach ( $os_array as $regex => $value)
            if ( preg_match($regex, $this->user_agent) ) {
                $os_platform = $value;
                break;
            }
    
        return $os_platform;
    }
 }