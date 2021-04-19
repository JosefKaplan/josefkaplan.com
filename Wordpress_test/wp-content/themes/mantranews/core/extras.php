<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

/**
 * Adds custom contain in head sections
 */
if (!function_exists('mantranews_categories_color')):
    function mantranews_categories_color()
    {

        $mb_theme_color = esc_attr(get_theme_mod('mantranews_theme_color', ''));

        $get_categories = get_terms('category', array('hide_empty' => false));

        $cat_color_css = '';
        foreach ($get_categories as $category) {

            $cat_color = esc_attr(get_theme_mod('mantranews_category_color_' . strtolower($category->name), $mb_theme_color));
            $cat_hover_color = esc_attr(mantranews_hover_color($cat_color, '-50'));
            $cat_id = esc_attr($category->term_id);

            if (!empty($cat_color)) {

                $cat_color_css .= ".category-button.mb-cat-" . $cat_id . " a { background: " . $cat_color . "}\n";

                $cat_color_css .= ".category-button.mb-cat-" . $cat_id . " a:hover { background: " . $cat_hover_color . "}\n";

                $cat_color_css .= ".block-header.mb-cat-" . $cat_id . " { border-left: 2px solid " . $cat_color . " }\n";

                $cat_color_css .= ".block-header.mb-cat-" . $cat_id . " .block-title { background:" . $cat_color . " }\n";

                $cat_color_css .= ".block-header.mb-cat-" . $cat_id . ", #content .block-header.mb-cat-" . $cat_id . " .block-title:after { border-bottom-color:" . $cat_color . " }\n";

                $cat_color_css .= "#content .block-header.mb-cat-" . $cat_id . "{ background-color:" . $cat_hover_color . " }\n";

                $cat_color_css .= ".rtl .block-header.mb-cat-" . $cat_id . " { border-left: none; border-right: 2px solid " . $cat_color . " }\n";

                $cat_color_css .= ".archive .page-header.mb-cat-" . $cat_id . " { background-color:" . $cat_color . "; border-left: 4px solid " . $cat_color . " }\n";

                $cat_color_css .= ".rtl.archive .page-header.mb-cat-" . $cat_id . " { border-left: none; border-right: 4px solid " . $cat_color . " }\n";

                $cat_color_css .= "#site-navigation ul li.mb-cat-" . $cat_id . " { border-bottom-color: " . $cat_color . " }\n";
            }
        }

        $mb_dynamic_css = '';

        if (!empty($mb_theme_color)) {

            $mb_dynamic_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.edit-link .post-edit-link, .reply .comment-reply-link,.home-icon,.search-main,.header-search-wrapper .search-form-main .search-submit,.mb-slider-section .bx-controls a:hover,.widget_search .search-submit,.error404 .page-title,.archive.archive-classic .entry-title a:after,#mb-scrollup,.widget_tag_cloud .tagcloud a:hover,.sub-toggle,#site-navigation ul > li:hover > .sub-toggle, #site-navigation ul > li.current-menu-item .sub-toggle, #site-navigation ul > li.current-menu-ancestor .sub-toggle{ background:" . $mb_theme_color . "} .breaking_news_wrap .bx-controls-direction a, .breaking_news_wrap .bx-controls-direction a:hover:before{color:#fff;}\n";

            $mb_dynamic_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.widget_tag_cloud .tagcloud a:hover{ border-color:" . $mb_theme_color . "}\n";

            // Hero Button

            $mb_dynamic_css .= ".mb-parallax .mb-parallax-content .mb-parallax-hero-content .mb-parallax-hero-button{ background-color:" . $mb_theme_color . "}\n";


            $mb_dynamic_css .= ".comment-list .comment-body ,.header-search-wrapper .search-form-main{ border-top-color:" . $mb_theme_color . "}\n";

            $mb_dynamic_css .= "#site-navigation ul li,.header-search-wrapper .search-form-main:before{ border-bottom-color:" . $mb_theme_color . "}\n";

            $mb_dynamic_css .= ".archive .page-header,.block-header, .widget .widget-title-wrapper, .related-articles-wrapper .widget-title-wrapper{ border-left-color:" . $mb_theme_color . "}\n";

            $mb_dynamic_css .= "a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before, .logged-in-as a,.top-menu ul li a:hover,#footer-navigation ul li a:hover,#site-navigation ul li a:hover,#site-navigation ul li.current-menu-item a,.mb-slider-section .slide-title a:hover,.featured-post-wrapper .featured-title a:hover,.mantranews_block_grid .post-title a:hover,.slider-meta-wrapper span:hover,.slider-meta-wrapper a:hover,.featured-meta-wrapper span:hover,.featured-meta-wrapper a:hover,.post-meta-wrapper > span:hover,.post-meta-wrapper span > a:hover ,.grid-posts-block .post-title a:hover,.list-posts-block .single-post-wrapper .post-content-wrapper .post-title a:hover,.column-posts-block .single-post-wrapper.secondary-post .post-content-wrapper .post-title a:hover,.widget a:hover::before,.widget li:hover::before,.entry-title a:hover,.entry-meta span a:hover,.post-readmore a:hover,.archive-classic .entry-title a:hover,
            .archive-columns .entry-title a:hover,.related-posts-wrapper .post-title a:hover, .widget .widget-title a:hover,.related-articles-wrapper .related-title a:hover { color:" . $mb_theme_color . "}\n";
            $mb_dynamic_css .= "#content .block-header,#content .widget .widget-title-wrapper,#content .related-articles-wrapper .widget-title-wrapper {background-color: " . mantranews_sass_lighten($mb_theme_color, '20%') . ";}\n";
            $mb_dynamic_css .= ".block-header .block-title, .widget .widget-title, .related-articles-wrapper .related-title {background-color: " . $mb_theme_color . ";}\n";
            $mb_dynamic_css .= ".block-header, .widget .widget-title-wrapper, .related-articles-wrapper .widget-title-wrapper {border-left-color: " . $mb_theme_color . ";border-bottom-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= "#content .block-header .block-title:after, #content .widget .widget-title:after, #content .related-articles-wrapper .related-title:after {border-bottom-color: " . $mb_theme_color . ";border-bottom-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".archive .page-header {background-color: " . mantranews_sass_lighten($mb_theme_color, '20%') . "}\n";
            $mb_dynamic_css .= "#site-navigation ul li.current-menu-item a,.bx-default-pager .bx-pager-item a.active {border-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".bottom-header-wrapper {border-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".top-menu ul li, .mantranews-ticker-wrapper ~ .top-header-section {border-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".ticker-caption, .breaking_news_wrap.fade .bx-controls-direction a.bx-next:hover, .breaking_news_wrap.fade .bx-controls-direction a.bx-prev:hover {background-color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".ticker-content-wrapper .news-post a:hover, .mantranews-carousel .item .carousel-content-wrapper a:hover{color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".mantranews-carousel .item .carousel-content-wrapper h3 a:hover, body .mantranews-carousel h3 a:hover, footer#colophon .mantranews-carousel h3 a:hover, footer#colophon a:hover, .widget a:hover, .breaking_news_wrap .article-content.feature_image .post-title a:hover{color: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".widget .owl-theme .owl-dots .owl-dot.active span{background: " . $mb_theme_color . "}\n";
            $mb_dynamic_css .= ".rtl #content .block-header .block-title::after, .rtl #content .related-articles-wrapper .related-title::after, .rtl #content .widget .widget-title::after{border-right-color: " . $mb_theme_color . "}\n";
        }

        $site_title_design_options = get_theme_mod('site_title_design_options', 'plain');
        if ($site_title_design_options === 'line') {
            $mb_dynamic_css .= "#content .block-header, #content .related-articles-wrapper .widget-title-wrapper, #content .widget .widget-title-wrapper,
			 #secondary .block-header, #secondary .widget .widget-title-wrapper, #secondary .related-articles-wrapper .widget-title-wrapper{background:none; background-color:transparent!important}\n";
        } else if ($site_title_design_options === 'plain') {
            $mb_dynamic_css .= "#content .block-header, #content .related-articles-wrapper .widget-title-wrapper, #content .widget .widget-title-wrapper,
			 #secondary .block-header, #secondary .widget .widget-title-wrapper, #secondary .related-articles-wrapper .widget-title-wrapper{background:none; background-color:transparent!important}\n";

            $mb_dynamic_css .= "#content .block-header .block-title:after, #content .related-articles-wrapper .related-title:after, #content .widget .widget-title:after{border:none}\n";
        }

        $site_title_case_design_options = get_theme_mod('site_title_case_design_options', 'none');

        if ($site_title_case_design_options != 'none') {
            $mb_dynamic_css .= ".block-header .block-title, .widget .widget-title, .related-articles-wrapper .related-title{text-transform:" . $site_title_case_design_options . "}\n";

        }
        ?>
        <style type="text/css">
            <?php
                if( !empty( $cat_color_css ) ) {
                    echo $cat_color_css;
                }

                if( !empty( $mb_dynamic_css ) ) {
                    echo $mb_dynamic_css;
                }
            ?>
        </style>
        <?php
    }
endif;
add_action('wp_head', 'mantranews_categories_color');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function mantranews_body_classes($classes)
{

    global $post;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $classes[] = get_theme_mod('website_skin_option', 'default_skin');

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    /**
     * option for web site layout
     */
    $mantranews_website_layout = esc_attr(get_theme_mod('site_layout_option', 'fullwidth_layout'));

    if (!empty($mantranews_website_layout)) {
        $classes[] = $mantranews_website_layout;
    }

    /**
     * sidebar option for post/page/archive
     */
    if (is_single() || is_page()) {
        $sidebar_meta_option = esc_attr(get_post_meta($post->ID, 'mantranews_sidebar_location', true));
    }

    if (is_home()) {
        $set_id = esc_attr(get_option('page_for_posts'));
        $sidebar_meta_option = esc_attr(get_post_meta($set_id, 'mantranews_sidebar_location', true));
    }

    if (empty($sidebar_meta_option) || is_archive() || is_search()) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $mantranews_archive_sidebar = esc_attr(get_theme_mod('mantranews_archive_sidebar', 'right_sidebar'));
    $mantranews_post_default_sidebar = esc_attr(get_theme_mod('mantranews_default_post_sidebar', 'right_sidebar'));
    $mantranews_page_default_sidebar = esc_attr(get_theme_mod('mantranews_default_page_sidebar', 'right_sidebar'));

    if ($sidebar_meta_option == 'default_sidebar') {
        if (is_single()) {
            if ($mantranews_post_default_sidebar == 'right_sidebar') {
                $classes[] = 'right-sidebar';
            } elseif ($mantranews_post_default_sidebar == 'left_sidebar') {
                $classes[] = 'left-sidebar';
            } elseif ($mantranews_post_default_sidebar == 'no_sidebar') {
                $classes[] = 'no-sidebar';
            } elseif ($mantranews_post_default_sidebar == 'no_sidebar_center') {
                $classes[] = 'no-sidebar-center';
            }
        } elseif (is_page()) {
            if ($mantranews_page_default_sidebar == 'right_sidebar') {
                $classes[] = 'right-sidebar';
            } elseif ($mantranews_page_default_sidebar == 'left_sidebar') {
                $classes[] = 'left-sidebar';
            } elseif ($mantranews_page_default_sidebar == 'no_sidebar') {
                $classes[] = 'no-sidebar';
            } elseif ($mantranews_page_default_sidebar == 'no_sidebar_center') {
                $classes[] = 'no-sidebar-center';
            }
        } elseif ($mantranews_archive_sidebar == 'right_sidebar') {
            $classes[] = 'right-sidebar';
        } elseif ($mantranews_archive_sidebar == 'left_sidebar') {
            $classes[] = 'left-sidebar';
        } elseif ($mantranews_archive_sidebar == 'no_sidebar') {
            $classes[] = 'no-sidebar';
        } elseif ($mantranews_archive_sidebar == 'no_sidebar_center') {
            $classes[] = 'no-sidebar-center';
        }
    } elseif ($sidebar_meta_option == 'right_sidebar') {
        $classes[] = 'right-sidebar';
    } elseif ($sidebar_meta_option == 'left_sidebar') {
        $classes[] = 'left-sidebar';
    } elseif ($sidebar_meta_option == 'no_sidebar') {
        $classes[] = 'no-sidebar';
    } elseif ($sidebar_meta_option == 'no_sidebar_center') {
        $classes[] = 'no-sidebar-center';
    }

    if (is_archive()) {
        $mantranews_archive_layout = get_theme_mod('mantranews_archive_layout', 'classic');
        if (!empty($mantranews_archive_layout)) {
            $classes[] = 'archive-' . $mantranews_archive_layout;
        }
    }
    if (is_page_template('templates/news-template.php')) {
        $classes[] = 'mb-home-sidebar-' . get_theme_mod('mantranews_homepage_sidebar_alignment', 'right');
    }

    return $classes;
}

add_filter('body_class', 'mantranews_body_classes');
