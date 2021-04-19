<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package scrollme
 */

get_header(); ?>

<div class="container clearfix no_sidebar">
	<div id="primary" class="content-area">

		<section class="error-404 not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'scrollme' ); ?></h1>
			</header><!-- .page-header -->

			<div class="error-404-msg">400<span>Error</span></div>

		</section><!-- .error-404 -->

	</div>
</div>

<?php get_footer();