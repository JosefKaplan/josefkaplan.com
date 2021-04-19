<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>
			
		</div><!-- #primary -->

		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();