<?php
if( !class_exists( 'Quality_Construction_Services_Widget') ){
    class Quality_Construction_Services_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'image' => '',
            );
            return $defaults;
        }
        public function __construct()
        {
            parent::__construct(
                'quality-construction-service-widget',
                esc_html__('Quality Service Widget', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Service Section', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args( (array ) $instance, $this->defaults ());
                echo $args['before_widget'];
                $catid = absint( $instance['cat_id'] );
                $image = esc_url( $instance['image'] );
                ?>
                <section id="section4" class="section-margine section-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <?php
                                    $idvalue = array();
                                    if ( !empty( $catid ) ) {
                                        $i = 0;
                                        $sticky = get_option( 'sticky_posts' );
                                        $home_services_section = array(
                                            'cat' => $catid,
                                            'posts_per_page' => 3,
                                            'ignore_sticky_posts' => true,
                                            'post__not_in' => $sticky,
                                            'order' => 'ASC'
                                        );
                                        $home_services_section_query = new WP_Query( $home_services_section );
                                        if ($home_services_section_query->have_posts()) {
                                            while ($home_services_section_query->have_posts()) {
                                                $home_services_section_query->the_post();
                                                $icon = get_post_meta( get_the_ID(), 'quality_construction_icon', true );
                                                $idvalue[] = get_the_ID();
                                                ?>

                                                <div class="col-md-12">
                                                    <div class="section-4-box wow fadeIn"
                                                         data-wow-delay=".<?php echo esc_attr($i); ?>s">
                                                        <div class="section-4-box-icon-cont">
                                                            <i class="fa <?php echo esc_attr($icon); ?> fa-2x"></i>
                                                        </div>
                                                        <div class="section-4-box-text-cont">
                                                            <h5><?php the_title(); ?></h5>
                                                            <p><?php echo esc_html( wp_trim_words( get_the_content(), 16) ); ?></p>
                                                        </div>
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
                            <?php if ( !empty( $image ) ) { ?>
                                <div class="col-md-4  wow fadeInUp">
                                    <figure><img src="<?php echo $image; ?>" class="img-responsive" /></figure>
                                </div>
                            <?php } ?>
                            <div class="col-md-4">
                                <div class="row">
                                    <?php
                                    if ( !empty( $catid ) ) {
                                        $j = 3;
                                        $home_services_section = array(
                                            'cat' => $catid,
                                            'posts_per_page' => 3,
                                            'post__not_in' => $idvalue,
                                            'ignore_sticky_posts' => true,
                                            'order' => 'ASC'
                                        );
                                        $home_services_section_query = new WP_Query( $home_services_section );
                                        if ($home_services_section_query->have_posts()) {
                                            while ($home_services_section_query->have_posts()) {
                                                $home_services_section_query->the_post();
                                                $icon = get_post_meta( get_the_ID(), 'quality_construction_icon', true );
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="section-4-box wow fadeIn"
                                                         data-wow-delay=".<?php echo esc_attr($j); ?>s">
                                                        <div class="section-4-box-icon-cont">
                                                            <i class="fa <?php echo esc_attr($icon); ?> fa-2x"></i>
                                                        </div>
                                                        <div class="section-4-box-text-cont">
                                                            <h5><?php the_title(); ?></h5>
                                                            <p><?php echo esc_html( wp_trim_words( get_the_content(), 16) ); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $j++;
                                            }
                                        }
                                        wp_reset_postdata();
                                    }
                                    ?>

                                </div>
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
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['image'] = esc_url_raw( $new_instance['image'] );
            return $instance;

        }

        public function form($instance)
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid = absint( $instance['cat_id'] );
            $image = esc_url( $instance['image'] );
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e( 'Select Category', 'quality-construction'); ?>
                </label><br />
                <?php
                $quality_dropown_cat = array(
                    'show_option_none' => esc_html__('Select Category', 'quality-construction'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr( $this->get_field_name('cat_id') ),
                    'id' => esc_attr( $this->get_field_name('cat_id') ),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories( $quality_dropown_cat );
                ?>
            </p>
            <hr>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('image') ); ?>">
                    <?php esc_html_e('Image Size[243 X 470]', 'quality-construction'); ?>
                </label>
                <br/>
                <?php
                if ( !empty( $image ) ) :
                    echo '<img class="custom_media_image widefat" src="' . $image . '"/><br />';
                endif;
                ?>
                <input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>" id="<?php echo esc_attr( $this->get_field_id('image') ); ?>" value="<?php echo $image; ?>">
                <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>" value="<?php esc_attr_e('Upload Image', 'quality-construction') ?>" />
            </p>
            <?php
        }
    }
}


add_action('widgets_init', 'quality_construction_service_widget');
function quality_construction_service_widget() {
    register_widget('Quality_Construction_Services_Widget' );
}