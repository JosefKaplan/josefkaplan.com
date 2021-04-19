<?php if ( is_active_sidebar( 'fronttop' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'fronttop' ); ?>>

		<?php dynamic_sidebar( 'fronttop' ); // Displays the fronttop sidebar. ?>

	</aside><!-- #sidebar-fronttop -->

<?php endif; // End widgets check. ?>