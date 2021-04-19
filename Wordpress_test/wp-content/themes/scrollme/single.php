<?php
/**
 * The template for displaying all single posts.
 *
 * @package scrollme
 */

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php scrollme_post_navigation(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
			
		</div><!-- #primary -->

		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();