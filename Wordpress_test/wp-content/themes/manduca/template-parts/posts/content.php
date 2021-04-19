<?php
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2020  Zsolt Edelényi (ezs@web25.hu)

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

if (is_sticky())
	$sticky='featured-article';
else
	$sticky='';

?>		
<article id="post-<?php the_ID(); ?>" <?php post_class($sticky); ?>>
	
	<?php if ( has_post_thumbnail() ) {
				$class = 'has-thumbnail'; 
			}
			else{
				$class = 'no-thumbnail';
			}
			//display header tag
			printf( '<header class="content-header %s">',
				   $class
				   );
	?>
			
		<?php get_template_part( 'template-parts/posts/entry-header' ); ?>

		<?php get_template_part( 'template-parts/posts/featured-image' ); ?>
		
	</header>
	<?php get_template_part( '/template-parts/postlink', 'edit' ) ; ?>
	

	<div class="entry-content" >
		
		<?php the_content() ; //last correction: @17.9?>
		
		<?php Manduca_Template_Functions::manduca_link_pages(); ?>
	
	<div class="clearfix-content"></div>
	</div>
	
	<?php
		/* Action hook: manduca_after_entry_content
		 * Add something after entry content
		 * @since 17.2.8
		 * */
		do_action( 'manduca_after_entry_content' );
	?>

	<footer class="lighter-scheme">
		<?php get_template_part( 'template-parts/posts/content', 'meta' ); ?>
	</footer>

</article>