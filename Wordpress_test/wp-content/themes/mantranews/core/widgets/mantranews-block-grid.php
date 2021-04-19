<?php
/**
 * Mantranews: Block Posts (Grid)
 *
 * Widget show block posts in grid layout
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'mantranews_register_block_grid_widget' );

function mantranews_register_block_grid_widget() {
	register_widget( 'Mantranews_Block_Grid' );
}

class Mantranews_Block_Grid extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'mantranews_block_grid',
			'description' => esc_html__( 'Display block posts in grid layout.', 'mantranews' )
		);
		parent::__construct( 'mantranews_block_grid', esc_html__( 'Grid Block Posts', 'mantranews' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {

		global $mantranews_grid_columns;
		$mantranews_category_dropdown = mantranews_category_dropdown();

		$fields = array(

			'mantranews_block_title' => array(
				'mantranews_widgets_name'       => 'mantranews_block_title',
				'mantranews_widgets_title'      => esc_html__( 'Block Title', 'mantranews' ),
				'mantranews_widgets_field_type' => 'text'
			),

			'mantranews_block_cat_id' => array(
				'mantranews_widgets_name'          => 'mantranews_block_cat_id',
				'mantranews_widgets_title'         => esc_html__( 'Category for Block Post', 'mantranews' ),
				'mantranews_widgets_default'       => 0,
				'mantranews_widgets_field_type'    => 'select',
				'mantranews_widgets_field_options' => $mantranews_category_dropdown
			),

			'mantranews_block_grid_column' => array(
				'mantranews_widgets_name'          => 'mantranews_block_grid_column',
				'mantranews_widgets_title'         => esc_html__( 'No. of Columns', 'mantranews' ),
				'mantranews_widgets_default'       => 2,
				'mantranews_widgets_field_type'    => 'select',
				'mantranews_widgets_field_options' => $mantranews_grid_columns
			),

			'mantranews_block_posts_count' => array(
				'mantranews_widgets_name'       => 'mantranews_block_posts_count',
				'mantranews_widgets_title'      => esc_html__( 'No. of Posts', 'mantranews' ),
				'mantranews_widgets_default'    => 4,
				'mantranews_widgets_field_type' => 'number'
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

		$mantranews_block_title       = empty( $instance['mantranews_block_title'] ) ? '' : $instance['mantranews_block_title'];
		$mantranews_block_cat_id      = intval( empty( $instance['mantranews_block_cat_id'] ) ? '' : $instance['mantranews_block_cat_id'] );
		$mantranews_block_grid_column = intval( empty( $instance['mantranews_block_grid_column'] ) ? 2 : $instance['mantranews_block_grid_column'] );
		$mantranews_block_posts_count = intval( empty( $instance['mantranews_block_posts_count'] ) ? 4 : $instance['mantranews_block_posts_count'] );
		echo $before_widget;
		?>
		<div class="block-grid-wrapper clearfix column-<?php echo esc_attr( $mantranews_block_grid_column ); ?>-layout">

			<?php mantranews_block_title( $mantranews_block_title, $mantranews_block_cat_id ); ?>

			<div class="block-posts-wrapper">
				<?php
				$block_grid_args  = mantranews_query_args( $mantranews_block_cat_id, $mantranews_block_posts_count );
				$block_grid_query = new WP_Query( $block_grid_args );
				if ( $block_grid_query->have_posts() ) {
					while ( $block_grid_query->have_posts() ) {
						$block_grid_query->the_post();
						?>
						<div class="single-post-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php the_post_thumbnail( 'mantranews-block-medium' ); ?></figure>
							</a>
							<div class="post-content-wrapper">

								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php mantranews_posted_on(); ?>
								</div>
								<?php do_action( 'mantranews_post_categories' ); ?>
							</div><!-- .post-meta-wrapper -->
						</div><!-- .single-post-wrapper -->
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div><!-- .block-posts-wrapper -->
		</div><!-- .block-grid-wrapper -->

		<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see     WP_Widget::update()
	 *
	 * @param   array $new_instance Values just sent to be saved.
	 * @param   array $old_instance Previously saved values from database.
	 *
	 * @uses    mantranews_widgets_updated_field_value()     defined in mantranews-widget-fields.php
	 *
	 * @return  array Updated safe values to be saved.
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
	 * @param   array $instance Previously saved values from database.
	 *
	 * @uses    mantranews_widgets_show_widget_field()       defined in mantranews-widget-fields.php
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
