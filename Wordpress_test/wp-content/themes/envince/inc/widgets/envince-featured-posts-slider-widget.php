<?php
/**
 * Featured post slider.
 */

class envince_featured_posts_slider_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_post_slider',
			'description' => __( 'Display latest posts or posts of specific category, which will be used as the slider.', 'envince' ),
		);
		$control_ops = array(
			'width'  => 200,
			'height' => 250,
		);
		parent::__construct( false, $name = __( 'TG: Featured Post Slider', 'envince' ), $widget_ops );
	}

	function form( $instance ) {
		$envince_defaults['number']         = 5;
		$envince_defaults['type']           = 'latest';
		$envince_defaults['category']       = '';
		$envince_defaults['child_category'] = '0';
		$instance                           = wp_parse_args( (array) $instance, $envince_defaults );
		$number                             = $instance['number'];
		$type                               = $instance['type'];
		$category                           = $instance['category'];
		$child_category                     = $instance['child_category'] ? 'checked="checked"' : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'envince' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php _e( 'Show latest Posts', 'envince' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php _e( 'Show posts from a category', 'envince' ); ?>
			<br />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'envince' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( 'category' ),
					'selected'         => $category,
				)
			);
			?>
		</p>

		<p>
			<input class="checkbox" <?php echo $child_category; ?> id="<?php echo $this->get_field_id( 'child_category' ); ?>" name="<?php echo $this->get_field_name( 'child_category' ); ?>" type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'child_category' ); ?>"><?php esc_html_e( 'Check to display the posts from child category of the chosen category.', 'envince' ); ?></label>
		</p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['number']         = absint( $new_instance['number'] );
		$instance['type']           = $new_instance['type'];
		$instance['category']       = $new_instance['category'];
		$instance['child_category'] = isset( $new_instance['child_category'] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$number         = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type           = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category       = isset( $instance['category'] ) ? $instance['category'] : '';
		$child_category = ! empty( $instance['child_category'] ) ? 'true' : 'false';

		if ( $type == 'latest' ) {
			$get_featured_posts = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'post_type'           => 'post',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
		} else {
			if ( $child_category == 'true' ) {
				$get_featured_posts = new WP_Query( array(
					'posts_per_page' => $number,
					'post_type'      => 'post',
					'cat'            => $category,
					'no_found_rows'  => true,
				) );
			} else {
				$get_featured_posts = new WP_Query( array(
					'posts_per_page' => $number,
					'post_type'      => 'post',
					'category__in'   => $category,
					'no_found_rows'  => true,
				) );
			}
		}
		echo $before_widget;
		?>
		<div class="envince-featured-post-slider clearfix">
			<div class="envince-slider-inner-wrapper">
				<?php
				$slide_counter = 0;
				while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
					$slide_counter ++;
					if ( $slide_counter % 5 == 1 ) {
						?>
						<div class="single-section">
						<div class="big-grid-post col-md-6 col-xs-12">
							<article <?php hybrid_attr( 'post' ); ?>>
								<header class="post-header">
									<?php
									if ( has_post_thumbnail() ) {
										$image           = '';
										$title_attribute = get_the_title( $post->ID );
										$image_id        = get_post_thumbnail_id( get_the_ID() );
										$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
										$image_alt_text  = ! empty( $image_alt ) ? $image_alt : $title_attribute;
										$image           .= '<figure class="slider-featured-image">';
										$image           .= '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title( '', '', false ) . '">';
										$image           .= get_the_post_thumbnail( $post->ID, 'envince-big-grid', array(
												'title' => esc_attr( $title_attribute ),
												'alt'   => esc_attr( $image_alt_text ),
											) ) . '</a>';
										$image           .= '</figure>';
										echo $image;
									} else { ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider-featured-image.png">
										</a>
									<?php }
									?>
									<?php envince_colored_category(); ?>
									<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
								</header>
							</article>
						</div>
					<?php } else {
						if ( $slide_counter % 5 == 2 ) {
							echo '<div class="small-grid-wrapper col-md-6 col-xs-12">';
						}
						?>
						<div class="small-grid-post col-md-6 col-xs-6">
							<article <?php hybrid_attr( 'post' ); ?>>
								<header class="post-header">
									<?php
									if ( has_post_thumbnail() ) {
										$image           = '';
										$title_attribute = get_the_title( $post->ID );
										$image           .= '<figure class="slider-featured-image">';
										$image           .= '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title( '', '', false ) . '">';
										$image           .= get_the_post_thumbnail( $post->ID, 'envince-small-grid', array(
												'title' => esc_attr( $title_attribute ),
												'alt'   => esc_attr( $title_attribute ),
											) ) . '</a>';
										$image           .= '</figure>';
										echo $image;
									} else { ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider-featured-image.png">
										</a>
									<?php }
									?>
									<?php envince_colored_category(); ?>
									<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
								</header>
							</article>
						</div>
						<?php
						if ( $slide_counter % 5 == 0 ) {
							echo "</div>";
						} // wrapper for small grid
					}
					if ( $slide_counter % 5 == 0 ) { ?>
						</div>
						<?php
					}
				endwhile;
				// Reset Post Data
				wp_reset_query();
				?>
			</div>
		</div>
		<?php echo $after_widget;
	}
}
