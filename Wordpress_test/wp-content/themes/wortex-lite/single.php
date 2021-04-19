<?php
/**
 *
 * Wortex Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2014-2020 Iceable Themes - https://www.iceablethemes.com
 *
 * Single Post Template
 *
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		?>
		<div id="page-title">
			<div class="container">
				<h2><?php the_title(); ?></h2>
				<div class="postmetadata">
					<span class="meta-date"><i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
					<?php
					$author = sprintf( ' <a href="%1$s" title="%2$s" rel="author">%3$s</a>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						// Translators: %s is the author's name
						esc_attr( sprintf( __( 'View all posts by %s', 'wortex-lite' ), get_the_author() ) ),
						get_the_author()
					);
					?>
					<span class="meta-author"><i class="fa fa-user"></i><span><?php esc_html_e( 'by', 'wortex-lite' ); ?></span><?php echo wp_kses_post( $author ); ?></span>
					<span class="meta-category"><i class="fa fa-tag"></i><?php the_category( ', ' ); ?></span>
					<?php
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
			</div>
		</div>

		<div id="main-content" class="container">
			<div id="page-container" class="left with-sidebar">
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
					<?php

					// The post title and meta data displayed on the front end are outside of the hentry div by design.
					// Repeating the structured data here, inside .hentry div, to respect hAtom standards
					// This div will not be displayed on the front end.
					?>
					<div class="hatom-feed">
						<span class="entry-title"><?php the_title(); ?></span>
						<span class="published"><?php the_time( get_option( 'date_format' ) ); ?></span>
						<span class="updated"><?php the_modified_date( get_option( 'date_format' ) ); ?></span>
						<span class="meta-author author vcard"><span class="fn"><?php the_author(); ?></a></span>
					</div>
					<?php

					if ( '' !== get_the_post_thumbnail() ) : // As recommended by the WP codex, has_post_thumbnail() is not reliable
						?>
						<div class="thumbnail">
							<?php
							the_post_thumbnail(
								'large',
								array(
									'class' => 'scale-with-grid',
								)
							);
							?>
						</div>
						<?php
					endif;

					?>
					<div class="post-contents">
						<?php

						the_content();

						wp_link_pages(
							array(
								'before'           => '<br class="clear" /><div class="paged_nav">' . __( 'Pages:', 'wortex-lite' ),
								'after'            => '</div>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'next_or_number'   => 'number',
								'nextpagelink'     => __( 'Next page', 'wortex-lite' ),
								'previouspagelink' => __( 'Previous page', 'wortex-lite' ),
								'pagelink'         => '%',
								'echo'             => 1,
							)
						);

						if ( has_tag() ) :
							the_tags( '<div class="tags"><span class="the-tags">' . __( 'Tags', 'wortex-lite' ) . ':</span>', '', '</div>' );
						endif;

						?>
					</div>
				</div>

				<div class="article_nav">
					<?php
					if ( '' !== get_adjacent_post( false, '', false ) ) : // Is there a previous post?
						?>
						<div class="next navbutton"><?php next_post_link( '%link', __( 'Next Post', 'wortex-lite' ) . ' <i class="fa fa-angle-right"></i>' ); ?></div>
						<?php
					endif;

					if ( '' !== get_adjacent_post( false, '', true ) ) : // Is there a next post?
						?>
						<div class="previous navbutton"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> ' . __( 'Previous Post', 'wortex-lite' ) ); ?></div>
						<?php
					endif;

					?>
					<br class="clear" />
				</div>
				<?php

				// Display comments section only if comments are open or if there are comments already.
				if ( comments_open() || '0' !== get_comments_number() ) :
					?>
					<hr />
					<div class="comments">
						<?php comments_template( '', true ); ?>
					</div>

					<div class="article_nav">
						<?php
						if ( is_attachment() ) : // Use image navigation links on attachment pages
							if ( wortex_adjacent_image_link( false ) ) : // Is there a previous image ?
								?>
								<div class="previous"><?php previous_image_link( 0, __( 'Previous Image', 'wortex-lite' ) ); ?></div>
								<?php
							endif;
							if ( wortex_adjacent_image_link( true ) ) : // Is there a next image ?
								?>
								<div class="next"><?php next_image_link( 0, __( 'Next Image','wortex-lite' ) ); ?></div>
								<?php
							endif;
						else : // post navigation
							if ( '' !== get_adjacent_post( false, '', false ) ) : // Is there a previous post?
								?>
								<div class="next navbutton"><?php next_post_link( '%link', __( 'Next Post', 'wortex-lite' ) . ' <i class="fa fa-angle-right"></i>' ); ?></div>
								<?php
							endif;
							if ( '' !== get_adjacent_post( false, '', true ) ) : // Is there a next post?
								?>
								<div class="previous navbutton"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> ' . __( 'Previous Post', 'wortex-lite' ) ); ?></div>
								<?php
							endif;
						endif;
						?>
						<br class="clear" />
					</div>
					<?php
				endif;
				?>
			</div>
			<?php

	endwhile;

else : // Empty loop (this should never happen!)

	?>
	<div id="main-content" class="container">
		<div id="page-container" class="left with-sidebar">

		<h2><?php esc_html_e( 'Not Found', 'wortex-lite' ); ?></h2>
		<p><?php esc_html_e( 'What you are looking for isn\'t here...', 'wortex-lite' ); ?></p>

		</div>
	<?php

endif;


	?>
	<div id="sidebar-container">
		<?php get_sidebar(); ?>
	</div>

</div>
<?php

get_footer();
