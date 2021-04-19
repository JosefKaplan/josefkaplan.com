<?php 

//=============================================================
// Color reset
//=============================================================
if ( ! function_exists( 'quality_construction_reset_colors' ) ) :

    function quality_construction_reset_colors($data) {

         set_theme_mod('quality_construction_top_header_background_color','#ffffff');

         set_theme_mod('quality_construction_top_footer_background_color','#1A1E21');

         set_theme_mod('quality_construction_bottom_footer_background_color','#111315');

         set_theme_mod('quality_construction_primary_color','#EEB500');

         set_theme_mod('quality_construction_color_reset_option','do-not-reset');
         
    }

endif;
add_action( 'quality_construction_colors_reset','quality_construction_reset_colors', 10 );


