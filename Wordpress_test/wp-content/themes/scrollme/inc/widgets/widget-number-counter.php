<?php
/**
 * Scrollme Number Counter Widgets
 *
 * @package scrollme
 */

add_action( 'widgets_init', 'scrollme_register_number_counter_widgets' );
function scrollme_register_number_counter_widgets() {
    register_widget( 'WP_Scrollme_Number_Counter' );
}

class WP_Scrollme_Number_Counter extends WP_Widget {

    /* Register Widget with WordPress */
    function __construct() {
        parent::__construct(
            'scrollme-number-counter',
            __( 'AP: Number Counter', 'scrollme' ),
            array( 'classname' => 'scrollme-number-counter', 'description' => __( 'Number Animation Conter', 'scrollme' ) )
        );
    }
    
    /**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			'counter_title' => array(
                'scrollme_widgets_name' => 'counter_title',
                'scrollme_widgets_title' => __('Title','scrollme'),
                'scrollme_widgets_field_type' => 'text'
            ),
            'counter' => array(
                'scrollme_widgets_name' => 'counter',
                'scrollmec_widgets_title' => __('Counter','scrollme'),
                'scrollme_widgets_field_type' => 'number'
            ),
		);
		
		return $fields;
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
        echo wp_kses_post($args['before_widget']);
        echo '<div class="counter-container">';
        
        $title     = isset( $instance['counter_title'] ) ? esc_attr( $instance['counter_title'] ) : '';
        $counter     = isset( $instance['counter'] ) ? absint( $instance['counter'] ) : 0;
        ?>
            <div class="counter-wrap widget_scrollme-number-counter clearfix">
                <div class="counter-text"><?php echo esc_html($title); ?></div>
                <div class="counter-img clearfix">
                    <input type="text" data-width="100" data-fgColor="#df2c45" data-bgColor="#212c35" data-height="50" value="0" data-number="<?php echo esc_html($counter); ?>" min="0" max="100" class="ak-counter clearfix">
                </div>
            </div>
        <?php
        echo '</div>';
        echo wp_kses_post($args['after_widget']);
    }


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title     = isset( $instance['counter_title'] ) ? esc_attr( $instance['counter_title'] ) : '';
        $counter     = isset( $instance['counter'] ) ? absint( $instance['counter'] ) : 0;
        ?>
            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'counter_title' )); ?>">
            <?php esc_html__('Counter Title', 'scrollme'); ?>
            </label>
            
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'counter_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'counter_title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" />
            </p>

            <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'counter' )); ?>">
            <?php esc_html__('Counter Number', 'scrollme'); ?>
            </label>
            
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'counter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'counter' )); ?>" type="number" value="<?php echo esc_html($counter); ?>" />
            </p>

            <div class="startKnob" style="display: none;"><?php esc_html__( 'start', 'scrollme' ); ?></div>

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
        
        $instance['counter_title']= sanitize_text_field( $new_instance['counter_title']);
        $instance['counter']= absint($new_instance['counter']);
        return $instance;
    }

}