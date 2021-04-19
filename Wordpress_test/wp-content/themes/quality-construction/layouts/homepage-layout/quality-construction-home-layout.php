<?php

if( ! function_exists( 'quality_construction_home_page_section_hook' ) ):
      function quality_construction_home_page_section_hook() { 
           get_template_part( 'section-parts/section', 'slider'); 
           
     }
   endif;
    add_action( 'quality_construction_home_page_section', 'quality_construction_home_page_section_hook', 10 );
?>