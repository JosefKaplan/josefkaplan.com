<?php

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
<?php
 get_header();

	if ( have_posts() ) : 

	// Start the Loop
	while ( have_posts() ) : the_post(); 	
		get_template_part( 'template-parts/posts/content' ); 
	
	endwhile; 

	get_template_part( 'template-parts/posts/navigation' ); 

	else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
			?>
				<header class="entry-header">
					<h1><?php _e( 'No post', 'manduca' ) ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post?', 'manduca' ) .'<a href="%s">' .__( 'Get started here!', 'manduca' ) .'</a>', admin_url( 'post-new.php' ) ); ?></p>
				</div>

			<?php else :
				
			?>
				<header>
					<h1><?php _e( 'Nothing found', 'manduca' ) ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Maybe try a search.', 'manduca' ) ?></p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>

			</article>

		<?php endif; // end have_posts() check ?>
		
<?php get_footer(); ?>