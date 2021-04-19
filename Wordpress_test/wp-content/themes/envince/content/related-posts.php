<?php $related_posts = envince_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ) : ?>

	<h4 class="related-posts-main-title">
		<i class="fa fa-thumbs-up"></i><span><?php esc_html_e( 'You May Also Like', 'envince' ); ?></span>
	</h4>

	<div class="related-posts row">

		<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
			<div class="col-md-4 col-sm-4">

				<?php if ( has_post_thumbnail() ): ?>
					<div class="related-posts-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'envince-small-grid' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="article-content">

					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3><!--/.post-title-->

					<div class="entry-byline">
						<i class="fa fa-user"></i>
						<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
						<i class="fa fa-calendar"></i>
						<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
					</div>

				</div>

			</div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>

	</div>
<?php endif; ?>
