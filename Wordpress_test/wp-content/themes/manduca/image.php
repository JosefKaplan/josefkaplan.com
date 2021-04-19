<?php
/**
 * Display attachment page
 * 
 * @ Theme: Manduca - focus on accessibility
 * @ Since 1.0
 **/

get_header(); 

while ( have_posts() ) :
	the_post(); 

	echo '<article id="post-' .get_the_ID() .'" class="'. join( ' ', get_post_class( 'image-attachment' ) ) .'">';
	echo '<header>';
	echo '<h1  tabindex="0">' .get_the_title() .'</h1>';
	echo '</header>';
	
	echo '<div class="entry-content">';
	
	echo '<div class="attachment">';							
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) :
		if ( $attachment->ID == $post->ID )
			break;
	endforeach;
	
	if ( count( $attachments ) > 1 ) :
		$k++;
		if ( isset( $attachments[ $k ] ) ) :
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else :
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[0]->ID );
		endif;
	else :
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	endif;
	$attachment_size = apply_filters( 'manduca_attachment_size', array( 960, 960 ) );
	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		   esc_url( $next_attachment_url ),
		   the_title_attribute( array( 'echo'=>false ) ),
		   wp_get_attachment_image( $post->ID, $attachment_size )
		   );
	echo '</div>'; //class .attachment
	
	
	echo '<div class="entry-description">';
	wp_link_pages( array( 'before' => '<div class="page-links">'. __( 'Pages', 'manduca' ), 'after' => '</div>' ) ); 
	echo '</div>';
						
	echo '<footer class="entry-meta">';
							
	$metadata = wp_get_attachment_metadata();
	sprintf( '<span class="meta-prep meta-prep-entry-date">' .__( 'Date:', 'manduca' ) .'</span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>, '. __( 'Original size', 'manduca' ) . ': <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> ',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( wp_get_attachment_url() ),
		$metadata['width'],
		$metadata['height'],
		esc_url( get_permalink( $post->post_parent ) ),
		esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
		get_the_title( $post->post_parent )
	);
			
		
	$image_alt 			= get_post_meta( $post->ID, '_wp_attachment_image_alt', true );
	$image_caption  	= $post->post_excerpt;
	$image_description 	= $post->post_content;
	
	echo '<ul>';
	
	printf( '<li>%1$s%2$s: <strong><time class="entry-date" datetime="%3$s">%4$s</time></strong></li>',
		manduca_get_svg( array( 'icon' => 'calendar' ) ),
		__( 'Date:', 'manduca' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
		);
		
	printf( '<li>%1$s%2$s: <strong>%2$s * %3$s</strong></li>',
		   manduca_get_svg( array( 'icon' => 'cube' ) ),
		   __( 'Original size', 'manduca' ),
		   $metadata['width'] ,
		   $metadata['height'] 
		   );
			
	if( empty( $image_alt ) ) {
		$image_alt = __( 'Missing alternative text', 'manduca' );
	}
	printf( '<li>%1$s%2$s: <strong>%3$s</strong></li>',
		   manduca_get_svg( array( 'icon' => 'text' ) ),
		   __( 'Alternative Text' ),
		   $image_alt
		   );
	if( !empty( $image_caption ) ) {
	
		printf( '<li>%1$s%2$s: <strong>%2$s</strong></li>',
			   manduca_get_svg( array( 'icon' => 'film' ) ),
			   __( 'Captions/Subtitles' ),
			   $image_caption
			   );			
	}

	if( !empty( $image_description ) ) {
	
	
		printf( '<li>%1$s%2$s: <strong>%2$s</strong></li>',
			   manduca_get_svg( array( 'icon' => 'bubble' ) ),
			   __( 'Image description'  ),
			   $image_description
			   );
	}
	
	echo '</ul>';  // end of .entry-meta class

	/*
	 * Image navigaton
	 **/
	
	printf( '<nav class="image-navigation nav-single" aria-label="%S">',
		//translators: aria label to announce the navigation area in attachemnt page 
		__( 'Image navigation', 'manduca' )
		);

	 // Retreive current image 
	$post = get_post();
	//echo ' template-functijon class #40  post= <pre>';print_r( $post );echo '</pre>';
	$parent_id = $post->post_parent;
	// Get the parent post Title
	if( !empty( $parent_id ) ) {
		$parent_title = get_the_title( $parent_id );
	}
	else {
	 $parent_title = false ;
	}
	// Get the parent post permalink
	$parent_permalink = get_permalink( $parent_id );
	
	
	/* Get all images */
	$query_images_args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => - 1,
	);
	
	$query_images = new WP_Query( $query_images_args );

	// Input image IDs to $images 
	$images 		= array();
	$previous_id 	= false;
	$previous_title 	= false;
	$one_more 		= false;
	$first_cycle	=true;		
	
	foreach ( $query_images->posts as $image ) {
		//echo ' template-functijon class #51  image= <pre>';print_r( $image );echo '</pre>';die;
		//$images[] = wp_get_attachment_url( $image->ID );
		//$images[] = $image->ID ;
		$next_id = $image->ID;
		$next_title = $image->post_title;
		if( $one_more ) {
			break;
		}
		if( $post->ID == $image->ID ) {
			$one_more = true;
		}
		if( !$first_cycle && !$one_more ) {
			$previous_id = $image->ID;
			$previous_title = $image->post_title;
			}
		else {
			$first_cycle = false;
		}
		//If the cycle runs to the end, there is no next image
		$next_title = false;
	}
   // We need the link of the attachment page.
   
   $previous_permalink  = get_attachment_link( $previous_id );
   $next_permalink 		= get_attachment_link ( $next_id );
	   
	
	
	if ( $previous_title !== false ) {
		printf('<div class="nav-previous"><span class="screen-reader-text">%4$s</span><a href="%2$s">%1$s%3$s</a></div>',
				manduca_get_svg( array( 'icon' => 'angle-circle-left' ) ),
				$previous_permalink,
				$previous_title,
				__( 'Previous', 'manduca' )
				);
	}
	
	if ( $parent_title !== false ) {
		printf( '<div class="parent-post"><span class="screen-reader-text">%4$s</span><a href="%2$s">%1$s%3$s</a></div>',
				manduca_get_svg( array( 'icon' => 'info' ) ),
				$parent_permalink,
				$parent_title,
				//translators: link to the related page on attachment page
				__( 'Related content', 'manduca' )
				);
	}
	
	if ( $next_title !== false ) {
		printf( '<div class="nav-next"><span class="screen-reader-text">%4$s</span><a href="%2$s">%3$s%1$s</a></div>',
				manduca_get_svg( array( 'icon' => 'angle-circle-right' ) ),
				$next_permalink,
				$next_title,
				// translators: Attachment page screen-reader text to next image
				__( 'Next', 'manduca' )
				);
	}
	
	echo '</nav>'; // end of image navigation		
	
	echo '</footer></div></article>';

	comments_template(); 

endwhile;  

get_footer();