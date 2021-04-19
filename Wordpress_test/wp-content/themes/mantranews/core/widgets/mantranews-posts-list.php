<?php
/**
 * Mantranews: Posts List
 *
 * Widget show latest or random posts in list view
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action( 'widgets_init', 'mantranews_register_posts_list_widget' );

function mantranews_register_posts_list_widget() {
	register_widget( 'Mantranews_Posts_List' );
}

class Mantranews_Posts_List extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'mantranews_posts_list',
            'description' => esc_html__( 'Display latest or random posts in list view.', 'mantranews' )
        );
        parent::__construct( 'mantranews_posts_list', esc_html__( 'Posts Lists', 'mantranews' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

    	$mantranews_post_list_option = array(
    					'latest' => esc_html__( 'Latest Posts', 'mantranews' ),
    					'random' => esc_html__( 'Random Posts', 'mantranews' )
    					);

        $fields = array(

            'mantranews_block_title' => array(
                'mantranews_widgets_name'         => 'mantranews_block_title',
                'mantranews_widgets_title'        => esc_html__( 'Widget Title', 'mantranews' ),
                'mantranews_widgets_field_type'   => 'text'
            ),

            'mantranews_block_posts_count' => array(
                'mantranews_widgets_name'         => 'mantranews_block_posts_count',
                'mantranews_widgets_title'        => esc_html__( 'No. of Posts', 'mantranews' ),
                'mantranews_widgets_default'      => 4,
                'mantranews_widgets_field_type'   => 'number'
            ),

            'mantranews_block_posts_type' => array(
                'mantranews_widgets_name'         => 'mantranews_block_posts_type',
                'mantranews_widgets_title'        => esc_html__( 'Posts Type', 'mantranews' ),
                'mantranews_widgets_default'		 => 'latest',
                'mantranews_widgets_field_options'=> $mantranews_post_list_option,
                'mantranews_widgets_field_type'   => 'radio'
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
        if( empty( $instance ) ) {
            return ;
        }

        $mantranews_block_title      	= empty( $instance['mantranews_block_title'] ) ? '' : $instance['mantranews_block_title'];
        $mantranews_block_posts_count    = intval( empty( $instance['mantranews_block_posts_count'] ) ? 4 : $instance['mantranews_block_posts_count'] );
        $mantranews_block_posts_type     = empty( $instance['mantranews_block_posts_type'] ) ? '' : $instance['mantranews_block_posts_type'];
        echo $before_widget;
?>
			<div class="widget-block-wrapper">
                <?php if($mantranews_block_title): ?>
				<div class="block-header">
	                <h3 class="block-title"><?php echo esc_html( $mantranews_block_title ); ?></h3>
	            </div><!-- .block-header -->
                <?php endif; ?>
	            <div class="posts-list-wrapper list-posts-block">
	            	<?php
	            		$posts_list_args = mantranews_query_args( $cat_id = null, $mantranews_block_posts_count );
	            		if( $mantranews_block_posts_type == 'random' ) {
	            			$posts_list_args['orderby'] = 'rand';
	            		}
	            		$posts_list_query = new WP_Query( $posts_list_args );
	            		if( $posts_list_query->have_posts() ) {
	            			while( $posts_list_query->have_posts() ) {
	            				$posts_list_query->the_post();
	                ?>
	                			<div class="single-post-wrapper clearfix">
                                    <div class="post-thumb-wrapper">
    	                                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
    	                                    <figure><?php the_post_thumbnail( 'mantranews-block-thumb' ); ?></figure>
    	                                </a>
                                    </div>
                                    <div class="post-content-wrapper">
                                        <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
    	                                <div class="post-meta-wrapper">
    	                                    <?php mantranews_posted_on(); ?>
    	                                </div><!-- .post-meta-wrapper -->
                                    </div>
	                            </div><!-- .single-post-wrapper -->
	                <?php
	            			}
	            		}

	            	?>
	            </div><!-- .posts-list-wrapper -->
			</div><!-- .widget-block-wrapper -->
<?php
		echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
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
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    mantranews_widgets_show_widget_field()       defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $mantranews_widgets_field_value = !empty( $instance[$mantranews_widgets_name] ) ? ( $instance[$mantranews_widgets_name] ) : '';
            $mantranews_widgets_field_value = is_string($mantranews_widgets_field_value) ? wp_kses_post($mantranews_widgets_field_value) : $mantranews_widgets_field_value;
            mantranews_widgets_show_widget_field( $this, $widget_field, $mantranews_widgets_field_value );
        }
    }
}
