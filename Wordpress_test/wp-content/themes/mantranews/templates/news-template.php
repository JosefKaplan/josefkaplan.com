<?php
/**
 * Template Name: News Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */
get_header(); ?>

	<div class="featured-slider-section clearfix">

			<?php
	        	if( is_active_sidebar( 'mantranews_home_slider_area' ) ) {
	        		dynamic_sidebar( 'mantranews_home_slider_area' );
	         	}
	        ?>

	</div><!-- .featured-slider-section -->
	<div class="home-content-wrapper clearfix">

			<div class="home-primary-wrapper">
					<?php
			        	if( is_active_sidebar( 'mantranews_home_content_area' ) ) {
			            	dynamic_sidebar( 'mantranews_home_content_area' );
			         	}
			        ?>

			</div><!-- .home-primary-wrapper -->
			<div class="home-secondary-wrapper">
				<?php
		        	if( is_active_sidebar( 'mantranews_home_sidebar' ) ) {
		            	dynamic_sidebar( 'mantranews_home_sidebar' );
		         	}
		        ?>
			</div><!-- .home-secondary-wrapper -->

	</div><!-- .home-content-wrapper -->
<?php
get_footer();
