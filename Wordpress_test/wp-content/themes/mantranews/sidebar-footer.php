<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */

if( !is_active_sidebar( 'mantranews_footer_one' ) &&
	!is_active_sidebar( 'mantranews_footer_two' ) &&
    !is_active_sidebar( 'mantranews_footer_three' ) &&
    !is_active_sidebar( 'mantranews_footer_four' ) ) {
	return;
}
$mantranews_footer_layout = get_theme_mod( 'footer_widget_option', 'column3' );
?>
<div id="top-footer" class="footer-widgets-wrapper clearfix  <?php echo esc_attr( $mantranews_footer_layout ); ?>">
	<div class="mb-container">
		<div class="footer-widgets-area clearfix">
            <div class="mb-footer-widget-wrapper clearfix">
            		<div class="mb-first-footer-widget mb-footer-widget">
            			<?php
                			dynamic_sidebar( 'mantranews_footer_one' );

            			?>
            		</div>
        		<?php if( $mantranews_footer_layout != 'column1' ){ ?>
                    <div class="mb-second-footer-widget mb-footer-widget">
            			<?php
                			dynamic_sidebar( 'mantranews_footer_two' );

            			?>
            		</div>
                <?php } ?>
                <?php if( $mantranews_footer_layout == 'column3' || $mantranews_footer_layout == 'column4' ){ ?>
                    <div class="mb-third-footer-widget mb-footer-widget">
                       <?php
                           dynamic_sidebar( 'mantranews_footer_three' );
                       ?>
                    </div>
                <?php } ?>
                <?php if( $mantranews_footer_layout == 'column4' ){ ?>
                    <div class="mb-fourth-footer-widget mb-footer-widget">
                       <?php
							dynamic_sidebar( 'mantranews_footer_four' );
                       ?>
                    </div>
                <?php } ?>
            </div><!-- .mb-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
	</div><!-- .nt-container -->
</div><!-- #top-footer -->
