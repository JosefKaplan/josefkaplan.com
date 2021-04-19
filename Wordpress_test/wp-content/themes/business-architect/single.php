<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header(); ?>

<div id="content" class="site-content">

<div id="primary" class="content-area col-xs-12 col-sm-8 col-md-9 col-lg-9">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the single post content template.
			get_template_part( 'templates/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation(
					array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'business-architect' ),
					)
				);
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation(
					array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'business-architect' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'business-architect' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'business-architect' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'business-architect' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					)
				);
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_sidebar(); ?>

</div><!-- site content-->

<?php get_footer(); ?>
