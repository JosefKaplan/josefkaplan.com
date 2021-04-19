<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purea-magazine
 */


get_header();
purea_magazine_before_title();
purea_magazine_after_title();

?>

<div id="primary" class="<?php echo esc_attr(get_theme_mod('purea_magazine_header_menu_style','style1')); ?> content-area">
	<main id="main" class="site-main" role="main">
		<div class="content-inner">
			<div id="blog-section">
		        <div class="row">
		        	<div class="archive heading">
		        		<h1 class="main-title"><?php the_archive_title(); ?></h1>
		        	</div>
		        	<?php
		        		if('right'===esc_html(get_theme_mod('purea_magazine_blog_sidebar_layout','right'))) {
		        			?>
		        				<div class="col-md-9">
									<?php
										if(have_posts() ) {						

											while(have_posts() ) {
												the_post();
												/*
												 * Include the Post-Format-specific template for the content.
												 * If you want to override this in a child theme, then include a file
												 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
												 */
												get_template_part( 'template-parts/post/content-archive', get_post_format());										
											}									

											?>
					                			<nav class="pagination">
					                    			<?php the_posts_pagination(); ?>
					                			</nav>
											<?php	
										}
										
									?>
					            </div>
					            <div class="col-md-3">
					                <?php get_sidebar('sidebar-1'); ?>
					            </div>
		        			<?php
		        		}
		        		else if('left'===esc_html(get_theme_mod('purea_magazine_blog_sidebar_layout','right'))) {
		        			?>
		        				<div class="col-md-3">
					                <?php get_sidebar('sidebar-1'); ?>
					            </div>
					            <div class="col-md-9">
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
		        </div>
			</div>
		</div>
	</main>
</div>

<?php

get_footer();