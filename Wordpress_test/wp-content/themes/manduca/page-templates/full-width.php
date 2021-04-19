<?php
/**
 * Template Name: Full-width Page Template
 *
 * @ Theme: Manduca - focus on accessibility*
 * @ Since 1.6.8 */


get_header();

while ( have_posts() ) : the_post(); 
    
    get_template_part( 'template-parts/pages/content', 'page' ); 
    
    //Add content after each page		
    do_action( 'manduca_after_single_page' );
    
endwhile; // end of the loop.

get_footer();
?>