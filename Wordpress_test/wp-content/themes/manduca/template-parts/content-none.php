<?php
/**
 * Manduca
 *
 * @since 1.0 */

?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing found', 'manduca' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'No results were found. Perhaps to choose from the HTML sitemap below.', 'manduca' ); ?></p>
			<h2><?php _e( 'Sitemap', 'manduca' ) ?></h2>
			<?php get_template_part( '/sitemap' ); ?>

		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
