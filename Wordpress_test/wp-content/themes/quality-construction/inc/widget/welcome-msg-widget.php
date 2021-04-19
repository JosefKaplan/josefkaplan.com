<?php
if (!class_exists('Quality_Construction_Welcome_Msg_Widget')) {
    class Quality_Construction_Welcome_Msg_Widget extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'page_id' => 0,
                'character_limit' => 25
            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'quality-construction-welcome-msg-widget',
                esc_html__('Quality Welcome Message', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Welcome Message', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args( (array )$instance, $this->defaults() );
                $page_id = absint($instance['page_id']);
                $limit_character = absint( $instance['character_limit'] );
                echo $args['before_widget'];
                if (!empty($page_id)) {
                    $quality_construction_page_args = array(
                        'page_id' => $page_id,
                        'posts_per_page' => 1,
                        'post_type' => 'page',
                        'no_found_rows' => true,
                        'post_status' => 'publish'
                    );

                  $welcome_query = new WP_Query( $quality_construction_page_args );
                    if ($welcome_query->have_posts()):
                        while ($welcome_query->have_posts()):$welcome_query->the_post(); ?>

                            <section id="section2" class="section-margine">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 text-center ">
                                            <div class="section-2-box-left wow fadeInUp">
                                                <h4><?php the_title(); ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2 text-center">
                                            <div class="section-2-box-right wow fadeInRight">
                                                <p><?php echo esc_html( wp_trim_words(get_the_content(), $limit_character)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    echo $args['after_widget'];
                }
            }
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['page_id'] = absint($new_instance['page_id']);
            $instance['character_limit'] = absint( $new_instance['character_limit'] );

            return $instance;
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults() );
            $page_id = absint($instance['page_id']);
            $limit_character = absint( $instance['character_limit'] );
            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('page_id')); ?>"><?php esc_html_e('Select Page', 'quality-construction'); ?></label><br/>

                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected' => $page_id,
                    'name' => esc_attr( $this->get_field_name('page_id') ),
                    'id' => esc_attr( $this->get_field_id('page_id') ),
                    'class' => 'widefat',
                    'show_option_none' => esc_html__('Select Page', 'quality-construction'),
                );
                wp_dropdown_pages($args);
                ?>
            </p>
            <hr>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('character_limit')); ?>"><?php esc_html_e('Character Limit', 'quality-construction'); ?></label><br/>
                <input type="number" name="<?php echo esc_attr( $this->get_field_name('character_limit')); ?>" class="quality-cons" id="<?php echo esc_attr($this->get_field_id('character_limit')); ?>" value="<?php echo $limit_character ?>">
            </p>
            <?php
        }
    }

}

add_action('widgets_init', 'quality_construction_welcome_msg_widget');
function quality_construction_welcome_msg_widget()
{
    register_widget('Quality_Construction_Welcome_Msg_Widget');

}















