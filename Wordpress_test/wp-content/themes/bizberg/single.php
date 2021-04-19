<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bizberg
 */

get_header(); ?>

	<section id="blog" class="blog-section blog-detail-page">

		<div class="container">

			<div class="row">

				<div class="two-tone-layout"><!-- two tone layout start -->

					<div class="<?php echo bizberg_check_sidebar_active_inactive_class_page(); ?>" id="content"><!-- primary start -->

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'detail' );

							the_post_navigation();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</div>

					<?php 

					if( is_active_sidebar( 'sidebar-2' ) ){ ?>

						<div class="col-md-4 col-sm-12 bizberg_sidebar">
							<?php 
							get_sidebar(); 
							?>
						</div>

						<?php 

					} ?>

				</div>
			
			</div>

		</div>

	</section>

<?php
get_footer();
