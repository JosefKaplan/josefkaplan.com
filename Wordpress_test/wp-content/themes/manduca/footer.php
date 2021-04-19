<?php
/**
 * Display end of the page 
 *
 * @ since 1.0
 **/

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2020  Zsolt Edelényi (ezs@web25.hu)

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
			<?php get_template_part ('template-parts/wrapper/wrapper','bottom'); ?>					
			<?php get_template_part( 'template-parts/footer/footer', 'before' ); ?>
			<div id="footer-wrapper"
				 class="footer-wrapper inverse-scheme"
				 role="contentinfo">
				<h1 class="skip-link" tabindex="0" ><?php _e( 'Footer area' , 'manduca' ); ?></h1>
				<footer id="colophon" >
					<div class="site-info">
						<?php get_template_part( 'template-parts/footer/footer', 'menu' ); ?>
						<?php get_template_part( 'template-parts/footer/footer', 'siteinfo' ); ?>
					</div>
				</footer>
				<div class="clearfix"></div>
			</div>
			
			<?php get_template_part( 'template-parts/footer/footer', 'after' ); ?>
			<?php wp_footer(); ?>
		</div> <?php // closing tag of  .site #page  ?>
		<div id=manducaPushUp> </div>
	</body>
</html>