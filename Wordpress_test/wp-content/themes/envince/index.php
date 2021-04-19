<?php get_header(); // Loads the header.php template. ?>

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

	<?php if ( !is_front_page() && !is_singular() && !is_404() ) : // If viewing a multi-post page ?>

		<?php locate_template( array( 'misc/loop-meta.php' ), true ); // Loads the misc/loop-meta.php template. ?>

	<?php endif; // End check for multi-post page. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

			<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

			<?php if ( ( get_theme_mod( 'envince_related_posts_activate', 0 ) == 1 ) && is_single() ) {
				locate_template( array( 'content/related-posts.php' ), true );
			} ?>

			<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

				<?php comments_template( '', true ); // Loads the comments.php template. ?>

			<?php endif; // End check for single post. ?>

		<?php endwhile; // End found posts loop. ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

	<?php endif; // End check for posts. ?>

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
