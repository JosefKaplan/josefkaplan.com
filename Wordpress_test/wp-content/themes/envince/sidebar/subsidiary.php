<?php
$footer_sidebar_count = get_theme_mod('envince_footer_widgets', '4');

if ( $footer_sidebar_count == 1 ) {
	$footer_sidebar_class = 'col-md-12';
} elseif ( $footer_sidebar_count == 2 ) {
	$footer_sidebar_class = 'col-md-6';
} elseif ( $footer_sidebar_count == 3 ) {
	$footer_sidebar_class = 'col-md-4';
} else {
	$footer_sidebar_class = 'col-md-3';
}

for ($i = 1; $i <=$footer_sidebar_count; $i++ ) {
?>
	<div class="footer-block <?php echo $footer_sidebar_class; ?>">
		<?php if ( is_active_sidebar( 'footer'.$i ) ) : // If the sidebar has widgets. ?>

		<aside <?php hybrid_attr( 'sidebar', 'subsidiary'.$i ); ?>>

			<?php dynamic_sidebar( 'footer'.$i ); // Displays the footer sidebar. ?>

		</aside><!-- #sidebar-footer -->

		<?php endif; // End widgets check. ?>
	</div>
<?php }