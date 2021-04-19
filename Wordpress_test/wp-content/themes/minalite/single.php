<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package minalite
 */

get_header(); 

$minalite_sidebar_post = get_theme_mod( 'minalite_sidebar_post' );

?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main <?php if($minalite_sidebar_post) : ?>full-width<?php endif; ?>" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php if( $minalite_sidebar_post == false ) : ?>

		<aside class="sidebar widget-area">
			<?php get_sidebar(); ?>
		</aside><!-- #sidebar -->

		<?php endif; ?>

	</div><!-- #primary -->

<?php
get_footer();