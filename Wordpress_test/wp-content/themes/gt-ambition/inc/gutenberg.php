<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package GT Ambition
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function gt_ambition_gutenberg_support() {

	// Get theme options from database.
	$theme_options = gt_ambition_theme_options();

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'gt_ambition_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'gt-ambition' ),
			'slug'  => 'primary',
			'color' => esc_html( $theme_options['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'gt-ambition' ),
			'slug'  => 'secondary',
			'color' => esc_html( $theme_options['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'gt-ambition' ),
			'slug'  => 'accent',
			'color' => esc_html( $theme_options['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'gt-ambition' ),
			'slug'  => 'highlight',
			'color' => esc_html( $theme_options['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'gt-ambition' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'gt-ambition' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $theme_options['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'gt-ambition' ),
			'slug'  => 'gray',
			'color' => esc_html( $theme_options['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'gt-ambition' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $theme_options['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'gt-ambition' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Add theme support for font sizes.
	add_theme_support( 'editor-font-sizes', apply_filters( 'gt_ambition_editor_font_sizes_args', array(
		array(
			'name' => esc_html_x( 'Small', 'block font size', 'gt-ambition' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => esc_html_x( 'Medium', 'block font size', 'gt-ambition' ),
			'size' => 24,
			'slug' => 'medium',
		),
		array(
			'name' => esc_html_x( 'Large', 'block font size', 'gt-ambition' ),
			'size' => 36,
			'slug' => 'large',
		),
		array(
			'name' => esc_html_x( 'Extra Large', 'block font size', 'gt-ambition' ),
			'size' => 48,
			'slug' => 'extra-large',
		),
		array(
			'name' => esc_html_x( 'Huge', 'block font size', 'gt-ambition' ),
			'size' => 64,
			'slug' => 'huge',
		),
	) ) );

	// Register Small Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-small',
		'label'        => esc_html__( 'GT Small', 'gt-ambition' ),
		'style_handle' => 'gt-ambition-stylesheet',
	) );

	// Register Large Buttons Block style.
	register_block_style( 'core/buttons', array(
		'name'         => 'gt-large',
		'label'        => esc_html__( 'GT Large', 'gt-ambition' ),
		'style_handle' => 'gt-ambition-stylesheet',
	) );

	// Check if block pattern functions are available.
	if ( function_exists( 'register_block_pattern' ) && function_exists( 'register_block_pattern_category' ) ) {

		// Register block pattern category.
		register_block_pattern_category( 'gt-ambition', array( 'label' => esc_html__( 'GT Ambition', 'gt-ambition' ) ) );

		// Register Block patterns.
		register_block_pattern( 'gt-ambition/hero-section', array(
			'title'      => esc_html__( 'Hero Section', 'gt-ambition' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"primary\",\"textColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:group {\"align\":\"wide\"} --><div class=\"wp-block-group alignwide\"><div class=\"wp-block-group__inner-container\"><!-- wp:spacer {\"height\":50} --><div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --><!-- wp:heading {\"align\":\"center\",\"level\":1,\"fontSize\":\"huge\"} --><h1 class=\"has-text-align-center has-huge-font-size\">Build your page with Blocks</h1><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis diss parturient montes, nascetur ridiculus mus. </p><!-- /wp:paragraph --><!-- wp:buttons {\"align\":\"center\",\"className\":\"is-style-gt-large\"} --><div class=\"wp-block-buttons aligncenter is-style-gt-large\"><!-- wp:button {\"backgroundColor\":\"secondary\",\"textColor\":\"white\"} --><div class=\"wp-block-button\"><a class=\"wp-block-button__link has-white-color has-secondary-background-color has-text-color has-background\">Call to Action</a></div><!-- /wp:button --><!-- wp:button {\"backgroundColor\":\"secondary\",\"className\":\"is-style-fill\"} --><div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-secondary-background-color has-background\">Second Button</a></div><!-- /wp:button --></div><!-- /wp:buttons --><!-- wp:spacer {\"height\":75} --><div style=\"height:75px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div><!-- /wp:spacer --></div></div><!-- /wp:group --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-ambition' ),
		) );

		register_block_pattern( 'gt-ambition/features', array(
			'title'      => esc_html__( 'Features', 'gt-ambition' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Feature 1</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Feature 2</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Feature 3</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Feature 4</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-ambition' ),
		) );

		register_block_pattern( 'gt-ambition/portfolio', array(
			'title'      => esc_html__( 'Portfolio', 'gt-ambition' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-group alignfull has-light-gray-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns {\"align\":\"wide\"} --><div class=\"wp-block-columns alignwide\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:group {\"backgroundColor\":\"white\"} --><div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Project 1</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:group {\"backgroundColor\":\"white\"} --><div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Project 2</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:group {\"backgroundColor\":\"white\"} --><div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image --><figure class=\"wp-block-image\"><img alt=\"\"/></figure><!-- /wp:image --><!-- wp:heading {\"align\":\"center\",\"level\":3} --><h3 class=\"has-text-align-center\">Project 3</h3><!-- /wp:heading --><!-- wp:paragraph {\"align\":\"center\"} --><p class=\"has-text-align-center\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean ligula eget dolor.</p><!-- /wp:paragraph --></div></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-ambition' ),
		) );

		register_block_pattern( 'gt-ambition/services', array(
			'title'      => esc_html__( 'Services', 'gt-ambition' ),
			'content'    => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 01</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group --><!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"light-gray\"} --><div class=\"wp-block-group alignfull has-light-gray-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text {\"mediaPosition\":\"right\"} --><div class=\"wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 02</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group --><!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"white\"} --><div class=\"wp-block-group alignfull has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:media-text --><div class=\"wp-block-media-text alignwide is-stacked-on-mobile\"><figure class=\"wp-block-media-text__media\"></figure><div class=\"wp-block-media-text__content\"><!-- wp:heading --><h2>Service 03</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text --></div></div><!-- /wp:group -->",
			'categories' => array( 'gt-ambition' ),
		) );
	}
}
add_action( 'after_setup_theme', 'gt_ambition_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function gt_ambition_block_editor_assets() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Editor Styling.
	wp_enqueue_style( 'gt-ambition-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), $theme_version, 'all' );

	// Enqueue Theme Settings Sidebar plugin.
	wp_enqueue_script( 'gt-ambition-editor-theme-settings', get_theme_file_uri( '/assets/js/editor-theme-settings.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), $theme_version );

	$theme_settings_l10n = array(
		'plugin_title'         => esc_html__( 'Theme Settings', 'gt-ambition' ),
		'page_options'         => esc_html__( 'Page Options', 'gt-ambition' ),
		'page_layout'          => esc_html__( 'Page Layout', 'gt-ambition' ),
		'default_layout'       => esc_html__( 'Default', 'gt-ambition' ),
		'full_layout'          => esc_html__( 'Full-width', 'gt-ambition' ),
		'hide_title'           => esc_html__( 'Hide title?', 'gt-ambition' ),
		'remove_bottom_margin' => esc_html__( 'Remove bottom margin?', 'gt-ambition' ),
	);
	wp_localize_script( 'gt-ambition-editor-theme-settings', 'gtThemeSettingsL10n', $theme_settings_l10n );
}
add_action( 'enqueue_block_editor_assets', 'gt_ambition_block_editor_assets' );


/**
 * Register Post Meta
 */
function gt_ambition_register_post_meta() {
	register_post_meta( 'page', 'gt_page_layout', array(
		'type'              => 'string',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	register_post_meta( 'page', 'gt_hide_page_title', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );

	register_post_meta( 'page', 'gt_remove_bottom_margin', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'gt_ambition_register_post_meta' );


/**
 * Add body classes in Gutenberg Editor.
 */
function gt_ambition_gutenberg_add_admin_body_class( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Layout?
	if ( get_post_type( $post->ID ) && 'fullwidth' === get_post_meta( $post->ID, 'gt_page_layout', true ) ) {
		$classes .= ' gt-fullwidth-page-layout ';
	}

	// Page Title hidden?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_hide_page_title', true ) ) {
		$classes .= ' gt-page-title-hidden ';
	}

	// Remove bottom margin of page?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_remove_bottom_margin', true ) ) {
		$classes .= ' gt-page-bottom-margin-removed ';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'gt_ambition_gutenberg_add_admin_body_class' );


/**
 * Remove inline styling in Gutenberg.
 *
 * @return array $editor_settings
 */
function gt_ambition_block_editor_settings( $editor_settings ) {
	// Remove editor styling.
	if ( ! current_theme_supports( 'editor-styles' ) ) {
		$editor_settings['styles'] = '';
	}

	return $editor_settings;
}
add_filter( 'block_editor_settings', 'gt_ambition_block_editor_settings', 11 );
