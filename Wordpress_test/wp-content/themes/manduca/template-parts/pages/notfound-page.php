<?php
/**
 * This is the default page in case of 404 error.
 *
 *
 * @package Manduca
 * @since 1.0
 *
 **/
?>

<?php get_template_part( 'template-parts/main/twocolums', 'start' ); ?>

			<article>
				<header>
					<h1>
						<?php _e( 'Error 404 &#45; Page Not Found!', 'manduca' ); ?>
					</h1>
					
				</header>

				<div class="entry-content" >
					<p>
						<?php _e( 'The requested page could not be located on this blog. We highly recommend to choose from the HTML sitemap below.', 'manduca' ) ?>
					</p>	
					
					<?php get_template_part( 'template-parts/sitemap' ); ?>
				</div>
			</article>

<?php get_template_part( 'template-parts/main/twocolums', 'finish' ); ?>