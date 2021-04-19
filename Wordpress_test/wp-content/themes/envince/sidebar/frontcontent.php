<?php if ( is_active_sidebar( 'frontcontent' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'frontcontent' ); ?>>

		<?php dynamic_sidebar( 'frontcontent' ); // Displays the frontcontent sidebar. ?>

	</aside><!-- #sidebar-frontcontent -->

<?php endif; // End widgets check. ?>