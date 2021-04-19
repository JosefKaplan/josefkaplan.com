<?php
get_header(); ?>

	<section id="blog" class="blog-lists <?php echo esc_attr( bizberg_sidebar_position() ); ?>">

	    <div class="container">

		    <div class="row">

		    	<div class="<?php echo bizberg_check_sidebar_active_inactive_class(); ?>">	    		

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						echo '<div class="row" id="content">';
						while ( have_posts() ) : the_post();

							if( bizberg_sidebar_position() != 'blog-nosidebar-1' ){
								get_template_part( 'template-parts/content', get_post_format() );
							} else {
								get_template_part( 'template-parts/content', 'nosidebar' );
							}

						endwhile;
						echo '</div>';

						bizberg_numbered_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>					

				</div>

				<?php 
				
				/**
				* Disable sidebar in grid view
				*/

				if( bizberg_sidebar_position() != 'blog-nosidebar-1' ){ 

					if( is_active_sidebar( 'sidebar-2' ) ){ ?>

						<div class="col-md-4 col-sm-12 bizberg_sidebar">
							<?php get_sidebar(); ?>
				    	</div>

						<?php
					
					}

				} ?>				

			</div>

		</div>

	</section>

<?php
get_footer();
