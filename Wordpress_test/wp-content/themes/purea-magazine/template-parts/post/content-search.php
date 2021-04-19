<?php
/**
 * Template part for displaying posts results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purea-magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="meta">
	            <span class="meta-item"><i class="fas fa-clock"></i><?php esc_html_e('Posted on','purea-magazine'); ?>: <?php the_time(get_option('date_format')) ?></span>
	            <span class="meta-item"><i class="fas fa-user"></i><?php esc_html_e('Posted by','purea-magazine'); ?>: <a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span>
	            <span class="meta-item"><i class="fas fa-comments"></i><?php esc_html_e('Comments','purea-magazine'); ?>: <a class="post-comments-url" href="<?php the_permalink() ?>#comments"><?php comments_number('0','1','%'); ?></a></span>
	        </div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php purea_magazine_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
