<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$copyright = quality_construction_get_option('quality_construction_copyright');
if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) {

    ?>

    <section id="footer-top" class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-top-box wow fadeInUp">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section id="footer-bottom" class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright site-copyright"><?php echo wp_kses_post($copyright); ?></div>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>

</body>
</html>
