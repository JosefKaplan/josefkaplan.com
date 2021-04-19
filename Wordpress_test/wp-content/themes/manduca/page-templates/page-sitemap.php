<?php
/**
 * Template Name: Sitemap Page Template
 *
 * @since: 17.11
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

    Source code is available at https://github.com/batyuvitez/manduca
    Manduca is free software: you can redistribute it and/or modify
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
 
<?php get_header(); ?>

<?php $title = str_replace(' | ', '<br />', get_the_title() ); // Change | to line break ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header>
				<h1><?php echo $title ; ?></h1>
						
			
				<?php if ( has_post_thumbnail() ) :  ?>
				
					<div>
						<?php the_post_thumbnail( 'post-size' ); ?>
					</div>
		
				<?php endif; ?>
			
		</header>
			
				
	<?php get_template_part( '/template-parts/postlink', 'edit' ) ;?>
	
	<div class="entry-content" id="sitemap-wrapper">
		
    <?php $sitemap = new \Manduca\Sitemap;	?>
    
    <button class="js-expandmore-all"><?php _e( 'Expand all', 'manduca' ) ; ?></button>
    
        
        <h2 class="js-expandmore"><?php _e( 'Authors', 'manduca' ); ?></h2>
        <div class="js-to_expand"><?php echo $sitemap->authors(); ?></div>
        
        <h2 class="js-expandmore"><?php _e( 'Pages', 'manduca' ); ?></h2>
        <div class="js-to_expand"><?php echo $sitemap->pages(); ?></div>
        
        <h2 class="js-expandmore"><?php _e( 'Posts by category', 'manduca' ); ?></h2>
        <div class="js-to_expand"><?php echo $sitemap->posts_by_category(); ?></div>
        
        <h2 class="js-expandmore"><?php _e( 'Posts in alphabetical', 'manduca' ); ?></h2>
        <div class="js-to_expand"><?php echo $sitemap->posts_in_abc(); ?></div>
        
        <h2 class="js-expandmore"><?php _e( 'Images', 'manduca' ); ?></h2>
        <div class="js-to_expand"><?php echo $sitemap->images(); ?></div>
        
        <?php $pdfs = $sitemap->pdfs(); ?>
        <?php if( $pdfs ) : ?>
            <h2 class="js-expandmore"><?php _e( 'PDFs', 'manduca' ); ?></h2>
            <div class="js-to_expand"><?php echo $pdfs; ?></div>
        <?php endif; ?>
    </div>
	
</article>
<?php get_footer(); ?>