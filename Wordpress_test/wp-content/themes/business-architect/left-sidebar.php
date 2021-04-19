<?php
/**
 * Template Name: Left Sidebar
 * */

get_header(); ?>

<div id="content" class="site-content">

<?php get_sidebar(); ?>

<div id="primary" class="content-area col-xs-12 col-sm-8 col-md-9 col-lg-9">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the page content template.
			get_template_part( 'templates/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->


</div><!-- .content-area -->


</div><!-- site content-->

<?php get_footer(); ?>
