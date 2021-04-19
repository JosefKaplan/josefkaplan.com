<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minalite
 */

get_header();

$minalite_home_sidebar = get_theme_mod( 'minalite_home_sidebar' );

?>


	<div id="primary" class="content-area container">
		<main id="main" class="site-main <?php if($minalite_home_sidebar) : ?>full-width<?php endif; ?>" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->

		<?php if( $minalite_home_sidebar == false ) : ?>

		<aside class="sidebar widget-area">
			<?php get_sidebar(); ?>
		</aside><!-- #sidebar -->

		<?php endif; ?>

	</div><!-- #primary -->

<?php
get_footer();
