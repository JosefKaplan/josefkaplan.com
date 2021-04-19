<?php
/**
 * Template Name: Home Elementor Template
 *
 * Displays the Home Template of the theme for Elementor Page Builder.
 * @package purea-magazine
 */

get_header();

?>

<div id="primary" class="<?php echo esc_attr(get_theme_mod('purea_magazine_header_menu_style','style1')); ?> content-area">
	<main id="main" class="site-main" role="main">
		<div class="content-inner">
			<?php the_content() ?>
		</div>
	</main>
</div>

<?php
get_footer();