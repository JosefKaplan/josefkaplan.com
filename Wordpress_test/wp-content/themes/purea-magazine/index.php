<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purea-magazine
 */

get_header(); ?>

<div id="primary" class="<?php echo esc_attr(get_theme_mod('purea_magazine_header_menu_style','style1')); ?> content-area">
	<div id="main" class="site-main" role="main">
		<div class="content-inner">
			<div id="blog-section">
		        <div class="row">
		        	<?php
		        		if('right'===esc_html(get_theme_mod('purea_magazine_blog_sidebar_layout','right'))) {
		        			?>
		        				<?php
        							if ( is_active_sidebar('sidebar-1')){
        								?>
        									<div id="post-wrapper" class="col-md-9">
        										<?php
													if(have_posts() ) {									
														while(have_posts() ) {
															the_post();
															/*
															 * Include the Post-Format-specific template for the content.
															 * If you want to override this in a child theme, then include a file
															 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
															*/
															get_template_part( 'template-parts/post/content', get_post_format());										
														}									

														?>
											                <nav class="pagination">
											                    <?php the_posts_pagination(); ?>
											                </nav>
														<?php	
													}
																
												?>		
								            </div>
								            <div id="sidebar-wrapper" class="col-md-3">
								            	<?php get_sidebar('sidebar-1'); ?>
								            </div>
        								<?php		
        							}
        							else{
        								?>
        									<div class="col-md-12">
												<?php
													if(have_posts() ) {									

														while(have_posts() ) {
															the_post();
															/*
															 * Include the Post-Format-specific template for the content.
															 * If you want to override this in a child theme, then include a file
															 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
															 */
															get_template_part( 'template-parts/post/content', get_post_format());										
														}									

														?>
								                			<nav class="pagination">
								                    			<?php the_posts_pagination(); ?>
								                			</nav>
														<?php	
													}
												?>
								            </div>
        								<?php
        							}
        						?>
		        			<?php
		        		}
		        		else if('left'===esc_html(get_theme_mod('purea_magazine_blog_sidebar_layout','right'))) {
		        			?>
		        				<?php
    								if ( is_active_sidebar('sidebar-1')){
    									?>
    										<div id="sidebar-wrapper" class="col-md-3">
    											<?php get_sidebar('sidebar-1'); ?>
									        </div>
								            <div id="post-wrapper" class="col-md-9">
								            	<?php
													if(have_posts() ) {
														while(have_posts() ) {
															the_post();
															/*
															 * Include the Post-Format-specific template for the content.
															 * If you want to override this in a child theme, then include a file
															 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
															 */
															get_template_part( 'template-parts/post/content', get_post_format());										
														}									

														?>
										                	<nav class="pagination">
										                		<?php the_posts_pagination(); ?>
										                	</nav>
														<?php	
													}		
												?>
								            </div>
    									<?php
    								}
    								else{
    									?>
    										<div class="col-md-12">
												<?php
													if(have_posts() ) {									

														while(have_posts() ) {
															the_post();
															/*
															 * Include the Post-Format-specific template for the content.
															 * If you want to override this in a child theme, then include a file
															 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
															 */
															get_template_part( 'template-parts/post/content', get_post_format());										
														}									

														?>
								                			<nav class="pagination">
								                    			<?php the_posts_pagination(); ?>
								                			</nav>
														<?php	
													}
												?>
								            </div>
    									<?php
    								}
    							?>			        				
		        			<?php
		        		}
		        		else{
		        			?>
								<div class="col-md-12">
									<?php
										if(have_posts() ) {									

											while(have_posts() ) {
												the_post();
												/*
												 * Include the Post-Format-specific template for the content.
												 * If you want to override this in a child theme, then include a file
												 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
												 */
												get_template_part( 'template-parts/post/content', get_post_format());										
											}									

											?>
					                			<nav class="pagination">
					                    			<?php the_posts_pagination(); ?>
					                			</nav>
											<?php	
										}
									?>
					            </div>
							<?php
		        		}
		        	?>			            
		        </div>
			</div>
		</div>
	</div>
</div>


<?php

get_footer();
