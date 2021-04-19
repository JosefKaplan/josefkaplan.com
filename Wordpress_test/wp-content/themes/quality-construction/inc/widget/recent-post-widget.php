<?php
if (!class_exists('Quality_Construction_Recent_Post_Widget')) {
    class Quality_Construction_Recent_Post_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => -1,
                'title' => esc_html__('Recent Posts','quality-construction'),
                'sub-title' => '',

            );
            return $defaults;
        }

     public function __construct()
        {
            parent::__construct(
                'quality-construction-recent-post-widget',
                esc_html__('Quality Recent Post Widget', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Recent Post Section', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {

            if (!empty($instance)) {
                $instance = wp_parse_args( (array ) $instance, $this->defaults() );
                echo $args['before_widget'];
                $catid = absint( $instance['cat_id'] );
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
                $subtitle =  esc_html( $instance['sub-title'] );

                ?>
                <section id="section14" class="section-margine">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <?php
                                    if (!empty( $title )) {
                                        ?>
                                        <h2><?php echo $args['before_title'] . $title . $args['after_title']; ?></h2>
                                    <?php }
                                    if (!empty( $subtitle )) {
                                        ?>
                                        <h6><?php echo $subtitle; ?></h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $i = 0;
                            $sticky = get_option( 'sticky_posts' );
                            if ($catid != -1) {
                                $home_recent_post_section = array(
                                    'ignore_sticky_posts' => true,
                                    'post__not_in' => $sticky,
                                    'cat' => $catid,
                                    'posts_per_page' => 3,
                                    'order' => 'DESC'
                                );
                            } else {
                                $home_recent_post_section = array(
                                    'ignore_sticky_posts' => true,
                                    'post__not_in' => $sticky,
                                    'post_type' => 'post',
                                    'posts_per_page' => 3,
                                    'order' => 'DESC'
                                );
                            }

                            $home_recent_post_section_query = new WP_Query($home_recent_post_section);

                            if ($home_recent_post_section_query->have_posts()) {
                                while ($home_recent_post_section_query->have_posts()) {
                                    $home_recent_post_section_query->the_post();
                                    ?>
                                    <div class="col-md-4">
                                        <div class="section-14-box wow fadeInLeft <?php if ( !has_post_thumbnail() ) {
                                            echo "no-image";
                                        } ?> " data-wow-delay="<?php echo esc_attr($i); ?>s">
                                            <div class="date">
                                                <span><?php echo esc_html( get_the_date('M') ); ?></span>
                                                - <?php echo esc_html( get_the_date('d') ); ?>
                                                <br>
                                                <span><?php echo esc_html( get_the_date('Y') ); ?></span>
                                            </div>
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $image_id = get_post_thumbnail_id();
                                                $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
                                                ?>
                                                <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive">
                                            <?php }
                                            ?>
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-left comments">
                                                        <i class="fa fa-user"></i>
                                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?> ">
                                                            <?php the_author(); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p><?php echo esc_html( wp_trim_words( get_the_content(), 20 ) ); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                                <?php esc_html_e('Read More', 'quality-construction'); ?>
                                            </a>
                                        </div>
                                    </div>
                                     <?php
                                    $i++;
                                }
                            }
                            wp_reset_postdata();
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
            $instance['cat_id'] = (isset( $new_instance['cat_id'] ) ) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['sub-title'] = sanitize_text_field( $new_instance['sub-title'] );

            return $instance;

        }

        public function form( $instance )
        {
            $instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid = absint( $instance['cat_id'] );
            $title = esc_attr( $instance['title'] );
            $subtitle =  esc_attr( $instance['sub-title'] );

            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'quality-construction'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub-title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'quality-construction'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub-title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub-title')); ?>" value="<?php echo $subtitle; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e('Select Category', 'quality-construction'); ?>
                </label><br/>
                <?php
                $quality_con_dropown_cat = array(
                    'show_option_none' => esc_html__('From Recent Posts', 'quality-construction'),
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
                wp_dropdown_categories( $quality_con_dropown_cat );
                ?>
            </p>
            <hr>
            <?php
        }
    }
}
add_action('widgets_init', 'quality_construction_recent_post_widget');
function quality_construction_recent_post_widget()
{
    register_widget('Quality_Construction_Recent_Post_Widget');

}















