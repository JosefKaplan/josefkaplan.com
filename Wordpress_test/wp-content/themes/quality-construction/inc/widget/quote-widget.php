<?php
if (!class_exists('Quality_Construction_Quote_Widget')) {
    class Quality_Construction_Quote_Widget extends WP_Widget
    {
        private function defaults(){
           $defaults = array(
            'title' => '',
            'button-text' => esc_html__('Quote','quality-construction'),
            'button-text-link' => '#',
           );
           return $defaults;
        }
        public function __construct()
        {
            parent::__construct(
                'quality-construction-quote-widget',
                esc_html__('Quality Quote Widget', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Quote Section', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args( (array ) $instance, $this->defaults() );
                $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? esc_html( $instance['title'] ) : '', $instance, $this->id_base);
                $button_text = esc_html( $instance['button-text'] );
                $button_text_link = esc_url( $instance['button-text-link'] );
                echo $args['before_widget'];
                ?>
                <section id="section0" class="section-0-background">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="section-0-box-text-cont">
                                    <h3><?php echo $title; ?></h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php
                                if(!empty($button_text_link))
                                {
                                ?>
                                   <div class="section-0-btn-cont">
                                        <a href="<?php echo $button_text_link; ?>" class="btn btn-seconday wow tada">
                                            <?php echo $button_text; ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                echo $args['after_widget'];
            }
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['button-text'] = sanitize_text_field( $new_instance['button-text']);
            $instance['button-text-link'] = esc_url_raw( $new_instance['button-text-link']);
            return $instance;
        }

        public function form($instance)
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $title = esc_attr( $instance['title']  );
            $button_text = esc_attr( $instance['button-text'] );
            $button_text_link = esc_url( $instance['button-text-link'] );

            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'quality-construction'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo $title?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text' ) ); ?>"><?php esc_html_e('Button Text', 'quality-construction'); ?></label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text')); ?>" value="<?php echo $button_text; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button-text-link' ) ); ?>">
                    <?php esc_html_e('Button Link', 'quality-construction'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('button-text-link')); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id('button-text-link')); ?>" value="<?php echo $button_text_link; ?>">
            </p>
            <?php
        }
    }
}
add_action('widgets_init', 'quality_construction_quote_widget');
function quality_construction_quote_widget()
{
    register_widget('Quality_Construction_Quote_Widget');

}















