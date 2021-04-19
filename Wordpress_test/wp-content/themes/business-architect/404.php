<?php
/**
 * The template for displaying 404 pages (not found)
 * */

get_header(); ?>

<div id="content" class="site-content">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'business-architect' ); ?></h1>
	</header><!-- .page-header -->
	
	<div id="primary" class="content-area col-xs-12 col-sm-8 col-md-9 col-lg-9">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">


				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'business-architect' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php get_sidebar(); ?>

</div><!-- site content-->

<?php get_footer(); ?>
