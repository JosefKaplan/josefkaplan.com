<?php
/**
 * Mantranews: Homepage Carousel Widget
 *
 * Mantranews Carousel section
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'mantranews_register_post_carousel_widget' );

function mantranews_register_post_carousel_widget() {
	register_widget( 'Mantranews_Post_Carousel' );
}

class Mantranews_Post_Carousel extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'mantranews_post_carousel clearfix',
			'description' => esc_html__( 'Display carousel with posts.', 'mantranews' )
		);
		parent::__construct( 'mantranews_post_carousel', esc_html__( 'Carousel Posts', 'mantranews' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		$mantranews_category_dropdown = mantranews_category_dropdown();

		$fields = array(
			'mantranews_carousel_title'    => array(
				'mantranews_widgets_name'       => 'mantranews_carousel_title',
				'mantranews_widgets_title'      => esc_html__( 'Title', 'mantranews' ),
				'mantranews_widgets_field_type' => 'text'
			),
			'mantranews_carousel_category' => array(
				'mantranews_widgets_name'          => 'mantranews_carousel_category',
				'mantranews_widgets_title'         => esc_html__( 'Category for Slider', 'mantranews' ),
				'mantranews_widgets_default'       => 0,
				'mantranews_widgets_field_type'    => 'select',
				'mantranews_widgets_field_options' => $mantranews_category_dropdown
			),

			'mantranews_carousel_count'          => array(
				'mantranews_widgets_name'       => 'mantranews_carousel_count',
				'mantranews_widgets_title'      => esc_html__( 'No. of slides', 'mantranews' ),
				'mantranews_widgets_default'    => 5,
				'mantranews_widgets_field_type' => 'number'
			),
			'mantranews_carousel_autoplay_speed' => array(
				'mantranews_widgets_name'       => 'mantranews_carousel_autoplay_speed',
				'mantranews_widgets_title'      => esc_html__( 'Carousel Autoplay Speed ( in microsecond )', 'mantranews' ),
				'mantranews_widgets_default'    => 2200,
				'mantranews_widgets_field_type' => 'number'
			),

			'mantranews_carousel_category_random' => array(
				'mantranews_widgets_name'       => 'mantranews_carousel_category_random',
				'mantranews_widgets_title'      => esc_html__( 'Show Random', 'mantranews' ),
				'mantranews_widgets_default'    => 1,
				'mantranews_widgets_field_type' => 'checkbox',
			),


		);

		return $fields;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		if ( empty( $instance ) ) {
			return;
		}

		$mantranews_carousel_category_id     = intval( empty( $instance['mantranews_carousel_category'] ) ? null : $instance['mantranews_carousel_category'] );
		$mantranews_carousel_count           = intval( empty( $instance['mantranews_carousel_count'] ) ? 5 : $instance['mantranews_carousel_count'] );
		$mantranews_carousel_category_random = intval( empty( $instance['mantranews_carousel_category_random'] ) ? null : $instance['mantranews_carousel_category_random'] );
		$mantranews_carousel_autoplay_speed  = intval( empty( $instance['mantranews_carousel_autoplay_speed'] ) ? 2200 : $instance['mantranews_carousel_autoplay_speed'] );
		$mantranews_carousel_title           = empty( $instance['mantranews_carousel_title'] ) ? '' : $instance['mantranews_carousel_title'];

		echo $before_widget;

		$slider_args = mantranews_query_args( $mantranews_carousel_category_id, $mantranews_carousel_count );

		if ( 1 === $mantranews_carousel_category_random ) {
			$slider_args['orderby'] = 'rand';
		}
		$carousel_query = new WP_Query( $slider_args );
		if ( $carousel_query->have_posts() ) {

			wp_enqueue_style( 'owl-carousel2-style' );
			wp_enqueue_style( 'owl-carousel2-theme' );
			wp_enqueue_script( 'owl-carousel2-script' );

			?>
			<div class="widget-block-wrapper">
				<?php
				if ( ! empty( $mantranews_carousel_title ) ) {
					mantranews_block_title( $mantranews_carousel_title, '' );
				}
				?>
				<div class="owl-carousel owl-theme mantranews-carousel"
				     data-timer="<?php echo esc_attr( $mantranews_carousel_autoplay_speed ); ?>">

					<?php


					while ( $carousel_query->have_posts() ) {
						$carousel_query->the_post();
						?>
						<div class="item">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure
									class="carousel-image-wrap"><?php the_post_thumbnail( 'mantranews-carousel-image' ); ?></figure>
							</a>
							<div class="carousel-content-wrapper">
								<?php do_action( 'mantranews_post_categories' ); ?>

								<h3 class="carousel-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

							</div>
						</div>
						<?php
					}
					wp_reset_postdata();
					?>


				</div>
				<div style="clear:both"></div>
			</div>
		<?php } ?>
		<div style="clear:both"></div>


		<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see     WP_Widget::update()
	 *
	 * @param    array $new_instance Values just sent to be saved.
	 * @param    array $old_instance Previously saved values from database.
	 *
	 * @uses    mantranews_widgets_updated_field_value()        defined in mantranews-widget-fields.php
	 *
	 * @return    array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			extract( $widget_field );

			// Use helper function to get updated field values
            if (isset($new_instance[$mantranews_widgets_name])) {
                $instance[$mantranews_widgets_name] = mantranews_widgets_updated_field_value($widget_field, $new_instance[$mantranews_widgets_name]);
            } else {
                $instance[$mantranews_widgets_name] = mantranews_widgets_updated_field_value($widget_field, null);
            }
		}

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see     WP_Widget::form()
	 *
	 * @param    array $instance Previously saved values from database.
	 *
	 * @uses    mantranews_widgets_show_widget_field()        defined in mantranews-widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach ( $widget_fields as $widget_field ) {

			// Make array elements available as variables
			extract( $widget_field );
			$mantranews_widgets_field_value = ! empty( $instance[ $mantranews_widgets_name ] ) ? ( $instance[ $mantranews_widgets_name ] ) : '';
            $mantranews_widgets_field_value = is_string($mantranews_widgets_field_value) ? wp_kses_post($mantranews_widgets_field_value) : $mantranews_widgets_field_value;
            mantranews_widgets_show_widget_field( $this, $widget_field, $mantranews_widgets_field_value );
		}
	}

}
