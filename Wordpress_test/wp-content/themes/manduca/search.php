<?php
/**
 * Display search result page. 
 * 
 * @Since 1.0
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)

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

		<?php if ( have_posts() ) : ?>

			<header class="entry-header no-thumbnail">
				<h1>
				<?php
				 global $wp_query;
                    /* translators: %1$s is the number of results found, %2$s is the search term */
                    printf( __( 'Found %1$s search result for keyword: %2$s', 'manduca' ), 
                            number_format_i18n( $wp_query->found_posts ), 
                            '<span class="twocolumns">' . get_search_query() . '</span>' 
                    );
				?>
				</h1>
			</header>

			
			<?php get_template_part( 'template-parts/posts/content', 'excerpt' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
					<h1 tabindex="0"><?php printf( __( 'No matching result found for %s.', 'manduca' ), get_search_query() ) ?></h1>
				</header>

				<div class="entry-content">
					<?php get_search_form(); ?>
				</div>
			</article>

		<?php endif; ?>

<?php get_footer(); ?>