<article <?php hybrid_attr( 'post' ); ?>>

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link(); ?>
	</footer><!-- .entry-footer -->

</article><!-- .entry -->