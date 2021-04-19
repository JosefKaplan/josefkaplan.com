<?php
/**
 * Display content of page
 *
 * @ Since 1.0
 **/
/* This file is part of Manduca 
 * Manduca is a free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/
?>


<?php get_header();?>

	<?php while ( have_posts() ) : the_post(); ?>
		
        <?php get_template_part( 'template-parts/pages/content', 'page' ); ?>
					
			<?php do_action( 'manduca_after_single_page' );?>
					
			<?php comments_template(); ?>
			
	<?php endwhile; // end of the loop.?>
				
<?php get_footer(); ?>