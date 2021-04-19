<?php
/**
 * The Left sidebar containing the main widget area.
 *
 * @package scrollme
 */

if ( ! is_active_sidebar( 'scrollme-sidebar-left' ) ) {
    return;
}
?>

<?php if( scrollme_get_sidebar_layout() == "left_sidebar" ) : ?>
    <div id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'scrollme-sidebar-left' ); ?>
    </div><!-- #secondary -->
<?php endif; 