<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

	<div id="container">

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'envince' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<div id="header-top">
				<div  class="container">
					<div class="row">

						<div class="info-icons col-md-6 col-sm-12 pull-left">
							<?php envince_header_info_render(); ?>
						</div>

						<div class="social-icons col-md-6 col-sm-12 pull-right">
							<?php hybrid_get_menu( 'social-header' ); // Loads the menu/social-header.php template. ?>
						</div>

					</div>
				</div>
			</div>

			<div id="main-header" class="container">
				<div class="row">

					<div id="branding" class="site-branding col-md-4">

						<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) : ?>

							<div class="header-logo">
								<?php envince_the_custom_logo(); ?>
							</div>

						<?php endif; // End check for logo ?>



						<div class="header-text">
						<?php
						if ( get_theme_mod( 'envince_site_title', '1' ) == '1') {
							hybrid_site_title();
						}
						if ( get_theme_mod( 'envince_site_description', '1' ) == '1') {
							hybrid_site_description();
						}
						?>
						</div>
					</div><!-- #branding -->

					<div class="header-right-section col-md-8 pull-right">
						<?php hybrid_get_sidebar( 'header' ); // Loads the sidebar/header.php template. ?>
					</div>

				</div>
			</div>

			<div id="main-menu" class="clearfix">

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</div>

		</header><!-- #header -->

		<?php if ( get_header_image() || ( function_exists( 'the_custom_header_markup' ) && is_front_page() && has_header_video() ) ) : // If there's a header image. ?>

		<section id="intro" data-speed="6" data-type="background">
			<?php if ( function_exists( 'the_custom_header_markup' ) && is_front_page() && has_header_video() ) {
				the_custom_header_markup();
			} ?>
		</section>

		<?php endif; // End check for header image. ?>

		<div id="#site-content" class="site-content clearfix">

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
					</div>
