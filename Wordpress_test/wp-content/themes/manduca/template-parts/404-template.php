<?php
/**
 * Display page 404
 * if there is one page is saved with "page not found page" template, that is used instead of this.
 *
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

<?php
	$args = array(
				'post_type' => 'page',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key' => '_wp_page_template',
						'value' => 'page-templates/page-notfound.php'
					)
				)
			);
		$the_pages = new WP_Query( $args );
							
		if( $the_pages->have_posts() ){
				
				$the_pages->the_post();
				$title 		= the_title( '', '', false );
				$content  	= get_the_content();
				$content	= apply_filters( 'the_content', $content );
		}
		else{
			//Translators: Default 404 page title
			$title 		= __( 'Error 404 &#45; Page Not Found!', 'manduca' );
			// Translators: Default 404 page content
			$content 	= __( 'The requested page could not be located on this blog.', 'manduca' ) ;
		}
		
		$article = array(
				'title' 	=> $title,
				'content' 	=> $content
				);

?>

<article>
	<header class="no-thumbnail">
		<h1  tabindex="0">
			<?php echo $article[ 'title' ]; ?>
		</h1>
	</header>

	<div class="entry-content" >
		<?php echo $article[ 'content' ]; ?>
	</div>
</article>

