<?php
/**
 *
 * Wortex Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2014-2020 Iceable Themes - https://www.iceablethemes.com
 *
 * 404 Page Template
 *
 */

get_header();

?><div id="page-title">
	<div class="container">
		<h2><?php esc_html_e( '404: Page Not Found', 'wortex-lite' ); ?></h2>
	</div>
</div>

<div id="main-content" class="container">
	<div id="page-container" class="with-sidebar">

		<h2><?php esc_html_e( 'Page Not Found', 'wortex-lite' ); ?></h2>
		<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'wortex-lite' ); ?></p>
		<p><?php esc_html_e( 'Maybe a search will help ?', 'wortex-lite' ); ?></p>
		<?php get_search_form(); ?>

	</div>

	<div id="sidebar-container">
		<?php get_sidebar(); ?></div>
	</div>

</div>

<?php
get_footer();
