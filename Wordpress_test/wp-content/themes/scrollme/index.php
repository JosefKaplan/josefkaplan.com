<?php
/**
 * The main template file.
 *
 * @package scrollme
 */

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">

			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
						get_template_part( 'template-parts/content' );
					?>
				<?php endwhile; ?>

				<?php the_posts_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			
		</div><!-- #primary -->

		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();