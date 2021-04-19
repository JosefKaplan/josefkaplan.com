<?php
/*
 *
 *Add homepage URL to menu item, if homepageReplacement is there. 
 **/

/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

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


namespace manduca;


class Filter_Nav_Menu{
	
	protected $homepagePlacement='http://home-placement';
	
	public function __construct ()
	{
		add_filter ('wp_nav_menu_items', array ($this,'filterNavMenu'));
	}
	
	
	
	public function filterNavMenu (string $html)
	{
		$homeUrl=esc_url (home_url('/'));
		$html=str_ireplace ($this->homepagePlacement, $homeUrl, $html);
		return $html;
	}
}
