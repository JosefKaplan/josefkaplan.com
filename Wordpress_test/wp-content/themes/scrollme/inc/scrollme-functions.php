<?php
    function scrollme_slide_page($page_id) {
        if($page_id){
            $pg_query = new WP_Query( array( 'page_id' => $page_id, 'posts_per_page' => 1 ) );
            if($pg_query->have_posts()) :
            while($pg_query->have_posts()) : $pg_query->the_post();
            ?>
            <div class="s-panel-inner">
                <div class="container">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->
                </div>
            </div>
            <?php
            endwhile;
            endif;
        }
    }
    
    function scrollme_slide_service() {
        ?>
        <div class="s-panel-inner">
            <div class="container">
            <header class="entry-header">
                <?php $service_title = scrollme_allow_span(get_theme_mod('scrollme_service_title', 'We Are Expert - <span>In Our Service</span>')); ?>
                <h1 class="entry-title"><?php echo wp_kses_post($service_title); ?></h1>
            </header><!-- .entry-header -->

            <div class="service-tab-wrap">
            <?php 
                for ($i = 1; $i <= 4; $i++) :
                    $service_page = absint(get_theme_mod( 'scrollme_service_block_'.$i.'_page'));
                    if($service_page):
                        $args = array( 'page_id'=>$service_page );
                        $query = new WP_Query($args);
                        if($query->have_posts()):
                            while($query->have_posts()): $query->the_post();
                            ?>
                            <a class="service-tab" href="#service<?php echo esc_attr($service_page) ?>">
                                <?php
                                if( has_post_thumbnail() ):
                                    $service_icon = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
                                ?>
                                <img src="<?php echo esc_url($service_icon[0]); ?>" alt="<?php the_title_attribute();?>" />
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <?php
                            endwhile;
                        endif;
                    endif;
                endfor;
            ?>
            </div>

            <div class="service-content-wrap">
            <?php 
                for ($i = 1; $i <= 4; $i++) :
                    $service_page = absint(get_theme_mod( 'scrollme_service_block_'.$i.'_page'));
                    if($service_page):
                        $args = array( 'page_id'=>$service_page );
                        $query = new WP_Query($args);
                        if($query->have_posts()):
                            while($query->have_posts()): $query->the_post();
                                ?>
                                <div class="service-content clearfix" id="service<?php echo esc_attr($service_page) ?>">
                                    <?php 
                                    the_content();
                                    ?>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    endif;
                endfor;
            ?>
            </div>
                
            </div>
        </div>
        
        <?php
    }
    
    function scrollme_slide_portfolio() {
        ?>
        <div class="s-panel-inner">
            <div class="container">
                <header class="entry-header">
                    <?php $section_title = scrollme_allow_span(get_theme_mod('scrollme_portfolio_title', 'What we have done - <span>Our Works</span>')); ?>
                    <h1 class="entry-title"><?php echo wp_kses_post($section_title); ?></h1>
                </header><!-- .entry-header -->
                
                                                
                <?php $scrollme_page = absint(get_theme_mod( 'scrollme_portfolio_page' )); ?>
                <?php if( isset( $scrollme_page ) && $scrollme_page != 0  ) : ?>
                <div id="portfolio-wrap">                
                    <?php
                        $cat_args = array(
                            'cat' => $scrollme_page,
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        );
                        
                        $cat_query = new WP_Query( $cat_args );
                    ?>
                    <?php if( $cat_query->have_posts() ) : ?>
                        <div id="sm-portfolio" data-col="4">
                        <?php $i = 1; ?>
                        <?php while( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
                            
                            <?php if( has_post_thumbnail() ) : ?>
                                <?php
                                    $mas_class = "";
                                    if( $i == 2 || $i == 5 || $i == 9 || $i == 13 ) {
                                        $mas_class = 'wide';
                                    }
                                    $img_crop = 'scrollme-grid-large';
                                    
                                    $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $img_crop );
                                    $img_src_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                ?>
                                
                                    <div class="port-block item <?php echo esc_attr($mas_class); ?>">
                                        
                                        <div class="portfolio-thumb" style="background-image: url(<?php echo esc_url($img_src[0]);?>);">
                                        
                                            <div class="port-title">
                                            <div class="port-text">
                                                <?php  echo get_the_title(); ?>
                                                
                                            
                                                <div class="port-link-wrap">
                                                    <a class="port-lbox-link" href="<?php echo esc_url($img_src_full[0]); ?>" data-lightbox-gallery="port">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                    <a class="port-pg-link" href="<?php the_permalink(); ?>">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                <?php if($i%16 == 0){ $i = 0; } ?>
                                <?php $i++; ?>
                            <?php endif; ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    <?php else : ?>            
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    <?php endif; ?>
                <?php else : ?> <!-- Scroll Page Isset --> 
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?> <!-- Scroll Page Isset endif -->
            </div>
        </div>
        <?php
    }
    
    function scrollme_slide_clients() {
        ?>
        <div class="s-panel-inner">
            <div class="container">
                <header class="entry-header">
                    <?php $section_title = scrollme_allow_span(get_theme_mod('scrollme_client_title', 'We Have Some - <span>Great Clients</span>')); ?>
                    <h1 class="entry-title"><?php echo wp_kses_post($section_title); ?></h1>
                </header><!-- .entry-header -->
                <?php
                $scrollme_page = absint(get_theme_mod('scrollme_clients_category'));
                if (isset($scrollme_page) && $scrollme_page != 0) {
                    $cat_args = array('cat' => $scrollme_page, 'posts_per_page' => -1);
                    $cat_query = new WP_Query($cat_args);
                    if ($cat_query->have_posts()) {
                        echo '<div class="client-slider clearfix">';
                        $count = 1;
                        while ($cat_query->have_posts()) {
                            $cat_query->the_post();
                            if (has_post_thumbnail()) {
        
                                $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                ?>
                                <div class="client-sub">
                                    <div class="client-sub-inner">
                                        <div class="client-table-outer">
                                            <?php $link_to_inpage = esc_attr(get_theme_mod('scrollme_linkto_inpage', 1)); ?>
                                                                                                                                                                                                        
                                            <?php if($link_to_inpage) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                            <?php endif; ?>                                                    
                                                <img src="<?php echo esc_url($post_thumb[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
                                            <?php if($link_to_inpage) : ?>
                                            </a>                                                    
                                            <?php endif; ?>                           
                                        </div>
                                    </div>
                                </div>
                                <?php if($count%5 == 0) : ?>
                                <div class="clearfix"></div>
                                <?php endif; ?>
                            <?php
                            }
                        }
                        echo '</div>';
                        wp_reset_postdata();
                    } else {
                        get_template_part('template-parts/content', 'none');
                    }
                } else {
                    get_template_part('template-parts/content', 'none');
                }
                ?>
            </div>
        </div>
        <?php 
    }
    
    function scrollme_slide_contact() {
        $con_page = absint(get_theme_mod('scrollme_contact_page', 0));
        
        $pg_query = new WP_Query( array( 'post_type' => 'page', 'post__in' => array( $con_page ), 'posts_per_page' => 1 ) );
        if($pg_query->have_posts()) :
        while($pg_query->have_posts()) : $pg_query->the_post();
        ?>
        <div class="s-panel-inner">
            
            <div class="container">
                <div class="clearfix">
                    <?php if(is_dynamic_sidebar('scrollme-gmap')) : ?>
                    <div id="scrollme-map-canvas">
                        <?php dynamic_sidebar('scrollme-gmap'); ?>
                    </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header><!-- .entry-header -->

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'scrollme'),
                                'after' => '</div>',
                            ));
                            ?>
                        </div><!-- .entry-content -->
        
                        <footer class="entry-footer">
                            <?php edit_post_link(esc_html__('Edit', 'scrollme'), '<span class="edit-link">', '</span>'); ?>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-## -->
                </div>
            </div>
        </div>
        <?php
        endwhile; // $pg_query while end
        endif; // $pg_query if end
    }
    
    function scrollme_slide_blog() {
        ?>
        <div class="s-panel-inner">
            <div class="container">
                <header class="entry-header">
                    <?php $section_title = scrollme_allow_span(get_theme_mod('scrollme_blog_title', 'Know What We Are - <span>Upto</span>')); ?>
                    <h1 class="entry-title"><?php echo wp_kses_post($section_title); ?></h1>
                </header><!-- .entry-header -->
                
                <?php
                    $blog_cat = absint(get_theme_mod('scrollme_blog_cat', 0));
                    $blog_readmore_txt = sanitize_text_field(get_theme_mod('scrollme_blog_readmore_txt', 'Read More'));
                ?>
                <?php if(isset($blog_cat) || $blog_cat != 0) : ?>
                    <?php
                        $blog_args = array(
                            'post_status' => 'publish',
                            'posts_per_page' => 10,
                            'cat' => $blog_cat
                        );
                        $blog_query = new WP_Query($blog_args);
                    ?>
                    <div class="sl-blog-mas-grid clearfix">
                        <?php while($blog_query->have_posts()) : $blog_query->the_post(); ?>
                            <div class="sl-blog-post-wrap">
                                <?php if(has_post_thumbnail()) : ?>
                                <?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'scrollme-bpost-image'); $img_src = $img[0]; ?>
                                <div class="sl-blog-post-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                    </a>
                                </div>
                                <?php endif; ?>
                                <div class="sl-blog-post-excerpt">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    
                                    <p>
                                    <?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_content()), 20)); ?>
                                    </p>

                                    <?php if($blog_readmore_txt != '') : ?>
                                    <a class="sl-blog-readmore" href="<?php the_permalink(); ?>">
                                        <?php echo esc_attr($blog_readmore_txt); ?>
                                    </a>

                                    <?php endif; ?>
                                </div>

                                <div class="sl-blog-post-footer clearfix">
                                    <span class="post-date"><i class="fa fa-calendar-o"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
                                    
                                    <span class="post-comment"><i class="fa fa-comment-o"></i><?php echo comments_number( 0 ); ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?> <!-- Blog Category Selected -->
            </div>
        </div>
        <?php
    }

// Modify main menu attribute
class Scrollme_Menu_Attibute_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        if ( ( $hash_pos = strpos( $item->url, '#' ) ) !== false ) {
            $data_anchor = substr( $item->url, $hash_pos+6  );

            $data_anchor = " data-menuanchor='$data_anchor'";
        }else {
            $data_anchor = '';
        }
        $output .= $indent . '<li' . $data_anchor . $id . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

function scrollme_is_realy_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}