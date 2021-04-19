<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$quality_construction_breadcrump_option = quality_construction_get_option('quality_construction_breadcrumb_setting_option');
get_header(); ?>
    <section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-8"><h2><?php esc_html_e('404 Not Found', 'quality-construction'); ?></h2></div>
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
    <section id="section19" class="section19">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <section class="error-404 not-found">
                            <header class="page-header">
                                <h1 class="page-title"><?php esc_html_e('404', 'quality-construction'); ?></h1>
                            </header><!-- .page-header -->

                            <div class="page-content text-center">
                                <p><?php esc_html_e('It looks like nothing was found at this location.', 'quality-construction'); ?></p>

                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div>
    </section>

<?php
get_footer();
