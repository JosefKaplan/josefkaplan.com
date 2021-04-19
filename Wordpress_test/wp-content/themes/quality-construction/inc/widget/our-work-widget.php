<?php
if (!class_exists('Quality_Construction_Our_Work_Widget')) {
    class Quality_Construction_Our_Work_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title' => esc_html__('Our Work', 'quality-construction'),
                'quality_construction_portfolio_filter_all' => esc_html__('All', 'quality-construction'),
                'cat_id' => array(),
                'featured_image_size' => 'full',
                'post_column' => 3,
                'post_number' => 6,
            );
            return $defaults;
        }


        public function __construct()
        {
            parent::__construct(
                'quality-construction-our-work-widget',
                esc_html__('Quality Construction Our Work Widget', 'quality-construction'),
                array('description' => esc_html__('Quality Construction Work Section', 'quality-construction'))
            );
        }

        public function widget($args, $instance)
        {

            $instance = wp_parse_args((array)$instance, $this->defaults());
            if (!empty($instance)) {
                $post_number = absint($instance['post_number']);
                $column_number = absint($instance['post_column']);
                $featured_image = esc_html($instance['featured_image_size']);
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                $quality_construction_ad_title = esc_html($instance['quality_construction_portfolio_filter_all']);
                $quality_construction_selected_cat = '';
                if (!empty($instance['cat_id'])) {
                    $quality_construction_selected_cat = quality_construction_sanitize_multiple_category($instance['cat_id']);
                    if (is_array($quality_construction_selected_cat[0])) {
                        $quality_construction_selected_cat = $quality_construction_selected_cat[0];
                    }
                }

                echo $args['before_widget'];
                ?>
                <section id="section-12">
                    <div class="container">
                        <?php
                        $sticky = get_option('sticky_posts');
                        $quality_construction_cat_post_args = array(
                            'posts_per_page' => $post_number,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true,
                            'post__not_in' => $sticky,
                        );
                        if (-1 != $quality_construction_cat_post_args) {
                            $quality_construction_cat_post_args['category__in'] = $quality_construction_selected_cat;
                        }
                        $portfolio_filter_query = new WP_Query($quality_construction_cat_post_args);

                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center"><?php echo $title; ?></h2>
                                <div class="portfolioFilter text-center">
                                    <?php
                                    if (!empty($quality_construction_ad_title)) {
                                        echo '<a href="#" data-filter="*" class="current">' . $quality_construction_ad_title . '</a>/';
                                    }

                                    if (!empty($quality_construction_selected_cat) && is_array($quality_construction_selected_cat)) {
                                        foreach ($quality_construction_selected_cat as $quality_construction_selected_single_cat) {

                                            echo ' <a href="#" data-filter=".' . esc_attr($quality_construction_selected_single_cat) . '">' . esc_html(get_cat_name($quality_construction_selected_single_cat)) . '</a>/';
                                        }
                                    }

                                    ?>
                                </div>
                                <div class="portfolioContainer">
                                    <?php
                                    if ($portfolio_filter_query->have_posts()):
                                        while ($portfolio_filter_query->have_posts()):$portfolio_filter_query->the_post();

                                            if (2 == $column_number) {
                                                $quality_construction_column = "col-md-6";
                                            } elseif (3 == $column_number) {
                                                $quality_construction_column = "col-md-4";
                                            } elseif (4 == $column_number) {
                                                $quality_construction_column = 'col-md-3';
                                            }
                                            else{
                                                $quality_construction_column = 'col-md-12';
                                            }

                                            $categories = get_the_category(get_the_ID());
                                            if (!empty($categories)) {
                                                foreach ($categories as $category) {
                                                    $quality_construction_column .= ' ' . $category->term_id;
                                                }
                                            }
                                            if ( has_post_thumbnail() ) {
                                                $image_id = get_post_thumbnail_id();
                                                $image_url = wp_get_attachment_image_src($image_id, $featured_image, true);
                                                $image_path = $image_url[0];
                                                ?>
                                                <div class="<?php echo esc_attr($quality_construction_column); ?> col-sm-12 col-xs-12  text-center">

                                                    <a class="magnific-popup" href="<?php echo esc_url($image_url[0]); ?>">
                                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive wow zoomIn" alt="image">
                                                    </a>

                                                </div>
                                                <?php
                                            }
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </div><!--portfolioContainer-->
                                </div><!--col-md-12-->
                            </div><!--.row-->
                        </div><!--.container-->
                </section><!--section-->
                <?php
                echo $args['after_widget'];
            }
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? quality_construction_sanitize_multiple_category( $new_instance['cat_id'] ) : array();
            $instance['quality_construction_portfolio_filter_all'] = sanitize_text_field($new_instance['quality_construction_portfolio_filter_all']);
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['post_number'] = absint( $new_instance['post_number'] );
            $instance['post_column'] = absint( $new_instance['post_column']);
            $instance['featured_image_size'] = sanitize_text_field($new_instance['featured_image_size']);

            return $instance;
        }

        public function form($instance)
        {

            $instance = wp_parse_args( (array )$instance, $this->defaults() );
            $post_number = absint($instance['post_number']);
            $column_number = absint($instance['post_column']);
            $featured_image_size = esc_attr($instance['featured_image_size']);
            $title = esc_attr($instance['title']);
            $quality_construction_ad_title = esc_attr($instance['quality_construction_portfolio_filter_all']);
            $quality_construction_selected_cat = '';
            if (!empty($instance['cat_id'])) {
                $quality_construction_selected_cat = $instance['cat_id'];
                if (is_array($quality_construction_selected_cat[0])) {
                    $quality_construction_selected_cat = $quality_construction_selected_cat[0];
                }
            }
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'quality-construction'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('quality_construction_portfolio_filter_all')); ?>"><?php esc_html_e('Our Work Filter All Text', 'quality-construction'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('quality_construction_portfolio_filter_all')); ?>" name="<?php echo esc_attr($this->get_field_name('quality_construction_portfolio_filter_all')); ?>" type="text" value="<?php echo $quality_construction_ad_title; ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>"><strong><?php esc_html_e('Select Category', 'quality-construction'); ?></strong></label>
                <select class="widefat" name="<?php echo $this->get_field_name('cat_id'); ?>[]" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" multiple="multiple">
                    <?php
                    $option = '';
                    $categories = get_categories();
                    if ($categories) {
                        foreach ($categories as $category) {
                            $result = in_array($category->term_id, $quality_construction_selected_cat) ? 'selected=selected' : '';
                            $option .= '<option value="' . esc_attr($category->term_id) . '"' . esc_attr($result) . '>';
                            $option .= esc_html($category->cat_name);
                            $option .= esc_html(' (' . $category->category_count . ')');
                            $option .= '</option>';
                        }
                    }
                    echo $option;
                    ?>
                </select>
            </p>
            <hr>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_number')); ?>"><strong><?php esc_html_e('Number of Posts:', 'quality-construction'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" type="number" value="<?php echo $post_number; ?>" min="1"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_column')); ?>"><strong><?php esc_html_e('Number of Columns:', 'quality-construction'); ?></strong></label>
                <?php
                $this->dropdown_post_columns(
                        array(
                        'id' => esc_attr($this->get_field_id('post_column')),
                        'name' => esc_attr($this->get_field_name('post_column')),
                        'selected' => $column_number
                        )
                );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('featured_image_size')); ?>"><strong><?php esc_html_e('Select Image Size:', 'quality-construction'); ?></strong></label>
                <?php
                $this->dropdown_image_sizes(array(
                        'id' => esc_attr($this->get_field_id('featured_image_size')),
                        'name' => esc_attr($this->get_field_name('featured_image_size')),
                        'selected' => $featured_image_size,
                    )
                );
                ?>
            </p>
            <?php

        }


        function dropdown_post_columns($args)
        {
            $defaults = array(
                'id' => '',
                'name' => '',
                'selected' => 0,
            );

            $r = wp_parse_args($args, $defaults);
            $output = '';

            $choices = array(
                2 => esc_html__('2', 'quality-construction'),
                3 => esc_html__('3', 'quality-construction'),
                4 => esc_html__('4', 'quality-construction'),
            );

            if (!empty($choices)) {

                $output = "<select name='" . esc_attr($r['name']) . "' id='" . esc_attr($r['id']) . "'>\n";
                foreach ($choices as $key => $choice) {
                    $output .= '<option value="' . esc_attr($key) . '" ';
                    $output .= selected($r['selected'], $key, false);
                    $output .= '>' . esc_html($choice) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
        }

        function dropdown_image_sizes($args)
        {
            $defaults = array(
                'id' => '',
                'class' => 'widefat',
                'name' => '',
                'selected' => 0,
            );

            $r = wp_parse_args($args, $defaults);
            $output = '';

            $choices = array(
                'thumbnail' => esc_html__('Thumbnail', 'quality-construction'),
                'medium' => esc_html__('Medium', 'quality-construction'),
                'large' => esc_html__('Large', 'quality-construction'),
                'full' => esc_html__('Full', 'quality-construction'),
            );

            if (!empty($choices)) {

                $output = "<select name='" . esc_attr($r['name']) . "' id='" . esc_attr($r['id']) . "' class='" . esc_attr($r['class']) . "'>\n";
                foreach ($choices as $key => $choice) {
                    $output .= '<option value="' . esc_attr($key) . '" ';
                    $output .= selected($r['selected'], $key, false);
                    $output .= '>' . esc_html($choice) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
        }

    }
}

add_action('widgets_init', 'quality_construction_our_work_widget');
function quality_construction_our_work_widget()
{
    register_widget('Quality_Construction_Our_Work_Widget');

}















