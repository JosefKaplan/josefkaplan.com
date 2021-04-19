<?php
/**
 * Author archive page
 * 
 * @ Since 1.0
 **/
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)
	Source code is available at https://github.com/batyuvitez/manduca

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

<?php get_header() ?>
		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
			
			<header>
				<h1  tabindex="0">
				<?php printf( __( 'Post of %s', 'manduca' ), get_the_author() ); ?>
				</h1>
				
			</header>

			<?php rewind_posts(); ?>
			
			<?php
			$author_description = get_the_author_meta( 'description' );
			if ( ! empty ( $author_description ) ) : ?>
				<div class="author-info">
				
					<?php $avatar_html = get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
					<?php if( $avatar_html ) : ?>
						
						<div class="author-avatar"><?php echo $avatar_html; ?></div>
					
					<?php endif; ?>
					
					
					<div class="author-description">
						<h3><?php printf( __( 'About %s', 'manduca' ), get_the_author() ); ?></h3>
						
						<?php
							$user_url= get_the_author_meta( 'user_url' );
							If ( !empty( $user_url ) ) {
								if( function_exists ( 'idn_to_utf8') ) {
									$user_url_utf8 = idn_to_utf8( $user_url );
								}
								else {
									$user_url_utf8 = $user_url;
								}
								printf( '<p><a href="%1$s">%2$s</a></p>',
											$user_url,
											$user_url_utf8
										   ) ;
							}
						?>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div>
				</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/posts/content', 'excerpt' ); ?>

	<?php endif; ?>

<?php get_footer() ?>