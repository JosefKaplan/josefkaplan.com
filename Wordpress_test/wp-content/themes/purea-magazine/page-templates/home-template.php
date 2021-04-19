<?php
/**
 * Template Name: Home Template
 *
 * Displays the Home Template of the theme.
 * @package purea-magazine
 */

get_header();

?>

<div id="primary" class="<?php echo esc_attr(get_theme_mod('purea_magazine_header_menu_style','style1')); ?> content-area">
	<main id="main" class="site-main" role="main">
		<div class="content-inner">
			<div class="content-wrapper">
				<div class="row">
					<?php
						if('right-sidebar'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))) {
							if ( is_active_sidebar( 'purea-magazine-hp-main-section' ) ) {
								?>
									<div id="content-main" class="col-md-9 widget-area">
										<div class="posts-wrapper">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-main-section' );
											?>
										</div>
									</div>
								<?php
							}
							if ( is_active_sidebar( 'purea-magazine-hp-right-section' ) ) {
								?>
									<div id="content-right" class="col-md-3 col-right widget-area">
										<aside role="complementary">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-right-section' );
											?>
										</aside>
									</div>
								<?php
							}
						}
						elseif('left-sidebar'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))) {
							if ( is_active_sidebar( 'purea-magazine-hp-left-section' ) ) {
								?>
									<div id="content-left" class="col-md-3 col-left widget-area">
										<aside role="complementary">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-left-section' );
											?>
										</aside>
									</div>
								<?php
							}
							if ( is_active_sidebar( 'purea-magazine-hp-main-section' ) ) {
								?>
									<div id="content-main" class="col-md-9 widget-area">
										<div class="posts-wrapper">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-main-section' );
											?>
										</div>
									</div>
								<?php
							}
							
						}
						else{
							if ( is_active_sidebar( 'purea-magazine-hp-main-section' ) ) {
								?>
									<div id="content-main" class="col-middle widget-area">
										<div class="posts-wrapper">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-main-section' );
											?>
										</div>
									</div>
								<?php
							}
							if ( is_active_sidebar( 'purea-magazine-hp-left-section' ) ) {
								?>
									<div id="content-left" class="col-left widget-area">
										<aside role="complementary">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-left-section' );
											?>
										</aside>
									</div>
								<?php
							}
							if ( is_active_sidebar( 'purea-magazine-hp-right-section' ) ) {
								?>
									<div id="content-right" class="col-right widget-area">
										<aside role="complementary">
											<?php
												dynamic_sidebar( 'purea-magazine-hp-right-section' );
											?>
										</aside>
									</div>
								<?php
							}
						}
					?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</main>
</div>

<?php
get_footer();