<?php
/**
 * Template Name: page-builder
 */

get_header(); ?>

<div id="content" class="site-content">

<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<main id="main" class="site-main" role="main">
		<div class="entry-content">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
		</div>
	</main><!-- .site-main -->


</div><!-- .content-area -->

</div><!-- site content-->

<?php get_footer(); ?>
