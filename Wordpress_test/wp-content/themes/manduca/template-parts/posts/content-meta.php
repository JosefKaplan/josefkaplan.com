<?php
/**
 * Display the meta data of the post*
 
 * @ Theme Manduca - focus on accessibility
 * @ Since  17.1
 **/


$meta_generator = new Meta_Tag_Generators;
$list_item_mask 	= '<li>%s<span class=metaBlock><span>%s : </span>%s</span></li>';

$utility_text 	= sprintf(
							$list_item_mask,
							manduca_get_svg( array( 'icon' => 'calendar' ) ) ,
							// translators: Date of post - in the post meta. 
							__( 'Entry date', 'manduca' ),
							$meta_generator->get_post_date()
						);

if( get_the_date() !== get_the_modified_date() ) {
	$utility_text 	.= sprintf(
							$list_item_mask,
							manduca_get_svg( array( 'icon' => 'calendar-add' ) ) ,
							//translators: Last modification of post - in the post meta
							 __( 'Last revision', 'manduca' ),
							 $meta_generator->get_modified_date()
						);				
}


$utility_text 	.= sprintf(
							$list_item_mask,
							manduca_get_svg( array( 'icon' => 'author' ) ),
							//translators: Author of post - in the post meta
							 __( 'Author', 'manduca' ),
							 $meta_generator->get_authors()
						);				

if ( has_category() ) {

	$utility_text 	.= sprintf(
							$list_item_mask,
							manduca_get_svg( array( 'icon' => 'folder-open' ) ),
							//translators: Category of post - in the post meta
							 __( 'Category', 'manduca' ),
							 get_the_category_list( ', ' )
						);			
}

if ( has_tag()) {

	$utility_text 	.= sprintf(
							$list_item_mask,
							manduca_get_svg( array( 'icon' => 'tags' ) ),
							//translators: Tags of post - in the post meta
							 __( 'Tags', 'manduca' ),
							 get_the_tag_list( '', ', ' )
						);			
}

$meta_header='<h2 class="screen-reader-text">'. __( 'Post meta', 'manduca' ) .'</h2>';
printf( '<div class="metatags">%s<ul>%s</ul></div>',
					$meta_header,
					$utility_text
					);


// Print author info if necessary. 

if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) :  ?>
	<div class="author-info">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
		</div>
		
		<div class="author-description">
			<h3><?php printf( __( 'Author: %s', 'manduca' ), get_the_author() ); ?></h3>
			<p><?php the_author_meta( 'description' ); ?></p>
			<div class="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( __( 'All posts by %s', 'manduca' ) , get_the_author() ) ; ?>
					<?php echo manduca_get_svg( array( 'icon' => 'angle-circle-right' ) ) ?>
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>

