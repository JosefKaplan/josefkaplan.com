<?php
/**
 * The template for displaying 404 pages (Not Found).
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
			?>

			<div class="inside-article">

				<?php
				/**
				 * kurma_before_content hook.
				 *
				 *
				 * @hooked kurma_featured_page_header_inside_single - 10
				 */
				do_action( 'kurma_before_content' );
				?>

				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'kurma_404_title', __( 'Oops! That page can&rsquo;t be found.', 'kurma' ) ); // WPCS: XSS OK. ?></h1>
				</header><!-- .entry-header -->

				<?php
				/**
				 * kurma_after_entry_header hook.
				 *
				 *
				 * @hooked kurma_post_image - 10
				 */
				do_action( 'kurma_after_entry_header' );
				?>

				<div class="entry-content" itemprop="text">
					<?php
					echo '<p>' . apply_filters( 'kurma_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'kurma' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * kurma_after_content hook.
				 *
				 */
				do_action( 'kurma_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
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
