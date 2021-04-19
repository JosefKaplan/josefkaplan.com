<?php
/**
 * Template part for displaying single posts.
 *
 * @package scrollme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php $metadata = get_theme_mod('scrollme_metadata_disable',1);
		if($metadata){ ?>
		<div class="entry-meta">
			<?php scrollme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->
	<?php $featimage = get_theme_mod('scrollme_feat_img_disable',1);
		if($featimage){ ?>
	<?php if( has_post_thumbnail() ): ?>
		<div class="post-img-thumb">
			<?php the_post_thumbnail('scrollme-post-image'); ?>
		</div>
	<?php endif; ?>
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scrollme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

