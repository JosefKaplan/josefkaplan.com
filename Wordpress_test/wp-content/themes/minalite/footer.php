<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package minalite
 */

?>

	</div><!-- #content -->

	<div id="instagram-footer" class="instagram-footer">

		<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-2') ) ?>
		
	</div>

	<footer id="colophon" class="site-footer container" role="contentinfo">

		<div id="footer-social">
				
			<?php if(get_theme_mod('minalite_facebook')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_twitter')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_instagram')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i> <span>Instagram</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_pinterest')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_bloglovin')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i> <span>Bloglovin</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_google')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i> <span>Google+</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_tumblr')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_tumblr')); ?>" target="_blank"><i class="fa fa-tumblr"></i> <span>Tumblr</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_youtube')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i> <span>Youtube</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_soundcloud')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_soundcloud')); ?>" target="_blank"><i class="fa fa-soundcloud"></i> <span>Soundcloud</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_vimeo')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i> <span>Vimeo</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_linkedin')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a>
			<?php endif; ?>
			<?php if(get_theme_mod('minalite_rss')) : ?>
				<a href="<?php echo esc_url(get_theme_mod('minalite_rss')); ?>" target="_blank"><i class="fa fa-rss"></i> <span>Rss</span></a>
			<?php endif; ?>
				
		</div>

		<div class="site-info container">
			<?php printf(esc_html__('%1$s %2$s %3$s', 'minalite'), '&copy;', esc_attr(date_i18n(__('Y', 'minalite'))), esc_attr(get_bloginfo())); ?>
                <span class="sep"> &ndash; </span>
            <?php printf(esc_html__('%1$s MinaLite theme by %2$s', 'minalite'), '', '<a href="' . esc_url('https://zthemes.net/', 'minalite') . '">ZThemes</a>'); ?>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
