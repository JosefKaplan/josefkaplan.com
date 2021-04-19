<?php
/**
 * About page of Mantrabrain Theme
 *
 * @package Mantrabrain
 * @subpackage Mantrabrain
 * @since 1.0.6
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Mantranews_About')) :

    class Mantranews_About
    {

        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('wp_loaded', array(__CLASS__, 'hide_notices'));
            add_action('load-themes.php', array($this, 'admin_notice'));
            add_action('admin_enqueue_scripts', array($this, 'about_theme_styles'));
        }

        /**
         * Add admin menu.
         */
        public function admin_menu()
        {
            $theme = wp_get_theme(get_template());

            $page = add_theme_page(esc_html__('About', 'mantranews') . ' ' . $theme->display('Name'), esc_html__('About', 'mantranews') . ' ' . $theme->display('Name'), 'activate_plugins', 'mantranews-welcome', array($this, 'welcome_screen'));
        }

        /**
         * Enqueue styles.
         */
        public function about_theme_styles($hook)
        {
            if ('appearance_page_mantranews-welcome' != $hook && 'themes.php' != $hook) {
                return;
            }
            global $mantranews_version;

            wp_enqueue_style('mantranews-about-style', get_template_directory_uri() . '/core/about-theme/about.css', array(), $mantranews_version);
        }

        /**
         * Add admin notice.
         */
        public function admin_notice()
        {
            global $mantranews_version, $pagenow;

            // Let's bail on theme activation.
            if ('themes.php' == $pagenow && isset($_GET['activated'])) {
                add_action('admin_notices', array($this, 'welcome_notice'));
                update_option('mantranews_admin_notice_welcome', 1);

                // No option? Let run the notice wizard again..
            } elseif (!get_option('mantranews_admin_notice_welcome')) {
                add_action('admin_notices', array($this, 'welcome_notice'));
            }
        }

        /**
         * Hide a notice if the GET variable is set.
         */
        public static function hide_notices()
        {
            if (isset($_GET['mantranews-hide-notice']) && isset($_GET['_mantranews_notice_nonce'])) {
                if (!wp_verify_nonce($_GET['_mantranews_notice_nonce'], 'mantranews_hide_notices_nonce')) {
                    wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'mantranews'));
                }

                if (!current_user_can('manage_options')) {
                    wp_die(esc_html__('Cheat in &#8217; huh?', 'mantranews'));
                }

                $hide_notice = sanitize_text_field($_GET['mantranews-hide-notice']);
                update_option('mantranews_admin_notice_' . $hide_notice, 1);
            }
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice()
        {
            $theme = wp_get_theme(get_template());

            $theme_name = $theme->get('Name');
            ?>
            <div id="mt-theme-message" class="updated mantranews-message">
                <a class="mantranews-message-close notice-dismiss"
                   href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('mantranews-hide-notice', 'welcome')), 'mantranews_hide_notices_nonce', '_mantranews_notice_nonce')); ?>"><?php esc_html_e('Dismiss', 'mantranews'); ?></a>
                <p><?php printf(esc_html__('Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$s welcome page %3$s.', 'mantranews'), esc_html($theme_name), '<a href="' . esc_url(admin_url('themes.php?page=mantranews-welcome')) . '">', '</a>'); ?></p>
                <p class="submit">
                    <a class="button button-primary button-hero"
                       href="<?php echo esc_url(admin_url('themes.php?page=mantranews-welcome')); ?>"><?php printf(esc_html__('Get started with %1$s', 'mantranews'), esc_html($theme_name)); ?></a>
                </p>
            </div>
            <?php
        }

        /**
         * Intro text/links shown to all about pages.
         *
         * @access private
         */
        private function intro()
        {
            global $mantranews_version;
            $theme = wp_get_theme(get_template());

            $theme_name = $theme->get('Name');
            $theme_description = $theme->get('Description');
            $theme_uri = $theme->get('ThemeURI');

            // Drop minor version if 0
            ?>
            <div class="mantranews-theme-info">

                <h1> <?php echo esc_html('About ', 'mantranews') . ' ' . esc_html($theme_name) . ' ' . esc_html($mantranews_version); ?> </h1>

                <div class="welcome-description-wrap">
                    <div class="about-text"><?php echo wp_kses_post($theme_description); ?></div>

                    <div class="mantranews-screenshot">
                        <img src="<?php echo esc_url(get_template_directory_uri()) . '/screenshot.png'; ?>"/>
                    </div>
                </div>
            </div>

            <p class="mantranews-actions">
                <a href="<?php echo esc_url($theme_uri); ?>" class="button button-secondary"
                   target="_blank"><?php esc_html_e('Theme Info', 'mantranews'); ?></a>

                <a href="<?php echo esc_url(apply_filters('mantranews_pro_theme_url', 'https://demo.mantrabrain.com/mantranews-wordpress-theme/')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('View Demo', 'mantranews'); ?></a>

                <a href="<?php echo esc_url(apply_filters('mantranews_pro_theme_url', 'https://mantrabrain.com/downloads/mantranews-pro-wordpress-news-theme/?utm_source=free_customizer&utm_medium=mantranews_free&utm_campaign=free_about')); ?>"
                   class="button button-primary docs"
                   target="_blank"><?php esc_html_e('View PRO version', 'mantranews'); ?></a>

                <a href="<?php echo esc_url(apply_filters('mantranews_pro_theme_url', 'https://wordpress.org/support/theme/mantranews/reviews/?filter=5')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('Rate this theme', 'mantranews'); ?></a>
            </p>

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php if (empty($_GET['tab']) && $_GET['page'] == 'mantranews-welcome') echo 'nav-tab-active'; ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'mantranews-welcome'), 'themes.php'))); ?>">
                    <?php echo esc_html($theme->display('Name')); ?>
                </a>

                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'free_vs_pro') echo 'nav-tab-active'; ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'mantranews-welcome', 'tab' => 'free_vs_pro'), 'themes.php'))); ?>">
                    <?php esc_html_e('Free Vs Pro', 'mantranews'); ?>
                </a>

                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'more_themes') echo 'nav-tab-active'; ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'mantranews-welcome', 'tab' => 'more_themes'), 'themes.php'))); ?>">
                    <?php esc_html_e('More Themes', 'mantranews'); ?>
                </a>

                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'changelog') echo 'nav-tab-active'; ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'mantranews-welcome', 'tab' => 'changelog'), 'themes.php'))); ?>">
                    <?php esc_html_e('Changelog', 'mantranews'); ?>
                </a>
                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'video') echo 'nav-tab-active'; ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'mantranews-welcome', 'tab' => 'video'), 'themes.php'))); ?>">
                    <?php esc_html_e('Video Tutorial', 'mantranews'); ?>
                </a>
            </h2>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen()
        {
            $current_tab = empty($_GET['tab']) ? 'about' : sanitize_title($_GET['tab']);

            // Look for a {$current_tab}_screen method.
            if (is_callable(array($this, $current_tab . '_screen'))) {
                return $this->{$current_tab . '_screen'}();
            }

            // Fallback to about screen.
            return $this->about_screen();
        }

        /**
         * Output the about screen.
         */
        public function video_screen()
        {

            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <h4><?php esc_html_e('Mantranews Pro Video Tutorial', 'mantranews'); ?></h4>

                <iframe width="560" height="315" src="https://www.youtube.com/embed/_VboOoRqHao" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

            </div>
            <?php
        }

        /**
         * Output the about screen.
         */
        public function about_screen()
        {
            $theme = wp_get_theme(get_template());
            $theme_name = $theme->get('Name');
            $theme_description = $theme->get('Description');
            $theme_uri = $theme->get('ThemeURI');
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <div class="changelog point-releases">
                    <div class="under-the-hood two-col">
                        <div class="col">
                            <h3><?php esc_html_e('Theme Customizer', 'mantranews'); ?></h3>
                            <p><?php esc_html_e('All Theme Options are available via Customize screen.', 'mantranews') ?></p>
                            <p><a href="<?php echo esc_url(admin_url('customize.php')); ?>"
                                  class="button button-secondary"><?php esc_html_e('Customize', 'mantranews'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Documentation', 'mantranews'); ?></h3>
                            <p><?php esc_html_e('Please view our documentation page to setup the theme.', 'mantranews') ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://mantrabrain.com/docs-category/mantranews-wordpress-theme/'); ?>"
                                   class="button button-secondary"
                                   target="_blank"><?php esc_html_e('Documentation', 'mantranews'); ?></a></p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Got theme support question?', 'mantranews'); ?></h3>
                            <p><?php esc_html_e('Please put it in our dedicated support forum.', 'mantranews') ?></p>
                            <p><a href="<?php echo esc_url('https://mantrabrain.com/support-forum/'); ?>"
                                  class="button button-secondary"
                                  target="_blank"><?php esc_html_e('Support', 'mantranews'); ?></a></p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Need more features?', 'mantranews'); ?></h3>
                            <p><?php esc_html_e('Upgrade to PRO version for more exciting features.', 'mantranews') ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://mantrabrain.com/downloads/mantranews-pro-wordpress-news-theme/?utm_source=free_customizer&utm_medium=mantranews_free&utm_campaign=free_about'); ?>"
                                   class="button button-secondary"
                                   target="_blank"><?php esc_html_e('View PRO version', 'mantranews'); ?></a></p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Have you need customization?', 'mantranews'); ?></h3>
                            <p><?php esc_html_e('Please send message with your requirement.', 'mantranews') ?></p>
                            <p><a href="<?php echo esc_url('https://mantrabrain.com/customization/'); ?>"
                                  class="button button-secondary"
                                  target="_blank"><?php esc_html_e('Customization', 'mantranews'); ?></a></p>
                        </div>

                        <div class="col">
                            <h3> <?php printf(esc_html__('Translate %1$s', 'mantranews'), esc_html($theme_name)); ?> </h3>
                            <p><?php esc_html_e('Click below to translate this theme into your own language.', 'mantranews') ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://translate.wordpress.org/projects/wp-themes/mantranews'); ?>"
                                   class="button button-secondary"
                                   target="_blank"><?php printf(esc_html__('Translate %1$s', 'mantranews'), esc_html($theme_name)); ?></a>
                            </p>
                        </div>
                    </div>
                </div><!-- .point-releases -->

                <div class="return-to-dashboard mantranews">
                    <?php if (current_user_can('update_core') && isset($_GET['updated'])) : ?>
                        <a href="<?php echo esc_url(self_admin_url('update-core.php')); ?>">
                            <?php is_multisite() ? esc_html_e('Return to Updates', 'mantranews') : esc_html_e('Return to Dashboard &rarr; Updates', 'mantranews'); ?>
                        </a> |
                    <?php endif; ?>
                    <a href="<?php echo esc_url(self_admin_url()); ?>"><?php is_blog_admin() ? esc_html_e('Go to Dashboard &rarr; Home', 'mantranews') : esc_html_e('Go to Dashboard', 'mantranews'); ?></a>
                </div><!-- .return-to-dashboard -->
            </div><!-- .about-wrap -->
            <?php
        }

        /**
         * Output the more themes screen
         */
        public function more_themes_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>
                <div class="theme-browser rendered">
                    <div class="themes wp-clearfix">
                        <?php
                        // Set the argument array with author name.
                        $args = array(
                            'author' => 'mantrabrain',
                        );
                        // Set the $request array.
                        $request = array(
                            'body' => array(
                                'action' => 'query_themes',
                                'request' => serialize((object)$args)
                            )
                        );
                        $themes = $this->mantranews_get_themes($request);
                        $active_theme = wp_get_theme()->get('Name');
                        $counter = 1;

                        // For currently active theme.
                        foreach ($themes->themes as $theme) {
                            if ($active_theme == $theme->name) { ?>

                                <div id="<?php echo esc_attr($theme->slug); ?>" class="theme active">
                                    <div class="theme-screenshot">
                                        <img src="<?php echo esc_url($theme->screenshot_url); ?>"/>
                                    </div>
                                    <h3 class="theme-name" id="mantranews-name">
                                        <strong><?php esc_html_e('Active', 'mantranews'); ?></strong>: <?php echo esc_html($theme->name); ?>
                                    </h3>
                                    <div class="theme-actions">
                                        <a class="button button-primary customize load-customize hide-if-no-customize"
                                           href="<?php echo esc_url(get_site_url() . '/wp-admin/customize.php'); ?>"><?php esc_html_e('Customize', 'mantranews'); ?></a>
                                    </div>
                                </div><!-- .theme active -->
                                <?php
                                $counter++;
                                break;
                            }
                        }

                        // For all other themes.
                        foreach ($themes->themes as $theme) {
                            if ($active_theme != $theme->name) {
                                // Set the argument array with author name.
                                $args = array(
                                    'slug' => esc_attr($theme->slug),
                                );
                                // Set the $request array.
                                $request = array(
                                    'body' => array(
                                        'action' => 'theme_information',
                                        'request' => serialize((object)$args)
                                    )
                                );
                                $theme_details = $this->mantranews_get_themes($request);
                                ?>
                                <div id="<?php echo esc_attr($theme->slug); ?>" class="theme">
                                    <div class="theme-screenshot">
                                        <img src="<?php echo esc_url($theme->screenshot_url); ?>"/>
                                    </div>

                                    <h3 class="theme-name"><?php echo esc_html($theme->name); ?></h3>

                                    <div class="theme-actions">
                                        <?php if (wp_get_theme($theme->slug)->exists()) { ?>
                                            <!-- Activate Button -->
                                            <a class="button button-secondary activate"
                                               href="<?php echo wp_nonce_url(admin_url('themes.php?action=activate&amp;stylesheet=' . urlencode($theme->slug)), 'switch-theme_' . esc_attr($theme->slug)); ?>"><?php esc_html_e('Activate', 'mantranews') ?></a>
                                        <?php } else {
                                            // Set the install url for the theme.
                                            $install_url = add_query_arg(array(
                                                'action' => 'install-theme',
                                                'theme' => esc_attr($theme->slug),
                                            ), self_admin_url('update.php'));
                                            ?>
                                            <!-- Install Button -->
                                            <a data-toggle="tooltip" data-placement="bottom"
                                               title="<?php echo esc_attr('Downloaded ', 'mantranews') . number_format($theme_details->downloaded) . ' ' . esc_attr('times', 'mantranews'); ?>"
                                               class="button button-secondary activate"
                                               href="<?php echo esc_url(wp_nonce_url($install_url, 'install-theme_' . $theme->slug)); ?>"><?php esc_html_e('Install Now', 'mantranews'); ?></a>
                                        <?php } ?>

                                        <a class="button button-primary load-customize hide-if-no-customize"
                                           target="_blank"
                                           href="<?php echo esc_url($theme->preview_url); ?>"><?php esc_html_e('Live Preview', 'mantranews'); ?></a>
                                    </div>
                                </div><!-- .theme -->
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div><!-- .mt-theme-holder -->
            </div><!-- .wrap.about-wrap -->
            <?php
        }

        /**
         * Get all our themes by using API.
         */
        private function mantranews_get_themes($request)
        {

            // Generate a cache key that would hold the response for this request:
            $key = 'mantranews_' . md5(serialize($request));

            // Check transient. If it's there - use that, if not re fetch the theme
            if (false === ($themes = get_transient($key))) {

                // Transient expired/does not exist. Send request to the API.
                $response = wp_remote_post('http://api.wordpress.org/themes/info/1.0/', $request);

                // Check for the error.
                if (!is_wp_error($response)) {

                    $themes = unserialize(wp_remote_retrieve_body($response));

                    if (!is_object($themes) && !is_array($themes)) {

                        // Response body does not contain an object/array
                        return new WP_Error('theme_api_error', 'An unexpected error has occurred');
                    }

                    // Set transient for next time... keep it for 24 hours should be good
                    set_transient($key, $themes, 60 * 60 * 24);
                } else {
                    // Error object returned
                    return $response;
                }
            }
            return $themes;
        }

        /**
         * Output the changelog screen.
         */
        public function changelog_screen()
        {
            global $wp_filesystem;

            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <h4><?php esc_html_e('View changelog below:', 'mantranews'); ?></h4>

                <?php
                $changelog_file = apply_filters('mantranews_changelog_file', get_template_directory() . '/readme.txt');

                // Check if the changelog file exists and is readable.
                if ($changelog_file && is_readable($changelog_file)) {
                    WP_Filesystem();
                    $changelog = $wp_filesystem->get_contents($changelog_file);
                    $changelog_list = $this->parse_changelog($changelog);

                    echo wp_kses_post($changelog_list);
                }
                ?>
            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         * @param  string $content
         * @return string
         */
        private function parse_changelog($content)
        {
            $matches = null;
            $regexp = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if (preg_match($regexp, $content, $matches)) {
                $changes = explode('\r\n', trim($matches[1]));

                $changelog .= '<pre class="changelog">';

                foreach ($changes as $index => $line) {
                    $changelog .= wp_kses_post(preg_replace('~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line));
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post($changelog);
        }

        /**
         * Output the free vs pro screen.
         */
        public function free_vs_pro_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <h4><?php esc_html_e('Upgrade to PRO version for more exciting features.', 'mantranews'); ?></h4>

                <table>
                    <thead>
                    <tr>
                        <th class="table-feature-title"><h3><?php esc_html_e('Features', 'mantranews'); ?></h3></th>
                        <th><h3><?php esc_html_e('Mantranews', 'mantranews'); ?></h3></th>
                        <th><h3><?php esc_html_e('Mantranews Pro', 'mantranews'); ?></h3></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h3><?php esc_html_e('Price', 'mantranews'); ?></h3></td>
                        <td><?php esc_html_e('Free', 'mantranews'); ?></td>
                        <td><?php esc_html_e('$48 to $68', 'mantranews'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Import Demo Data', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('Category color options', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('Advance Featured Slider', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('Parallax Header', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Parallax Footer', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Additional color options', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('15', 'mantranews'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Primary color option', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Font size options', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Google fonts options', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('500+', 'mantranews'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Custom widgets', 'mantranews'); ?></h3></td>
                        <td><?php esc_html_e('7', 'mantranews'); ?></td>
                        <td><?php esc_html_e('16', 'mantranews'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social icons', 'mantranews'); ?></h3></td>
                        <td><?php esc_html_e('6', 'mantranews'); ?></td>
                        <td><?php esc_html_e('6', 'mantranews'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social sharing', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Site layout option', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Options in breaking news', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Change read more text', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Related posts', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Footer copyright editor', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('728x90 Advertisement', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Featured category slider', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Random posts widget', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Tabbed widget', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Videos', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('WooCommerce compatible', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Multiple header options', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Readmore flying card', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Weather widget', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Currency converter widget', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Category enable/disable option', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Reading indicator option', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Lightbox support', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Call to action widget', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Contact us template', 'mantranews'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="btn-wrapper">
                            <a href="<?php echo esc_url(apply_filters('mantranews_pro_theme_url', 'https://mantrabrain.com/downloads/mantranews-pro-wordpress-news-theme/?utm_source=free_customizer&utm_medium=mantranews_free&utm_campaign=free_about')); ?>"
                               class="button button-secondary docs"
                               target="_blank"><?php esc_html_e('View Pro', 'mantranews'); ?></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <?php
        }
    }

endif;

return new Mantranews_About();