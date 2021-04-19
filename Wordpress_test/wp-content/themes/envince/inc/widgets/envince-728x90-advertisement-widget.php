<?php
/**
 * 728x90 Advertisement Widget
 */

class envince_728x90_advertisement_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_728x90_advertisement',
			'description' => __( 'Add your Advertisement here', 'envince' ),
		);

		$control_ops = array(
			'width'  => 200,
			'height' => 250,
		);

		parent::__construct( false, $name = __( 'TG: Advertisement', 'envince' ), $widget_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance,
			array(
				'title'             => '',
				'728x90_image_url'  => '',
				'728x90_image_link' => '',
			)
		);

		$title      = esc_attr( $instance['title'] );
		$image_link = '728x90_image_link';
		$image_url  = '728x90_image_url';

		$instance[ $image_link ] = esc_url( $instance[ $image_link ] );
		$instance[ $image_url ]  = esc_url( $instance[ $image_url ] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'envince' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<label><?php _e( 'Add your Advertisement 728x90 Images Here', 'envince' ); ?></label>
		<p>
			<label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'envince' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[ $image_link ]; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'envince' ); ?></label>

		<div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
			<div class="custom_media_preview">
				<?php if ( $instance[ $image_url ] != '' ) : ?>
					<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="margin-top:5px;" />
			<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'envince' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'envince' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'envince' ); ?></button>
		</div>
		</p>

	<?php }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$image_link        = '728x90_image_link';
		$image_url         = '728x90_image_url';

		$instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
		$instance[ $image_url ]  = esc_url_raw( $new_instance[ $image_url ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		$image_link = '728x90_image_link';
		$image_url  = '728x90_image_url';

		$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
		$image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

		echo $before_widget; ?>

		<div class="advertisement_728x90">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="advertisement-title">
					<?php echo $before_title . esc_html( $title ) . $after_title; ?>
				</div>
			<?php }
			$output = '';
			if ( ! empty( $image_url ) ) {
				$output .= '<div class="advertisement-content">';
				if ( ! empty( $image_link ) ) {
					$output .= '<a href="' . $image_link . '" class="single_ad_728x90" target="_blank">
								<img src="' . $image_url . '" />
							</a>';
				} else {
					$attachment_post_id = attachment_url_to_postid( $image_url );
					$image_alt          = get_post_meta( $attachment_post_id, '_wp_attachment_image_alt', true );
					$image_alt_text     = ! empty( $image_alt ) ? $image_alt : $title;
					$output             .= '<img src="' . $image_url . '" alt="' . $image_alt_text . '" />';
				}
				$output .= '</div>';
				echo $output;
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}
}
