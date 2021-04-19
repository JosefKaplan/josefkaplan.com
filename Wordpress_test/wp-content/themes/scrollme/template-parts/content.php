<?php
/**
 * Template part for displaying posts.
 *
 * @package scrollme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php scrollme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if( has_post_thumbnail() ): ?>
		<div class="post-img-thumb">
			<?php the_post_thumbnail('scrollme-post-image'); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scrollme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <div class="entry-link">
        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'scrollme'); ?></a>
    </div>
</article><!-- #post-## -->
