<?php
/**
 * The template for displaying Search Results pages.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php kurma_content_class(); ?>>
		<main id="main" <?php kurma_main_class(); ?>>
			<?php
			/**
			 * kurma_before_main_content hook.
			 *
			 */
			do_action( 'kurma_before_main_content' );

			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						printf( // WPCS: XSS ok.
							/* translators: 1: Search query name */
							__( 'Search Results for: %s', 'kurma' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>
				</header><!-- .page-header -->

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'content', 'search' );

				endwhile;

				kurma_content_nav( 'nav-below' );

			else :

				get_template_part( 'no-results', 'search' );

			endif;

			/**
			 * kurma_after_main_content hook.
			 *
			 */
			do_action( 'kurma_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * kurma_after_primary_content_area hook.
	 *
	 */
	 do_action( 'kurma_after_primary_content_area' );

	 kurma_construct_sidebars();

get_footer();
