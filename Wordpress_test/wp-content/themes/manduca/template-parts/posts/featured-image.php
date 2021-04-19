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

 
if ( has_post_thumbnail() && ! post_password_required() && !is_search ()) : ?>

	<?php
	$caption = get_the_post_thumbnail_caption();
	if ( $caption ) :  ?>
		<figure class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
			<div>
				<figcaption class="wp-caption"><?php echo esc_html( $caption ); ?></figcaption>
			</div>
	
		</figure>
	<?php else: ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

<?php endif; ?>

