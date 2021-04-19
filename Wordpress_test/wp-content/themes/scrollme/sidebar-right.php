<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package scrollme
 */

if ( ! is_active_sidebar( 'scrollme-sidebar-right' ) ) {
    return;
}
?>
<?php
	$woo_page = scrollme_is_realy_woocommerce_page();
?>
<?php if( scrollme_get_sidebar_layout() == "right_sidebar" || $woo_page ) : ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'scrollme-sidebar-right' ); ?>
    </div><!-- #secondary -->
<?php endif; 