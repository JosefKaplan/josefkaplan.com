<?php
/**
 * Generate breadcrumb
 * Header template file
 * 
 * @ Theme: Manduca - focus on accessibility 
 * @ Since 17.10.7
 **/

 
 class manduca_breadcrumb extends breadcrumb {
    
    
    
    public function customize_breadcrumb() {
	
        //translators: Breadcrumb prefix text: 
        $prefix_text=__( 'You are here:', 'manduca' );
        
        //Translators: Breadcrumb name (for screen readers)
        $name=__('breadcrumb', 'manduca');
        $aria_label='aria-label="'.$name .'"';
        $this->templates = array(
            'before' 		=> '<nav id="breadcrumb" class="breadcrumb" '.$aria_label.'><span>' .$prefix_text .'</span><ul>',
            'after' 		=> '</ul></nav>',
            'standard' 		=> '<li>%1$s %2$s</li>',  // %1 :breadcrumb link %2: separator 
            'current' 		=> '<li class="current">%s</li>',
            'link' 			=> '<a href="%s"><span >%s</span></a>'
        );
        $this->options = array(
          //Post Type term as index
          'show_pta'		=>false,
          
          // which taxonomy to show
          'show_tax'   => 'category',
          
          // show hierarchical terms for post types
         'show_htfpt' => true, 							
         
         'separator'		=> manduca_get_svg( array( 'icon' => 'arrow-right-double' ) ) ,
         
         'posts_on_front' => 'posts' == get_option( 'show_on_front' ) ? true : false,
         
         // The ID of the page that displays posts. Useful when show_on_front's value is page
         'page_for_posts' => get_option( 'page_for_posts' ),  
         
         // support pagination
         'show_pagenum' => true, 						
        );
        
        $this->strings  = array(
         // Translators: Breadcrumb home page.
         'home' => __( 'Home', 'manduca' ),
         
         //Translators: search page singular in breadcrumb
         'search' => __( '%s hits of searching for <em>%s</em>', 'manduca' ),
         
         //Translators: Breadcrumb paginated pages
         'paged' => __( 'Page %d', 'manduca' ),
         
         //Translators: Breadcrumb page not found text
         '404_error' => __( 'Page not found', 'manduca' )
		);
		
	}
}
$breadcrumb = new manduca_breadcrumb();
$breadcrumb->customize_breadcrumb();
echo $breadcrumb->output();
