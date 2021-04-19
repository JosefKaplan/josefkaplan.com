<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$quality_construction_slider_section_option = quality_construction_get_option('quality_construction_homepage_slider_option');
if ($quality_construction_slider_section_option != 'hide') {

    $quality_construction_slider_section_cat_id = quality_construction_get_option('quality_construction_slider_cat_id');

    $quality_construction_get_started_text = quality_construction_get_option('quality_construction_slider_get_started_txt');

    $quality_construction_get_started_text_link = quality_construction_get_option('quality_construction_slider_get_started_link');

    $quality_construction_slider_view_more_txt = quality_construction_get_option('quality_construction_slider_view_more_txt');

    $quality_construction_slider_category = get_category($quality_construction_slider_section_cat_id);
    if(!empty($quality_construction_slider_section_cat_id))
    {
        $count = $quality_construction_slider_category->category_count;
    $no_of_slider = quality_construction_get_option('quality_construction_no_of_slider');
    if ($count > 0 && $no_of_slider > 0) {
        ?>
        <section id="slider" class="slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <?php
                    if ($no_of_slider > 1) {

                        for ($i = 0; $i < $no_of_slider; $i++) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo esc_attr($i); ?>"
                                class=" <?php if ($i == 0) {
                                    echo 'active';
                                } ?>">
                            </li>

                        <?php }
                    } ?>
                </ol>
                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    <!--1st item start-->
                    <?php
                    $i = 0;
                    if (!empty($quality_construction_slider_section_cat_id)) {
                        $quality_construction_home_slider_section = array('cat' => $quality_construction_slider_section_cat_id, 'posts_per_page' => $no_of_slider);
                        $quality_construction_home_slider_section_query = new WP_Query($quality_construction_home_slider_section);
                        if ($quality_construction_home_slider_section_query->have_posts()) {

                            while ($quality_construction_home_slider_section_query->have_posts()) {
                                $quality_construction_home_slider_section_query->the_post();
                                ?>
                                <div class="item <?php if ($i == 0) {
                                    echo "active";
                                } ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $image_id = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id, 'full', true); ?>
                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive" alt="<?php the_title_attribute(); ?>">
                                    <?php } ?>
                                    <div class="carousel-caption">
                                        <h1 class="wow slideInLeft color-white"><?php the_title() ?></h1>
                                        <h3 class="wow slideInRight color-white"><?php echo esc_html( wp_trim_words(get_the_content(), 10) ); ?> </h3>
                                        <?php if (!empty($quality_construction_get_started_text)) { ?>
                                            <a href="<?php echo esc_url($quality_construction_get_started_text_link); ?>" class="btn btn-primary wow bounceInUp">
                                                <?php echo esc_html($quality_construction_get_started_text) ?>
                                            </a>
                                        <?php } ?>
                                        <?php if (!empty($quality_construction_slider_view_more_txt)) { ?>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-seconday wow bounceInUp">
                                                <?php echo esc_html($quality_construction_slider_view_more_txt); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="over-bg"></div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                        wp_reset_postdata();
                    }
                    ?>

                    <!--1st item end-->
                </div>
                <!-- Carousel controls -->

                <?php
                if ($count > 1 && $no_of_slider > 1) {
                    ?>
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-left fa-2x"></i>
                        </span>
                    </a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-right fa-2x"></i>
                        </span>
                    </a>

                <?php } ?>
            </div>
        </section>
    <?php } }
} ?>