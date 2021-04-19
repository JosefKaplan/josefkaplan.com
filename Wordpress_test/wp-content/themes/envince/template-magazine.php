<?php
/**
 * Template Name: Magazine
 */
get_header(); // Loads the header.php template. ?>

<?php hybrid_get_sidebar( 'fronttop' ); // Loads the sidebar/fronttop.php template. ?>

<?php
$layout_global = get_theme_mod('envince_sidebar','content-sidebar');

	if(is_singular()){

		$layout = get_post_meta( get_the_ID(), 'envince_sidebarlayout', 'default', true );

			if(($layout == "default") || (empty($layout))){
				$layout = $layout_global;
			}
	}
	else {
		$layout = $layout_global;
	}

	if ($layout == "sidebar-sidebar-content" ) {
		hybrid_get_sidebar( 'secondary' ); // Loads the sidebar/secondary.php template.
		}

	if ($layout == "sidebar-content-sidebar" || $layout == "sidebar-sidebar-content" || $layout == "sidebar-content") {
		hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template.
		}
 ?>

<main class="col-sm-12 <?php envince_main_layout_class(); ?>" <?php hybrid_attr( 'content' ); ?>>

	<?php hybrid_get_sidebar( 'frontcontent' ); // Loads the sidebar/frontcontent.php template. ?>

</main><!-- #content -->

<?php

if ($layout == "sidebar-content-sidebar" || $layout == "content-sidebar-sidebar" || $layout == "content-sidebar") {
	hybrid_get_sidebar( 'secondary' ); // Loads the sidebar/secondary.php template.
	}

if ($layout == "content-sidebar-sidebar" ) {
	hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template.
	}
?>

<?php get_footer(); // Loads the footer.php template. ?>