<?php if ( is_active_sidebar( 'header' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'header' ); ?>>

		<?php dynamic_sidebar( 'header' ); // Displays the header sidebar. ?>

	</aside><!-- #sidebar-header -->

<?php endif; // End widgets check. ?>