<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
$quality_construction_designlayout = quality_construction_get_option('quality_construction_sidebar_layout_option');
get_header(); ?>

    <section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2> <?php the_archive_title('<h2 class="page-title">', '</h2>') ?></h2>
                </div>
                <?php
                if ($quality_construction_breadcrump_option == "enable") {
                    ?>
                    <div class="col-md-5">
                        <div class="breadcrumbs">
                            <?php breadcrumb_trail(); ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <section id="section14" class="section-margine">
        <div class="container">
            <div class="row">
                <div class="col-sm-<?php if ($quality_construction_designlayout == 'no-sidebar') {
                    echo "12";
                } else {
                    echo "9";
                } ?> col-md-<?php if ($quality_construction_designlayout == 'no-sidebar') {
                    echo "12";
                } else {
                    echo "9";
                } ?> left-block">
                    <?php
                    if (have_posts()) :
                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', get_post_format());

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif; ?>

                </div><!--div -->
                <?php if ($quality_construction_designlayout != 'no-sidebar') { ?>
                    <div class="col-sm-3 col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        </div><!-- div -->
    </section>
<?php get_footer();
