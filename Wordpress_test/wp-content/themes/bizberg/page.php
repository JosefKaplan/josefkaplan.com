<?php get_header(); ?>

	<section id="blog" class="blog-section bizberg_default_page">

		<div class="container">

			<div class="row">

				<div class="two-tone-layout"><!-- two tone layout start -->

					<div class="<?php echo bizberg_check_sidebar_active_inactive_class_page(); ?>" id="content"><!-- primary start -->

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</div>

					<?php
					if( class_exists( 'WooCommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ){
						// Do nothing
					} elseif( is_active_sidebar( 'sidebar-2' ) ){ ?>
						<div class="col-md-4 col-sm-12 bizberg_sidebar">
							<?php 
							get_sidebar(); 
							?>
						</div>
						<?php
					} ?>

				</div>

			</div>

		</div><!-- #main -->
	
	</section><!-- #primary -->

<?php
get_footer();
