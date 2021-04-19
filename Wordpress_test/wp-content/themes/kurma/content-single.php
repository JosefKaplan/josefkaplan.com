<?php
/**
 * The template for displaying single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php kurma_article_schema( 'CreativeWork' ); ?>>
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
			<?php
			/**
			 * kurma_before_entry_title hook.
			 *
			 */
			do_action( 'kurma_before_entry_title' );

			if ( kurma_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * kurma_after_entry_title hook.
			 *
			 *
			 * @hooked kurma_post_meta - 10
			 */
			do_action( 'kurma_after_entry_title' );
			?>
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
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'kurma' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * kurma_after_entry_content hook.
		 *
		 *
		 * @hooked kurma_footer_meta - 10
		 */
		do_action( 'kurma_after_entry_content' );

		/**
		 * kurma_after_content hook.
		 *
		 */
		do_action( 'kurma_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
