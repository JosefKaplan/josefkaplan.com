<?php
/**
 * The template for displaying Archive pages.
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

			if ( have_posts() ) :

				/**
				 * kurma_archive_title hook.
				 *
				 *
				 * @hooked kurma_archive_title - 10
				 */
				do_action( 'kurma_archive_title' );

				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;

				kurma_content_nav( 'nav-below' );

			else :

				get_template_part( 'no-results', 'archive' );

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
