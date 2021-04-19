<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bizberg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('detail-content single_page'); ?>>

	<div class="entry-content">

		<?php

		if( has_post_thumbnail() ){
			the_post_thumbnail( 
				'large', 
				[
					'class' => 'bizberg_featured_image', 
					'title' => get_the_title(),
					'alt' => get_the_title()
				] 
			);
		} ?>

		<header class="entry-header">
			<?php the_title( '<h3 class="blog-title">', '</h3>' ); ?>
		</header><!-- .entry-header -->

		<?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bizberg' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'bizberg' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
