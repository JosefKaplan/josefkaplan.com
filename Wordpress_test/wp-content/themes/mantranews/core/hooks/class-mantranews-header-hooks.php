<?php

if (!class_exists('Mantranews_Header_Hooks')) {

    class Mantranews_Header_Hooks
    {

        public function __construct()
        {
            add_action('mantranews_top_header_section', array($this, 'mantranews_top_header_section_callback'), 10);
            add_action('mantranews_logo_ads_section', array($this, 'mantranews_logo_ads_section_callback'), 10);

            // start parallax header
            add_action('mantranews_before_header_content', array($this, 'mantranews_header_parallax_html_open'), 10);
            add_action('mantranews_after_header_content', array($this, 'mantranews_header_parallax_html_close'), 10);
            // end parallax header
        }

        public function mantranews_top_header_section_callback()
        {
            ?>
            <div class="top-header-section">
                <div class="mb-container">
                    <div class="top-left-header">
                        <?php do_action('mantranews_current_date'); ?>
                        <nav id="top-header-navigation" class="top-navigation">
                            <?php wp_nav_menu(array('theme_location' => 'top-header',
                                'container_class' => 'top-menu',
                                'fallback_cb' => false,
                                'items_wrap' => '<ul>%3$s</ul>'
                            )); ?>
                        </nav>
                    </div>
                    <?php do_action('mantranews_top_social_icons'); ?>
                </div> <!-- mb-container end -->
            </div><!-- .top-header-section -->

            <?php
        }

        public function mantranews_logo_ads_section_callback()
        {

            ?>
            <div class="logo-ads-wrapper clearfix">
                <div class="mb-container">
                    <div class="site-branding">
                        <?php if (the_custom_logo()) { ?>
                            <div class="site-logo">
                                <?php the_custom_logo(); ?>
                            </div><!-- .site-logo -->
                        <?php } ?>
                        <?php
                        $site_title_option = get_theme_mod('header_textcolor');
                        if ($site_title_option != 'blank') {
                            ?>
                            <div class="site-title-wrapper">
                                <?php
                                if (is_front_page() && is_home()) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                              rel="home"><?php bloginfo('name'); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                             rel="home"><?php bloginfo('name'); ?></a></p>
                                <?php
                                endif;

                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()) : ?>
                                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                <?php
                                endif; ?>
                            </div><!-- .site-title-wrapper -->
                            <?php
                        }
                        ?>
                    </div><!-- .site-branding -->
                    <div class="header-ads-wrapper">
                        <?php
                        if (is_active_sidebar('mantranews_header_ads_area')) {
                            dynamic_sidebar('mantranews_header_ads_area');
                        } ?>
                    </div><!-- .header-ads-wrapper -->
                </div>
            </div><!-- .logo-ads-wrapper -->
            <?php

        }

        public function mantranews_header_parallax_html_open()
        {
            $parallax_header = get_theme_mod('mantranews_parallax_header', '');

            $mantranews_enable_hero_parallax = $this->is_hero_parallax_enable();

            if (!empty($parallax_header)) {
                /**
                 * Parallax Feature for Header
                 * @package Mantrabrain
                 * @subpackage mantranews
                 * @since 1.0.0
                 */ ?>
            <div class="mb-parallax" style='background-image: url("<?php echo esc_url($parallax_header); ?>");'>
                <div
                class="mb-parallax-content <?php echo $mantranews_enable_hero_parallax ? 'mb-hero-parallax' : '' ?>"><?php
            }
        }

        public function mantranews_header_parallax_html_close()
        {
            $parallax_header = get_theme_mod('mantranews_parallax_header', '');

            if (!empty($parallax_header)) {

                if ($this->is_hero_parallax_enable()) {

                    $this->hero_parallax_content();
                }


                echo '</div></div><!-- .parallax-->';
            }

        }

        function hero_parallax_content()
        {
            echo '<div class="mb-parallax-hero-content">';

            echo '<div class="mb-container">';

            $heading = get_theme_mod('mantranews_hero_parallax_heading');

            $subheading = get_theme_mod('mantranews_hero_parallax_subheading');

            $button_text = get_theme_mod('mantranews_hero_parallax_button_text');

            $button_url = get_theme_mod('mantranews_hero_parallax_button_url');

            if (!empty($heading)) {

                echo '<h1 class="hero-heading">';

                echo esc_html($heading);

                echo '</h1>';
            }

            if (!empty($subheading)) {

                echo '<h3 class="hero-subheading">';

                echo esc_html($subheading);

                echo '</h3>';
            }

            if (!empty($button_text)) {

                $button_url = !empty($button_url) ? esc_url($button_url) : '#';

                echo '<a href="' . $button_url . '" target="_blank" class="mb-parallax-hero-button" style="display:inline-block" title="' . esc_attr($button_text) . '">';

                echo esc_html($button_text);

                echo '</a>';
            }

            echo '</div>';

            echo '</div>';

            echo '<div style="clear:both"></div>';

        }

        function is_hero_parallax_enable()
        {

            $enable = get_theme_mod('mantranews_enable_hero_parallax', 'disable');

            $enable_on_all_pages = get_theme_mod('mantranews_enable_hero_parallax_on_all_pages', 'disable');

            if ('enable' != $enable) {

                return false;

            }

            if ('enable' != $enable_on_all_pages) {

                if (is_front_page()) {

                    return true;

                } else {

                    return false;
                }


            }
            return true;

        }


    }
}
new Mantranews_Header_Hooks();
