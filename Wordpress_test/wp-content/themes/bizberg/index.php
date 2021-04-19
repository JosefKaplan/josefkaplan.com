<?php
get_header(); ?>
	
	<?php do_action( 'bizberg_before_homepage_blog' ); ?>

	<section id="blog" class="blog-lists <?php echo esc_attr( bizberg_sidebar_position() ); ?>">

	    <div class="container">

		    <div class="row">

		    	<?php 
		    	$homepage_blog_title = bizberg_get_theme_mod( 'homepage_blog_title' );

		    	if( !empty( $homepage_blog_title ) ){ ?>

			    	<div class="<?php echo bizberg_check_blog_title_class(); ?>">			    		
			    		<h2 class="homepage_blog_title"><?php echo esc_html( $homepage_blog_title ); ?></h2>
			    	</div>

			    	<?php 

			    } ?>

		    	<div class="<?php echo bizberg_check_sidebar_active_inactive_class_home(); ?>">	    		

					<?php

					$front_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(
						'post_type' => 'post',
						'paged'     => $front_paged,
						'cat'       => absint( bizberg_get_theme_mod( 'homepage_latest_posts_category' ) )
					);

					$frontpage_post_query = new WP_Query( $args );
					$max_num_pages = $frontpage_post_query->max_num_pages;

					if ( $frontpage_post_query->have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						/* Start the Loop */
						echo '<div class="row" id="content">';

						while ( $frontpage_post_query->have_posts() ) : $frontpage_post_query->the_post();

							if( bizberg_sidebar_position() != 'blog-nosidebar-1' ){
								get_template_part( 'template-parts/content', get_post_format() );
							} else {
								get_template_part( 'template-parts/content', 'nosidebar' );
							}

						endwhile;
						echo '</div>';

						/**
						* Without changing the $GLOBALS['wp_query']->max_num_pages, the pagination will not work
						*/
						
						$GLOBALS['wp_query']->max_num_pages = $max_num_pages;
						bizberg_numbered_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; 

					wp_reset_postdata();

					?>					

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

	<?php do_action( 'bizberg_after_homepage_blog' ); ?>

<?php
get_footer();
