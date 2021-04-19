<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * kurma_before_footer hook.
 *
 */
do_action( 'kurma_before_footer' );
?>

<div <?php kurma_footer_class(); ?>>
	<?php
	/**
	 * kurma_before_footer_content hook.
	 *
	 */
	do_action( 'kurma_before_footer_content' );

	/**
	 * kurma_footer hook.
	 *
	 *
	 * @hooked kurma_construct_footer_widgets - 5
	 * @hooked kurma_construct_footer - 10
	 */
	do_action( 'kurma_footer' );

	/**
	 * kurma_after_footer_content hook.
	 *
	 */
	do_action( 'kurma_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * kurma_after_footer hook.
 *
 */
do_action( 'kurma_after_footer' );

wp_footer();
?>

</body>
</html>
