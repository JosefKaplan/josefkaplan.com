<?php
/**
 *
 * Wortex Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2014-2020 Iceable Themes - https://www.iceablethemes.com
 *
 * Main Index
 *
 */

get_header();

$wortex_page_title = '';

/* SEARCH CONDITIONAL TITLE */
if ( is_search() ) :
	$wortex_page_title = sprintf(
		// Translators: %s is the search term.
		esc_html__( 'Search Results for "%s"', 'wortex-lite' ),
		get_search_query()
	);
endif;

/* ARCHIVE CONDITIONAL TITLE */
if ( is_archive() ) :
	$wortex_page_title = get_the_archive_title();
endif;

/* DEFAULT CONDITIONAL TITLE */
if ( is_home() && ! is_front_page() ) :
	$wortex_page_title = get_the_title( get_option( 'page_for_posts' ) );
endif;

if ( '' !== $wortex_page_title ) :
	?>
	<div id="page-title">
		<div class="container">
			<h2>
				<?php
				echo wp_kses( $wortex_page_title, 'post' );
				?>
			</h2>
		</div>
	</div>
	<?php
endif;

?>
<div id="main-content" class="container">
	<div id="page-container" class="with-sidebar">
		<?php

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php

					if ( '' !== get_the_post_thumbnail() ) : // As recommended by the WP codex, has_post_thumbnail() is not reliable
						?>
						<div class="thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php
								the_post_thumbnail(
									'post-thumbnail',
									array(
										'class' => 'scale-with-grid',
									)
								);
								?>
							</a>
						</div>
						<?php
					endif;

					?>
					<div class="post-contents">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h3>

						<div class="postmetadata">
							<?php

							if ( 'post' === get_post_type() ) :

								?>
								<span class="meta-date published"><i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
								<?php
								// Echo updated date for hatom-feed - not to be displayed on front end
								?>
								<span class="updated"><?php the_modified_date( get_option( 'date_format' ) ); ?></span>
								<?php
								$author = sprintf(
									'<a class="fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
									esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
									// Translators: %s is the author's name
									esc_attr( sprintf( __( 'View all posts by %s', 'wortex-lite' ), get_the_author() ) ),
									get_the_author()
								);
								?>
								<span class="meta-author author vcard"><i class="fa fa-user"></i><span><?php esc_html_e( 'by', 'wortex-lite' ); ?></span><?php echo wp_kses_post( $author ); ?></span>
								<span class="meta-category"><i class="fa fa-tag"></i><?php the_category( ', ' ); ?></span>
								<?php

							endif;

							if ( comments_open() || '0' !== get_comments_number() ) :
								?>
								<span class="meta-comments"><i class="fa fa-comment"></i>
									<?php
									comments_popup_link(
										__( '0 Comment', 'wortex-lite' ),
										__( '1 Comment', 'wortex-lite' ),
										__( '% Comments', 'wortex-lite' ),
										'',
										__( 'Comments Off', 'wortex-lite' )
									);
									?>
								</span>
								<?php
							endif;

							edit_post_link( __( 'Edit', 'wortex-lite' ), '<span class="editlink"><i class="fa fa-pencil"></i>', '</span>' );

							?>
						</div>

						<div class="post-content">
							<?php
							if (
								get_post_format()
								|| post_password_required() ||
								'content' === get_theme_mod( 'wortex_blog_index_content' )
							) :
								the_content();
							else :
								the_excerpt();
							endif;
							?>
						</div>
						<?php

						if ( has_tag() ) :
							the_tags( '<div class="tags"><i class="fa fa-tags"></i>', '', '</div>' );
						endif;

						?>
					</div>
				</div>
				<hr />
				<?php

			endwhile;

		else : // If there is no post in the loop

			if ( is_search() ) : // Empty search results

				?>
				<h2><?php esc_html_e( 'Not Found', 'wortex-lite' ); ?></h2>
				<p>
					<?php
					printf(
						// Translators: %s is the search term
						esc_html__( 'Your search for "%s" did not return any result.', 'wortex-lite' ),
						get_search_query()
					);
					?>
					<br />
					<?php
					esc_html_e( 'Would you like to try another search ?', 'wortex-lite' );
					?>
				</p>
				<?php
				get_search_form();

			else : // Empty loop (this should never happen!)

			?>
			<h2><?php esc_html_e( 'Not Found', 'wortex-lite' ); ?></h2>
			<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'wortex-lite' ); ?></p>
			<?php

			endif;

		endif;

		if ( null !== get_next_posts_link() || null !== get_previous_posts_link() ) :
			?>
			<div class="page_nav">
				<?php

				if ( null !== get_next_posts_link() ) :
					?>
					<div class="previous navbutton"><?php next_posts_link( '<i class="fa fa-angle-left"></i> ' . __( 'Previous Posts', 'wortex-lite' ) ); ?></div>
					<?php
				endif;

				if ( null !== get_previous_posts_link() ) :
					?>
					<div class="next navbutton"><?php previous_posts_link( __( 'Next Posts', 'wortex-lite' ) . ' <i class="fa fa-angle-right"></i>' ); ?></div>
					<?php
				endif;

				?>
				<br class="clear" />
			</div>
			<?php
		endif;

		?>
	</div>

	<div id="sidebar-container">
		<?php get_sidebar(); ?>
	</div>

</div>
<?php

get_footer();
