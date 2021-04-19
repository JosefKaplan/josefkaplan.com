<?php 

/**
* Template Name: Homepage - Full Width
*/

get_header(); ?>

<section id="blog1" class="blog-section full-page">

		<div class="two-tone-layout"><!-- two tone layout start -->

			<div class="row">

				<div class="col-sm-12 content-wrapper"><!-- primary start -->

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page-full' );

					endwhile; // End of the loop.
					?>

				</div>

			</div>

		</div>

</section><!-- #primary -->

<?php
get_footer();
