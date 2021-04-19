<?php
/**
 * Mantranews: Block Layout
 *
 * Widget shows the posts in style 1
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'mantranews_register_block_layout_widget' );

function mantranews_register_block_layout_widget() {
	register_widget( 'Mantranews_Block_Layout' );
}

class Mantranews_Block_Layout extends WP_widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'mantranews_block_layout',
			'description' => esc_html__( 'Display posts in block layout', 'mantranews' )
		);
		parent::__construct( 'mantranews_block_layout', esc_html__( 'Block Layout', 'mantranews' ), $widget_ops );
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	private function widget_fields() {
		$mantranews_category_dropdown           = mantranews_category_dropdown();
		$mantranews_tags_dropdown               = mantranews_tags_dropdown();
		$mantranews_category_dropdown_parameter = mantranews_category_dropdown_parameter();
		$mantranews_tag_dropdown_parameter      = mantranews_tags_dropdown_parameter();


		$fields = array(

			'mantranews_block_title' => array(
				'mantranews_widgets_name'       => 'mantranews_block_title',
				'mantranews_widgets_title'      => esc_html__( 'Block Title', 'mantranews' ),
				'mantranews_widgets_field_type' => 'text'
			),

			'mantranews_block_cat_id'             => array(
				'mantranews_widgets_name'           => 'mantranews_block_cat_id',
				'mantranews_widgets_title'          => esc_html__( 'Category for Block Layout', 'mantranews' ),
				'mantranews_widgets_default'        => 0,
				'mantranews_widgets_field_type'     => 'select',
				'mantranews_widgets_field_options'  => $mantranews_category_dropdown,
				'mantranews_widgets_field_multiple' => true,

			),
			'mantranews_block_category_parameter' => array(
				'mantranews_widgets_name'          => 'mantranews_block_category_parameter',
				'mantranews_widgets_title'         => esc_html__( 'Category Parameters for Block Layout', 'mantranews' ),
				'mantranews_widgets_default'       => 1,
				'mantranews_widgets_field_type'    => 'select',
				'mantranews_widgets_field_options' => $mantranews_category_dropdown_parameter,
			),
			'mantranews_block_tags'               => array(
				'mantranews_widgets_name'           => 'mantranews_block_tags',
				'mantranews_widgets_title'          => esc_html__( 'Tags for Block Layout', 'mantranews' ),
				'mantranews_widgets_default'        => 0,
				'mantranews_widgets_field_type'     => 'select',
				'mantranews_widgets_field_options'  => $mantranews_tags_dropdown,
				'mantranews_widgets_field_multiple' => true,

			),
			'mantranews_block_tags_parameter'     => array(
				'mantranews_widgets_name'          => 'mantranews_block_tags_parameter',
				'mantranews_widgets_title'         => esc_html__( 'Tags Parameters for Block Layout', 'mantranews' ),
				'mantranews_widgets_default'       => 1,
				'mantranews_widgets_field_type'    => 'select',
				'mantranews_widgets_field_options' => $mantranews_tag_dropdown_parameter,
			),

			'mantranews_block_posts_count' => array(
				'mantranews_widgets_name'       => 'mantranews_block_posts_count',
				'mantranews_widgets_title'      => esc_html__( 'No. of Posts', 'mantranews' ),
				'mantranews_widgets_default'    => 5,
				'mantranews_widgets_field_type' => 'number'
			),
			'mantranews_block_layout'      => array(
				'mantranews_widgets_name'          => 'mantranews_block_layout',
				'mantranews_widgets_title'         => __( 'Layout Style', 'mantranews' ),
				'mantranews_widgets_default'       => 'layout1',
				'mantranews_widgets_field_type'    => 'selector',
				'mantranews_widgets_field_options' => array(
					'layout1' => esc_url( get_template_directory_uri() . '/assets/images/block-layout1.png' ),
					'layout2' => esc_url( get_template_directory_uri() . '/assets/images/block-layout2.png' ),
					'layout3' => esc_url( get_template_directory_uri() . '/assets/images/block-layout3.png' ),
					'layout4' => esc_url( get_template_directory_uri() . '/assets/images/alternate-block.png' )
				)
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
		$mantranews_block_title              = empty( $instance['mantranews_block_title'] ) ? '' : $instance['mantranews_block_title'];
		$mantranews_block_posts_count        = intval( empty( $instance['mantranews_block_posts_count'] ) ? 5 : $instance['mantranews_block_posts_count'] );
		$mantranews_block_cat_id             = isset( $instance['mantranews_block_cat_id'] ) ? is_array( $instance['mantranews_block_cat_id'] ) ? array_map( 'absint', wp_unslash( $instance['mantranews_block_cat_id'] ) ) : absint( $instance['mantranews_block_cat_id'] ) : 0;
		$mantranews_block_category_parameter = intval( ! isset( $instance['mantranews_block_category_parameter'] ) ? 1 : $instance['mantranews_block_category_parameter'] );
		$mantranews_block_tags               = isset( $instance['mantranews_block_tags'] ) ? is_array( $instance['mantranews_block_tags'] ) ? array_map( 'absint', wp_unslash( $instance['mantranews_block_tags'] ) ) : absint( $instance['mantranews_block_tags'] ) : 0;
		$mantranews_block_tags_parameter     = intval( ! isset( $instance['mantranews_block_tags_parameter'] ) ? 1 : $instance['mantranews_block_tags_parameter'] );
		$mantranews_block_layout             = empty( $instance['mantranews_block_layout'] ) ? 'layout1' : esc_html( $instance['mantranews_block_layout'] );

		echo $before_widget;
		?>
		<div class="block-layout-wrapper">
			<?php
			$mantranews_block_cat_id_for_title = is_array( $mantranews_block_cat_id ) ? count( $mantranews_block_cat_id ) === 1 ? $mantranews_block_cat_id[0] : null : $mantranews_block_cat_id;
			if ( $mantranews_block_category_parameter === 3 ) {
				$mantranews_block_cat_id_for_title = null;
			}
			mantranews_block_title( $mantranews_block_title, $mantranews_block_cat_id_for_title ); ?>
			<?php
			switch ( $mantranews_block_layout ) {
				case 'layout2':
					$this->mantranews_block_layout_2( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
					break;

				case 'layout3':
					$this->mantranews_block_layout_3( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
					break;

				case 'layout4':
					$this->mantranews_block_layout_4( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
					break;

				default:
					$this->mantranews_block_layout_default( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
					break;
			}
			?>


		</div><!-- .block-layout-wrapper-->
		<?php
		echo $after_widget;
	}

	public function mantranews_block_layout_2( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mb-column-wrapper <?php echo esc_attr( $mantranews_block_layout ); ?>">
			<?php
			$block_layout_args  = mantranews_query_args( $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			$total_post_left    = $total_posts_count > 0 ? ceil( $total_posts_count / 2 ) : 0;
			$total_post_right   = $total_posts_count - $total_post_left;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {

					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-medium' );
						echo '<div class="left-column-wrapper block-posts-block list-posts-block mb-column-2">';
					} elseif ( $post_count <= $total_post_left ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
					} elseif ( $post_count == ( $total_post_left + 1 ) ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-medium' );
						echo '<div class="right-column-wrapper block-posts-block list-posts-block mb-column-2">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == ( $total_post_left + 1 ) || $post_count == 1 ) {
								do_action( 'mantranews_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post-meta-wrapper">
								<?php mantranews_posted_on(); ?>
								<?php mantranews_post_comment(); ?>
							</div>
							<?php if ( $post_count == ( $total_post_left + 1 ) || $post_count == 1 ) {
								the_excerpt();
							} ?>
						</div><!-- .post-meta-wrapper -->
					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count == $total_post_left || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function mantranews_block_layout_default( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mb-column-wrapper <?php echo esc_attr( $mantranews_block_layout ); ?>">
			<?php
			$block_layout_args  = mantranews_query_args( $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-medium' );
						echo '<div class="left-column-wrapper block-posts-block grid-posts-block mb-column-2">';
					} elseif ( $post_count == 2 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						echo '<div class="right-column-wrapper block-posts-block list-posts-block mb-column-2">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == 1 ) {
								do_action( 'mantranews_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post-meta-wrapper">
								<?php mantranews_posted_on(); ?>
								<?php mantranews_post_comment(); ?>
							</div>
							<?php if ( $post_count == 1 ) {
								the_excerpt();
							} ?>
						</div><!-- .post-meta-wrapper -->
					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count == 1 || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function mantranews_block_layout_3( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mb-column-wrapper <?php echo esc_attr( $mantranews_block_layout ); ?>">
			<?php
			$block_layout_args  = mantranews_query_args( $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count == 1 ) {
						$post_class = 'primary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-slider-large' );
						echo '<div class="top-column-wrapper block-posts-block grid-posts-block mb-column-1">';
					} elseif ( $post_count % 3 == 2 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						echo '<div class="bottom-column-wrapper block-posts-block list-posts-block mb-column-1">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>
					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<div class="post-thumb-wrapper">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<figure><?php echo $image_path; ?></figure>
							</a>
						</div><!-- .post-thumb-wrapper -->
						<div class="post-content-wrapper">
							<?php if ( $post_count == 1 ) {
								do_action( 'mantranews_post_categories' );
							} ?>
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post-meta-wrapper">
								<?php mantranews_posted_on(); ?>
								<?php mantranews_post_comment(); ?>
							</div>
							<?php if ( $post_count == 1 ) {
								the_excerpt();
							} ?>
						</div><!-- .post-meta-wrapper -->
					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count == 1 || ( $post_count % 3 == 1 && $post_count > 2 ) || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
	}

	public function mantranews_block_layout_4( $mantranews_block_layout, $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter ) {
		?>
		<div class="block-posts-wrapper clearfix mb-column-wrapper <?php echo esc_attr( $mantranews_block_layout ); ?>">
			<?php
			$block_layout_args  = mantranews_query_args( $mantranews_block_cat_id, $mantranews_block_posts_count, $mantranews_block_category_parameter, $mantranews_block_tags, $mantranews_block_tags_parameter );
			$block_layout_query = new WP_Query( $block_layout_args );
			$post_count         = 0;
			$total_posts_count  = $block_layout_query->post_count;
			if ( $block_layout_query->have_posts() ) {
				while ( $block_layout_query->have_posts() ) {
					$block_layout_query->the_post();
					$post_count ++;
					$post_id = get_the_ID();
					if ( $post_count % 3 == 1 ) {
						$post_class = 'secondary-post';
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						echo '<div class="bottom-column-wrapper block-posts-block list-posts-block mb-column-1">';
					} else {
						$image_path = get_the_post_thumbnail( $post_id, 'mantranews-block-thumb' );
						$post_class = 'secondary-post';
					}
					?>

					<div class="single-post-wrapper clearfix <?php echo esc_attr( $post_class ); ?>">
						<?php
 						if ( $post_count % 3 == 1 || wp_is_mobile() ) { ?>
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php mantranews_posted_on(); ?>
									<?php mantranews_post_comment(); ?>
								</div>
								<?php
								echo mantranews_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->

						<?php } else if ( $post_count % 3 == 2 ) { ?>
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php mantranews_posted_on(); ?>
									<?php mantranews_post_comment(); ?>
								</div>
								<?php
								echo mantranews_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->

						<?php } else { ?>
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<figure><?php echo $image_path; ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="post-content-wrapper">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php mantranews_posted_on(); ?>
									<?php mantranews_post_comment(); ?>
								</div>
								<?php
								echo mantranews_post_excerpt( get_the_content(), 100 );
								?>
							</div><!-- .post-meta-wrapper -->
						<?php } ?>


					</div><!-- .single-post-wrapper -->
					<?php
					if ( $post_count % 3 == 0 || $post_count == $total_posts_count ) {
						echo '</div>';
					}
				}
			}
			?>
		</div><!-- .block-posts-wrapper -->
		<?php
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
