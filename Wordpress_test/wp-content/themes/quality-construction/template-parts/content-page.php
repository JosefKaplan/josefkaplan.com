<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 <div class="feature-image">
			 	<?php
			      if(has_post_thumbnail()) {
			          ?>
			             <?php the_post_thumbnail( 'full' ); ?>
			    	  <?php } ?>
			 </div>
			<div class="textcont">
			  <?php 
			  	the_content();
			 	wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:','quality-construction'),
					'after'  => '</div>',
				) );

			 if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Edit %s','quality-construction'),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div>
</article><!-- #post-## -->