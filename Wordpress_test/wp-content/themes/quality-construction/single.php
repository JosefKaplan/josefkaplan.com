<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
$quality_construction_designlayout = get_post_meta(get_the_ID(), 'quality_construction_sidebar_layout', true  );
get_header();
?>
<section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2><?php the_title(); ?></h2>
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
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'single');
                    the_post_navigation(array(
                        'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'quality-construction') . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__('Next post:', 'quality-construction'),
                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'quality-construction') . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__('Previous post:', 'quality-construction'),
                    ));
                    echo '<div class="comment-form-container wow fadeInLeft">';
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                    echo '</div>';
                endwhile; // End of the loop.
                ?>
            </div>
            <?php if ( $quality_construction_designlayout != 'no-sidebar') { ?>
                <div class="col-sm-3 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php
get_footer(); ?>
