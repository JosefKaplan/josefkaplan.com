<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) { ?>
        <div class="post-image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <figure><?php the_post_thumbnail('mantranews-single-large'); ?></figure>
            </a>
        </div>
    <?php } ?>

    <div class="archive-desc-wrapper clearfix">
        <header class="entry-header">
            <?php
            do_action('mantranews_post_categories');
            if (is_single()) {
                the_title('<h1 class="entry-title">', '</h1>');
            } else {
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            }
            ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php the_excerpt(); ?>
            <?php $mantranews_readmore_design_style = get_theme_mod('mantranews_readmore_design_option', 'default');
            if ($mantranews_readmore_design_style == 'always-show') { ?>
                <a class="read-more-link" title="<?php the_title(); ?>"
                   href="<?php the_permalink(); ?>"><span><?php _e('Read more', 'mantranews'); ?></span></a>
            <?php } ?>

        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <div class="entry-meta">
                <?php mantranews_posted_on(); ?>
                <?php mantranews_post_comment(); ?>
            </div><!-- .entry-meta -->
            <?php mantranews_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div><!-- .archive-desc-wrapper -->
</article><!-- #post-## -->
