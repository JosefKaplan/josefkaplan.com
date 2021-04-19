<?php
/**
 * @package purea-magazine
 */


/**
 * Header
 */

if ( ! function_exists( 'purea_magazine_header_menu_styles' ) ) :
function purea_magazine_header_menu_styles() {
    get_template_part( 'inc/header-menu/content',esc_html(get_theme_mod('purea_magazine_header_menu_style','style1')));
}
endif;
add_action( 'purea_magazine_action_header', 'purea_magazine_header_menu_styles' );   


/**
 * Footer
 */

if ( ! function_exists( 'purea_magazine_footer_copyrights' ) ) :
function purea_magazine_footer_copyrights() {
	?>
		<div class="row">
            <div class="copyrights">
                <p>
                    <?php

                        if("" != esc_html(get_theme_mod( 'purea_magazine_footer_copyright_text'))) {
                            echo esc_html(get_theme_mod( 'purea_magazine_footer_copyright_text')); 
                            if(get_theme_mod('purea_magazine_en_footer_credits',true)) {
                                ?><span><?php esc_html_e(' | Theme by ','purea-magazine') ?><a href="<?php echo esc_url(PUREA_MAGAZINE_THEME_AUTH); ?>" target="_blank"><?php esc_html_e('Spiracle Themes','purea-magazine') ?></a></span>
                                <?php   
                            }
                        }
                        else{
                            echo date_i18n(
                                /* translators: Copyright date format, see https://secure.php.net/date */
                                _x( 'Y', 'copyright date format', 'purea-magazine' )
                            );
                            ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                <span><?php esc_html_e(' | Theme by ','purea-magazine') ?><a href="<?php echo esc_url(PUREA_MAGAZINE_THEME_AUTH); ?>" target="_blank"><?php esc_html_e('Spiracle Themes','purea-magazine') ?></a></span>
                            <?php
                        }
                    ?>
                </p>
            </div>
        </div>
	<?php
}
endif;
add_action( 'purea_magazine_action_footer', 'purea_magazine_footer_copyrights' );	


/**
* Custom excerpt length.
*/
if ( ! function_exists( 'purea_magazine_my_excerpt_length' ) ) :
function purea_magazine_my_excerpt_length($length) {
	if ( is_admin() ) {
		return $length;
	}
  	return absint(get_theme_mod( 'purea_magazine_posts_excerpt_length',70));
}
endif;
add_filter('excerpt_length', 'purea_magazine_my_excerpt_length');



/**
 * Category list
 */

if( !function_exists( 'purea_magazine_category_list' ) ):
    function purea_magazine_category_list() {
        $pm_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $pm_cat_lists = get_categories( $pm_args );
        $pm_cat_list = array('' => esc_html__('--Select--','purea-magazine'));
        foreach( $pm_cat_lists as $category ) {
            $pm_cat_list[esc_html( $category->slug )] = esc_html( $category->name );
        }
        return $pm_cat_list;
    }
endif;


/**
 * Get Page Title
 */

if( !function_exists( 'purea_magazine_get_title' ) ):
    function purea_magazine_get_title() {
        ?>
            <div class="page-title">
                <h1 class="main-title"><?php the_title(); ?></h1>
            </div>
        <?php
    }
endif;



/**
 * Trending News
 */
