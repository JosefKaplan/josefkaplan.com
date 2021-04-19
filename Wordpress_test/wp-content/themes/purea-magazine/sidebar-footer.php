<?php
/**
 *
 * @package purea-magazine
 */

//Return if the first widget area has no widgets
if ( !is_active_sidebar( 'footer-1' ) ) {
	return;
} ?>

<?php //user selected widget columns

	$purea_magazine_widget_num = esc_html(get_theme_mod('purea_magazine_footer_widgets', '4'));

	if ($purea_magazine_widget_num == '4') {
		$purea_mag_cols = 'col-md-3';		
	} elseif ($purea_magazine_widget_num == '3') {
		$purea_mag_cols = 'col-md-4';
	} elseif ($purea_magazine_widget_num == '2') {
		$purea_mag_cols = 'col-md-6';
	} else {
		$purea_mag_cols = 'col-md-12';
	}
?>
		
<?php 
	if ( is_active_sidebar( 'footer-1' ) ){
		?>
			<div class="widget-column <?php echo esc_attr($purea_mag_cols); ?>">
				<?php dynamic_sidebar( 'footer-1'); ?>
			</div>
		<?php
	}
	if ( is_active_sidebar( 'footer-2' ) ){
		?>
			<div class="widget-column <?php echo esc_attr($purea_mag_cols); ?>">
				<?php dynamic_sidebar( 'footer-2'); ?>
			</div>
		<?php
	}
	if ( is_active_sidebar( 'footer-3' ) ){
		?>
			<div class="widget-column <?php echo esc_attr($purea_mag_cols); ?>">
				<?php dynamic_sidebar( 'footer-3'); ?>
			</div>
		<?php
	}
	if ( is_active_sidebar( 'footer-4' ) ){
		?>
			<div class="widget-column <?php echo esc_attr($purea_mag_cols); ?>">
				<?php dynamic_sidebar( 'footer-4'); ?>
			</div>
		<?php
	}
?>