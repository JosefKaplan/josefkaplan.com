<?php
//add aria-current="page to the current menu item. 
class Accessible_Menu {
    
    public function __construct() {
        
			
			add_filter(
					   'walker_nav_menu_start_el',
					   array( $this, 'change_current_menu_item' ),
					   4,
					   12
					  );
    }
    
    public function change_current_menu_item( $item_output, $item, $depth, $args  ) {
		if( in_array( 'current-menu-item', $item->classes ) ) {
				$item_output = sprintf( '<span class="current-menu-item">%s <span class="screen-reader-text">%s </span>%s</span>',
									   manduca_get_svg( array( 'icon' => 'current') ),
									   //translators it is duplicate: same as in Link_Functions: screen reader text for self-link. 
									   __( 'Current page', 'manduca' ),
									   $item->title
									   );
		}
		return $item_output;
	}
	
	
}