if ( ! function_exists( 'purea_magazine_trending_news' ) ) :
function purea_magazine_trending_news() {

    $title = esc_html(get_theme_mod( 'purea_magazine_trending_news_title', esc_html__('TRENDING NOW','purea-magazine')));
    $cat = esc_html(get_theme_mod( 'purea_magazine_trending_news_category' ));
    if('' != $cat){
        $query = new WP_Query(array(
            'post_type' => array( 'post' ),
            'category_name' => $cat,
        ));
    }
    else{
        $query = new WP_Query(array(
            'post_type' => array( 'post' ),
        ));
    }
    ?>  
        <div class="trending-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="trending-news-content">
                            <?php
                                if(true===get_theme_mod('purea_magazine_enable_trending_news_display_slide',false)) {
                                    ?>
                                        <div class="breaking-news-title"><?php echo esc_html($title) ?></div>
                                        <div class="trending-content owl-carousel owl-theme">
                                            <?php
                                                while($query->have_posts()):$query->the_post(); ?>
                                               <div class="item">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </div>
                                            <?php endwhile;  wp_reset_postdata(); ?>
                                        </div>
                                    <?php
                                }
                                else{
                                    ?>
                                        <span class="breaking-news-title"><?php echo esc_html($title) ?></span>
                                        <div class="trending-content-marq">
                                            <marquee onmouseover="this.stop();" onmouseout="this.start();">
                                            <?php
                                                while($query->have_posts()):$query->the_post(); 
                                                    ?>
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> <span class="post-break">|<span></a>
                                                    <?php 
                                                endwhile;  
                                                wp_reset_postdata(); 
                                            ?>
                                            </marquee>
                                        </div>
                                    <?php   
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
endif;
add_action('purea_magazine_action_trending_news', 'purea_magazine_trending_news');


/**
 * Top Bar
 */
if ( ! function_exists( 'purea_magazine_top_bar' ) ) :
function purea_magazine_top_bar() {
    $title = esc_html(get_theme_mod( 'purea_magazine_top_bar_social_text', esc_html__('FOLLOW US','purea-magazine')));
    ?>  
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <?php
                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_social_icons',false)){
                                ?>
                                    <span class="top-social-label"><?php echo esc_html($title) ?></span>
                                    <ul class="top-social">
                                        <?php
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_facebook_icon',false)){
                                                ?>
                                                    <li class="facebook-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_facebook_icon_url', '#' ) ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                                <?php
                                            }
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_twitter_icon',false)){
                                                ?>
                                                    <li class="twitter-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_twitter_icon_url', '#' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
                                                <?php
                                            }
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_instagram_icon',false)){
                                                ?>
                                                    <li class="instagram-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_instagram_icon_url', '#' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
                                                <?php
                                            }
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_linkedin_icon',false)){
                                                ?>
                                                    <li class="linkedin-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_linkedin_icon_url', '#' ) ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                                <?php
                                            }
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_pinterest_icon',false)){
                                                ?>
                                                    <li class="pinterest-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_pinterest_icon_url', '#' ) ); ?>"><i class="fab fa-pinterest"></i></a></li>
                                                <?php
                                            }
                                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_youtube_icon',false)){
                                                ?>
                                                    <li class="youtube-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_youtube_icon_url', '#' ) ); ?>"><i class="fab fa-youtube"></i></a></li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                <?php
                            }
                        ?>
                        
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                            if(true===get_theme_mod( 'purea_magazine_enable_top_bar_date',true)){
                                ?>
                                    <div class="date-time">
                                        <div id="date">
                                            <?php echo date_i18n(esc_html__('l, F d, Y','purea-magazine')); ?>
                                        </div>
                                    </div>  
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
endif;
add_action('purea_magazine_action_top_bar', 'purea_magazine_top_bar');


/**
 * Top Bar Style 2
 */
if ( ! function_exists( 'purea_magazine_top_bar_style2' ) ) :
function purea_magazine_top_bar_style2() {
    $title = get_theme_mod( 'purea_magazine_top_bar_social_text', esc_html__('FOLLOW US','purea-magazine'));
    ?>  
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <?php
                            if ( has_nav_menu( 'topbar' ) ) {
                                ?>
                                    <div class="topbar-menu">
                                        <div class="topbar-menu-wrapper">
                                            <?php
                                                wp_nav_menu( array(                         
                                                'theme_location'    => 'topbar',
                                                'depth'             => 1,
                                                'container'         => 'ul',
                                                'container_class'   => 'navigation',
                                                'container_id'      => 'menu-topbar',
                                                'menu_class'        => 'navigation',
                                                ));
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="top-social-wrap">
                            <span class="top-social-label"><?php echo esc_html($title) ?></span>
                            <ul class="top-social">
                                <?php
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_facebook_icon',true)){
                                        ?>
                                            <li class="facebook-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_facebook_icon_url', '#' ) ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php
                                    }
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_twitter_icon',true)){
                                        ?>
                                            <li class="twitter-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_twitter_icon_url', '#' ) ); ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php
                                    }
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_instagram_icon',true)){
                                        ?>
                                            <li class="instagram-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_instagram_icon_url', '#' ) ); ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php
                                    }
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_linkedin_icon',true)){
                                        ?>
                                            <li class="linkedin-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_linkedin_icon_url', '#' ) ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                        <?php
                                    }
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_pinterest_icon',true)){
                                        ?>
                                            <li class="pinterest-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_pinterest_icon_url', '#' ) ); ?>"><i class="fab fa-pinterest"></i></a></li>
                                        <?php
                                    }
                                    if(true===get_theme_mod( 'purea_magazine_enable_top_bar_youtube_icon',true)){
                                        ?>
                                            <li class="youtube-icon"><a target="_blank" href="<?php echo esc_url(get_theme_mod( 'purea_magazine_top_bar_youtube_icon_url', '#' ) ); ?>"><i class="fab fa-youtube"></i></a></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
endif;
add_action('purea_magazine_action_top_bar_style2', 'purea_magazine_top_bar_style2');


/**
 * Highlight Area
 */
if ( ! function_exists( 'purea_magazine_highlight_area' ) ) :
function purea_magazine_highlight_area() {
    if(is_front_page()){
        if(true===get_theme_mod( 'purea_magazine_is_show_same_cat_highlight_area',true)) {
            $cat = esc_html(get_theme_mod( 'purea_magazine_highlight_area_category_all' ));
            if('' != $cat){
                $query = new WP_Query(array(
                    'post_type' => array( 'post' ),
                    'category_name' => $cat,
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1,
                ));
            }
            else{
                $query = new WP_Query(array(
                    'post_type' => array( 'post' ),
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1,
                ));
            }
            ?>
                <div class="highlight-area-wrapper">
                    <div class="row">
                        <?php
                            while($query->have_posts()):$query->the_post();
                                if (has_post_thumbnail()) {
                                    $post_img_url = wp_get_attachment_url(get_post_thumbnail_id(),'purea-magazine-posts');
                                }
                                else{
                                    $post_img_url = get_template_directory_uri().'/img/ha-image.jpg';
                                }
                                
                                ?>
                                <div class="col-md-4">
                                    <div id="post-<?php the_ID(); ?>" class="section-hightlight-area-box">
                                        <div class="highlight-area-content" style="background:url(' <?php echo esc_url($post_img_url); ?>') no-repeat;">
                                            <div class="content-wrapper">
                                                <div class="content">
                                                    <div class="category">
                                                        <span><?php the_category(); ?></span>
                                                    </div>
                                                    <div class="title">
                                                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a></h2>
                                                    </div>
                                                    <div class="meta">
                                                        <span class="by"><?php esc_html_e('By: ','purea-magazine') ?></span><span class="author"><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span><span class="separator"> | </span>
                                                        <span class="date"><?php the_time(get_option('date_format')) ?></span>
                                                    </div>
                                                    <div>
                                                        <?php esc_html(purea_magazine_highlight_area_after_content()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;  
                            wp_reset_postdata(); 
                        ?>
                    </div>
                </div>
            <?php
        }
        else{
            ?>
                <div class="highlight-area-wrapper">
                    <div class="row">
                        <?php
                            $cat1 = esc_html(get_theme_mod( 'purea_magazine_highlight_area_category_column1' ));
                            $cat2 = esc_html(get_theme_mod( 'purea_magazine_highlight_area_category_column2' ));
                            $cat3 = esc_html(get_theme_mod( 'purea_magazine_highlight_area_category_column3' ));

                            if('' != $cat1){
                                $query1 = new WP_Query(array(
                                    'post_type' => array( 'post' ),
                                    'category_name' => $cat1,
                                    'posts_per_page' => 1,
                                    'ignore_sticky_posts' => 1,
                                ));
                                while($query1->have_posts()):$query1->the_post();
                                    if (has_post_thumbnail()) {
                                        $post_img_url = wp_get_attachment_url(get_post_thumbnail_id());
                                    }
                                    else{
                                        $post_img_url = get_template_directory_uri().'/img/ha-image.jpg';
                                    }
                                    
                                    ?>
                                    <div class="col-md-4">
                                        <div id="post-<?php the_ID(); ?>" class="section-hightlight-area-box">
                                            <div class="highlight-area-content" style="background:url(' <?php echo esc_url($post_img_url); ?>') no-repeat;">
                                                <div class="content-wrapper">
                                                    <div class="content">
                                                        <div class="category">
                                                            <span><?php the_category(); ?></span>
                                                        </div>
                                                        <div class="title">
                                                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a></h2>
                                                        </div>
                                                        <div class="meta">
                                                            <span class="by"><?php esc_html_e('By: ','purea-magazine') ?></span><span class="author"><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span><span class="separator"> | </span>
                                                            <span class="date"><?php the_time(get_option('date_format')) ?></span>
                                                        </div>
                                                        <div>
                                                            <?php esc_html(purea_magazine_highlight_area_after_content()); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;  
                                wp_reset_postdata();
                            }

                            if('' != $cat2){
                                $query2 = new WP_Query(array(
                                    'post_type' => array( 'post' ),
                                    'category_name' => $cat2,
                                    'posts_per_page' => 1,
                                    'ignore_sticky_posts' => 1,
                                ));
                                while($query2->have_posts()):$query2->the_post();
                                    if (has_post_thumbnail()) {
                                        $post_img_url = wp_get_attachment_url(get_post_thumbnail_id());
                                    }
                                    else{
                                        $post_img_url = get_template_directory_uri().'/img/ha-image.jpg';
                                    }
                                    
                                    ?>
                                    <div class="col-md-4">
                                        <div id="post-<?php the_ID(); ?>" class="section-hightlight-area-box">
                                            <div class="highlight-area-content" style="background:url(' <?php echo esc_url($post_img_url); ?>') no-repeat;">
                                                <div class="content-wrapper">
                                                    <div class="content">
                                                        <div class="category">
                                                            <span><?php the_category(); ?></span>
                                                        </div>
                                                        <div class="title">
                                                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a></h2>
                                                        </div>
                                                        <div class="meta">
                                                            <span class="by"><?php esc_html_e('By: ','purea-magazine') ?></span><span class="author"><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span><span class="separator"></span> |
                                                            <span class="date"><?php the_time(get_option('date_format')) ?></span>
                                                        </div>
                                                        <div>
                                                            <?php esc_html(purea_magazine_highlight_area_after_content()); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;  
                                wp_reset_postdata();
                            }

                            if('' != $cat3){
                                $query3 = new WP_Query(array(
                                    'post_type' => array( 'post' ),
                                    'category_name' => $cat3,
                                    'posts_per_page' => 1,
                                    'ignore_sticky_posts' => 1,
                                ));
                                while($query3->have_posts()):$query3->the_post();
                                    if (has_post_thumbnail()) {
                                        $post_img_url = wp_get_attachment_url(get_post_thumbnail_id());
                                    }
                                    else{
                                        $post_img_url = get_template_directory_uri().'/img/ha-image.jpg';
                                    }
                                    
                                    ?>
                                    <div class="col-md-4">
                                        <div id="post-<?php the_ID(); ?>" class="section-hightlight-area-box">
                                            <div class="highlight-area-content" style="background:url(' <?php echo esc_url($post_img_url); ?>') no-repeat;">
                                                <div class="content-wrapper">
                                                    <div class="content">
                                                        <div class="category">
                                                            <span><?php the_category(); ?></span>
                                                        </div>
                                                        <div class="title">
                                                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a></h2>
                                                        </div>
                                                        <div class="meta">
                                                            <span class="by"><?php esc_html_e('By: ','purea-magazine') ?></span><span class="author"><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span><span class="separator"> | </span>
                                                            <span class="date"><?php the_time(get_option('date_format')) ?></span>
                                                        </div>
                                                        <div>
                                                            <?php esc_html(purea_magazine_highlight_area_after_content()); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;  
                                wp_reset_postdata();
                            }
                        ?>
                    </div>
                </div>
            <?php
        }
    }
}
endif;
add_action('purea_magazine_action_highlight_area', 'purea_magazine_highlight_area');


/**
 * Adding home sidebar classes to body
 */
if ( ! function_exists( 'purea_magazine_add_sidebar_classes_to_body' ) ) :
function purea_magazine_add_sidebar_classes_to_body($classes = '') {
    if('right-sidebar'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))) {
        $classes[] = 'right-sidebar';
    }
    else if('left-sidebar'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))){
        $classes[] = 'left-sidebar';   
    }
    else if('both-sidebars'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))){
        $classes[] = 'both-sidebars';
    }
    else{
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
endif;
add_filter('body_class', 'purea_magazine_add_sidebar_classes_to_body');


/**
 * Adding blog sidebar classes to body
 */
if ( ! function_exists( 'purea_magazine_add_blog_sidebar_classes_to_body' ) ) :
function purea_magazine_add_blog_sidebar_classes_to_body($classes = '') {
    if('right'===esc_html(get_theme_mod('purea_magazine_blog_single_sidebar_layout','no'))) {
        $classes[] = 'single-right-sidebar';
    }
    else if('left'===esc_html(get_theme_mod('purea_magazine_blog_single_sidebar_layout','no'))){
        $classes[] = 'single-left-sidebar';   
    }
    else{
        $classes[] = 'single-no-sidebar';
    }
    return $classes;
}
endif;
add_filter('body_class', 'purea_magazine_add_blog_sidebar_classes_to_body');


/**
 * Menu Search
 */
if ( ! function_exists( 'purea_magazine_menu_search' ) ) :
function purea_magazine_menu_search($items, $args) {
    if( $args->theme_location == 'primary' )
        return $items.'<li class="menu-header-search">
                            <button class="search-btn"><i class="fas fa-search"></i></button>
                    </li>
                    <!-- Popup Search -->
                    <div id="searchOverlay" class="overlay">
                        <div class="overlay-content">
                            <label>'. esc_html__('Hit Enter after your search text.','purea-magazine') .' </label>
                            <form role="search" method="get" class="searchformmenu" action="'. esc_url(home_url( '/' )) . '">
                                <div class="search">
                                    <input type="text" value="" class="blog-search" name="s" placeholder="'. esc_attr__( 'Search here','purea-magazine' ) .'">
                                    <label for="searchsubmit" class="search-icon"><i class="fas fa-search"></i></label>
                                    <input type="submit" class="searchsubmitmenu" value="'. esc_attr__( 'Search','purea-magazine' ) .'">
                                </div>
                            </form>
                        </div>
                        <button class="search-closebtn" title="'. esc_attr__('Close','purea-magazine') .'" > <i class="fas fa-times"></i></button>
                    </div>
                    ';
    return $items;
}
endif;

if ( ! function_exists( 'purea_magazine_filter_menu_search_hook' ) ) :
function purea_magazine_filter_menu_search_hook() {
    add_filter('wp_nav_menu_items','purea_magazine_menu_search', 10, 2);
}
endif;
add_action( 'wp', 'purea_magazine_filter_menu_search_hook' );


/**
 * Preconnect Fonts
 */
function purea_magazine_preconnect_fonts() {
    ?> 
        <link rel="dns-prefetch" href="https://fonts.gstatic.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <?php
}
add_action( 'wp_head', 'purea_magazine_preconnect_fonts' ); 


/**
 * Top Menu Advt
 */
if( 'style2' == esc_html(get_theme_mod('purea_magazine_header_style_layout','style1'))) {
    register_nav_menus( array(
        'topbar' => __( 'Top Bar', 'purea-magazine' ),
    ) );
}


/**
 * Search Form
 */
if ( ! function_exists( 'purea_magazine_search_content' ) ) :
function purea_magazine_search_content() {
    ?>  
        <div class="search-form-wrapper">
            <form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="form-group search">
                    <label class="screen-reader-text" for="searchsubmit"><?php esc_html_e('Search for:', 'purea-magazine'); ?></label>
                    <input type="search" id="pm-search-field" class="search-field"   placeholder="<?php esc_attr_e('Search here','purea-magazine') ?>" value="<?php echo get_search_query(); ?>" name="s"/>
                    <button type="submit" value=""><?php esc_html_e('Search','purea-magazine') ?></button>
                </div>
            </form>
        </div>
    <?php
}
endif;
add_action('purea_magazine_action_search_content', 'purea_magazine_search_content');