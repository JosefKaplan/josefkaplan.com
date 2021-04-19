<?php
/**
 * The template for displaying all pages
 * Template Name: Our Work
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
get_header();
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option')?>
<section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-8"><h2><?php the_title(); ?></h2>
            </div>
            <?php
            if ($quality_construction_breadcrump_option == "enable") {
                ?>
                <div class="col-md-4">
                    <div class="breadcrumbs">
                        <?php breadcrumb_trail(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php

if (is_active_sidebar('quality-construction-our-work-page')) {
    dynamic_sidebar('quality-construction-our-work-page');
}

get_footer();
