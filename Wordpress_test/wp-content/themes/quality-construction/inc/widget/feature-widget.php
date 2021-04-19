<?php
if( !class_exists( 'Quality_Construction_Feature_Widget') ){

    class Quality_Construction_Feature_Widget extends WP_Widget
    {
        private function defaults(){
            $defaults = array(
                 'cat_id' => -1
            );
            return $defaults;
        }
        public function __construct()
        {
            parent::__construct(
                'quality-construction-feature-widget',
                    esc_html__('Quality Feature Widget', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Feature Section', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {
            if ( !empty( $instance ) ) {
                $instance = wp_parse_args( (array) $instance, $this->defaults() );
                /*default values*/
                $catid = absint( $instance[ 'cat_id' ] );
                echo $args['before_widget'];
                ?>
                <section id="section1" class="section-margine">
                    <div class="container">
                        <div class="row">
                            <?php if ( !empty( $catid ) ) {
                                $i = 0;
                                $sticky = get_option( 'sticky_posts' );
                                $home_feature_section = array(
                                    'ignore_sticky_posts' => true,
                                    'post__not_in' => $sticky,
                                    'cat' => $catid,
                                    'posts_per_page' => 3
                                );
                                $home_feature_section_query = new WP_Query( $home_feature_section );
                                if ( $home_feature_section_query->have_posts() ) {

                                    while ($home_feature_section_query->have_posts()) {
                                        $home_feature_section_query->the_post();
                                        $icon = get_post_meta( get_the_ID(), 'quality_construction_icon', true );
                                        ?>
                                        <div class="col-md-4">
                                            <div class="section-1-box wow bounceIn"
                                                 data-wow-delay=".<?php echo esc_attr($i); ?>">
                                                <?php
                                                if(!empty($icon))
                                                {
                                                ?>
                                                <div class="section-1-box-icon-background">
                                                     <i class="fa <?php echo esc_attr($icon); ?> fa-4x"></i>
                                                </div>
                                                <?php } ?>
                                                <h4 class="text-left"><?php the_title() ?></h4>
                                                <p class="text-left"><?php echo esc_html( wp_trim_words( get_the_content(), 8) ); ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                }
                                wp_reset_postdata();
                            }
                            ?>
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
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint( $new_instance['cat_id'] ) : '';
            return $instance;

        }

        public function form($instance)
        {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $quality_construction_selected_cat = absint( $instance[ 'cat_id' ] );
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e('Select Category', 'quality-construction'); ?>
                </label><br/>
                <?php
                $quality_construction_dropown_cat = array(
                    'show_option_none' => esc_html__('Select Category', 'quality-construction'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $quality_construction_selected_cat,
                    'hierarchical' => 1,
                    'name' => esc_attr( $this->get_field_name('cat_id') ),
                    'id' => esc_attr( $this->get_field_name('cat_id') ),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($quality_construction_dropown_cat);
                ?>
            </p>
            <hr>
            <?php
        }
    }
}

add_action('widgets_init', 'quality_construction_feature_widget');
function quality_construction_feature_widget()
{
    register_widget('Quality_Construction_Feature_Widget');
}










