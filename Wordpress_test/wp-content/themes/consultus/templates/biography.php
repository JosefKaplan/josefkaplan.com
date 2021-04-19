<?php
/**
 * The template part for displaying an Author biography
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 */
		$consultus_author_bio_avatar_size = apply_filters( 'consultus_author_bio_avatar_size', 42 );

		echo wp_kses_post(get_avatar( get_the_author_meta( 'user_email' ), $consultus_author_bio_avatar_size ));
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title"><span class="author-heading"><?php esc_html_e( 'Author:', 'consultus' ); ?></span> <?php echo esc_html(get_the_author()); ?></h2>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'consultus' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->