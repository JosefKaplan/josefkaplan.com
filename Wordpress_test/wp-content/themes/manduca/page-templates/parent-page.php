<?php
/**
 * Template Name: Parent of pages template
 *
 * Display subpages after the content of the page. 
 * Should be use in parent pages e.g. main menu elements. 
 *
 * @ Theme: Manduca - focus on accessibility
 * @ Since 17.1
 **/
 
get_header();
	
while ( have_posts() ) :
    the_post(); 

    printf('<article id="post-%1$s" class="%2$s">',
           get_the_ID(),
           join( get_post_class() )
          );
    printf( '<header><h1>%s</h1></header>',
        get_the_title()
        );
    get_template_part( '/template-parts/postlink', 'edit' ) ;
        
    echo '<div class="entry-content">';
        the_content();
    
    echo '<ul class="entry-content">';
    wp_list_pages( array (
        'child_of' 		=> $post->ID,
        'order'			=>'ASC',
        'orderby'		=>'menu_order',
        'depth'			=> 1,
        'title_li'		=>''
        )
    );
    echo '</ul>';
    echo '</div>';
    echo '</article>';
    
    //Add content after each page		
    do_action( 'manduca_after_single_page' );

endwhile; 
			
get_footer();