<?php
/**
 * Template Name: Page not found page
 * Used when page not exist (page 404)
 *
 * @ Theme: Manduca - focus on accessibility
 * & Since 17.9.16
 **/

get_header();

	while ( have_posts() ) : the_post(); 
		
        get_template_part( 'template-parts/pages/content', 'page' ); 
					
			//Add content after each page					
			do_action( 'manduca_after_single_page' );
					
			comments_template(); 
			
	endwhile; // end of the loop.
				
get_footer();