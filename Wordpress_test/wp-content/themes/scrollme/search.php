<?php
/**
 * The template for displaying search results pages.
 *
 * @package scrollme
 */

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">
					<header class="page-header">
						<h1 class="page-title"><?php /* translators: %s : search keyword */ printf( esc_html__( 'Search Results for: %s', 'scrollme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->
					<?php if ( have_posts() ) : ?>
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
							?>
						<?php endwhile; ?>

						<?php the_posts_navigation(); ?>


					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

		</div><!-- #primary -->

		<?php get_sidebar( 'right' ); ?>
	</div>

<?php get_footer();