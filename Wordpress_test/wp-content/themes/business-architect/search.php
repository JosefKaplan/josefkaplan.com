<?php
/**
 * The template for displaying search results pages
 * */

get_header(); ?>

<div id="content" class="site-content">

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'business-architect' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</header><!-- .page-header -->
			
	<section id="primary" class="content-area col-xs-12 col-sm-8 col-md-9 col-lg-9">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>


			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'templates/content', 'search' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous page', 'business-architect' ),
					'next_text'          => esc_html__( 'Next page', 'business-architect' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'business-architect' ) . ' </span>',
				)
			);

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'templates/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_sidebar(); ?>

</div><!-- site content-->

<?php get_footer(); ?>
