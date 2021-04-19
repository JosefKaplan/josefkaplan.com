<?php
/**
 * Template Name: Accessible tab page template
 *
 * Add accessible tabs to sitemap page
 *
 *@see: https://github.com/batyuvitez/manduca/wiki/Create-accessible-tab-page
 */

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/
?>

<?php new Accessible_Tabs; //hook JS to the html ?>



<?php get_header(); ?> 

	<?php  while ( have_posts() ) : the_post(); ?> 
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<header>
							<h1><?php echo str_replace(' | ', '<br />', get_the_title() ); ?></h1>
									
						
							<?php if ( has_post_thumbnail() ) :  ?>
							
								<div>
									<?php the_post_thumbnail( 'post-size' ); ?>
								</div>
					
							<?php endif; ?>
						
					</header>
						
							
				<?php get_template_part( '/template-parts/postlink', 'edit' ) ;?>
				
				<div class="tabs">
					
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' .__( 'Pages','manduca' ), 'after' => '</div>' ) ); ?>
				
				</div>
				
				<div class="clearfix-content"></div>
				
			</article>
							
			<?php do_action( 'manduca_after_single_page' ); ?> 
					
			
	<?php endwhile; ?>
				
<?php get_footer(); ?>