<?php

/**
 * Top Categories widget.
 */


if( ! class_exists('Purea_Magazine_Top_Categories_Widget')) :

class Purea_Magazine_Top_Categories_Widget extends WP_Widget {

	var $defaults;
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'purea_magazine_top_categories_widget', // Base ID
			esc_html__( 'Purea Magazine: Top Categories Widget', 'purea-magazine' ), // Name
			array( 'description' => esc_html__( 'Adds list of top categories to the left or right sidebar in Purea Magazine WordPress theme. ', 'purea-magazine'), ) // Args
		);		     
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( wp_parse_args( $instance, $this->defaults ) ); 

		$no_of_posts = ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 3;
		$section_title = ! empty( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : '';

		?>

		<div class="top-categories widget">
			<div class="top-categories-wrapper">
				<?php 
					if(!empty($section_title) ) { 
						?>
							<h4 class="section-title">
								<?php echo $section_title; ?>
							</h4>
						<?php 
					} 
				?>
				<div class="top-categories-lists-wrapper">
					<div class="top-categories-content">
						<ul class="top-categories-content-lists">
							<?php
								wp_list_categories('number='.$no_of_posts.'&show_count=1&orderby=count&order=DESC&title_li=');
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
    }
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	    $no_of_posts = ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 3;
		$section_title = ! empty( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : '';
	    ?>     	  	    	
		    <p>
		        <label for="<?php echo esc_attr($this->get_field_id('section_title')); ?>"><?php esc_html_e('Title:','purea-magazine'); ?></label>
		        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('section_title')); ?>" name="<?php echo esc_attr($this->get_field_name('section_title')); ?>" type="text" value="<?php echo esc_attr($section_title); ?>" />
		    </p>
		    <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'no_of_posts' )); ?>"><?php esc_html_e( 'Number of posts:', 'purea-magazine' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('no_of_posts')); ?>" type="text" value="<?php echo absint( $no_of_posts ); ?>">
			</p>
    	<?php
         
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;	
		$instance['no_of_posts'] = absint( $new_instance['no_of_posts'] );
		$instance['section_title'] = sanitize_text_field( $new_instance['section_title'] );
    	return $instance;
	}

}
endif;

if( ! function_exists('purea_magazine_register_top_categories_widget')) :
// register widget
function purea_magazine_register_top_categories_widget() {
    register_widget( 'Purea_Magazine_Top_Categories_Widget' );
}
endif;

add_action( 'widgets_init', 'purea_magazine_register_top_categories_widget' );
