<?php
/**
 * Mantranews: Homepage Featured Slider
 *
 * Homepage slider section with featured section
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

add_action('widgets_init', 'mantranews_register_featured_slider_widget');

function mantranews_register_featured_slider_widget()
{
    register_widget('Mantranews_Featured_Slider');
}

class Mantranews_Featured_Slider extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'mantranews_featured_slider clearfix',
            'description' => esc_html__('Display slider with featured posts.', 'mantranews')
        );
        parent::__construct('mantranews_featured_slider', esc_html__('Featured Slider', 'mantranews'), $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields()
    {

        $mantranews_category_dropdown = mantranews_category_dropdown();
        $mantranews_tags_dropdown = mantranews_tags_dropdown();
        $mantranews_category_dropdown_parameter = mantranews_category_dropdown_parameter();
        $mantranews_tag_dropdown_parameter = mantranews_tags_dropdown_parameter();
        $mantranews_feature_slider_layout = mantranews_feature_slider_layout();

        $fields = array(

            'mantranews_slider_category' => array(
                'mantranews_widgets_name' => 'mantranews_slider_category',
                'mantranews_widgets_title' => esc_html__('Category for Slider', 'mantranews'),
                'mantranews_widgets_default' => 0,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_category_dropdown,
                'mantranews_widgets_field_multiple' => true,

            ),
            'mantranews_slider_category_parameter' => array(
                'mantranews_widgets_name' => 'mantranews_slider_category_parameter',
                'mantranews_widgets_title' => esc_html__('Category Parameters for Slider Option', 'mantranews'),
                'mantranews_widgets_default' => 1,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_category_dropdown_parameter,
            ),
            'mantranews_slider_tags' => array(
                'mantranews_widgets_name' => 'mantranews_slider_tags',
                'mantranews_widgets_title' => esc_html__('Tags for Slider', 'mantranews'),
                'mantranews_widgets_default' => 0,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_tags_dropdown,
                'mantranews_widgets_field_multiple' => true,

            ),
            'mantranews_slider_tags_parameter' => array(
                'mantranews_widgets_name' => 'mantranews_slider_tags_parameter',
                'mantranews_widgets_title' => esc_html__('Tags Parameters for Slider Option', 'mantranews'),
                'mantranews_widgets_default' => 1,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_tag_dropdown_parameter,
            ),

            'mantranews_slide_count' => array(
                'mantranews_widgets_name' => 'mantranews_slide_count',
                'mantranews_widgets_title' => esc_html__('No. of slides', 'mantranews'),
                'mantranews_widgets_default' => 5,
                'mantranews_widgets_field_type' => 'number'
            ),

            // Feature slider configuration
            'featured_header_section' => array(
                'mantranews_widgets_name' => 'featured_header_section',
                'mantranews_widgets_title' => esc_html__('Featured Posts Section', 'mantranews'),
                'mantranews_widgets_field_type' => 'widget_section_header'
            ),

            'mantranews_featured_category' => array(
                'mantranews_widgets_name' => 'mantranews_featured_category',
                'mantranews_widgets_title' => esc_html__('Category for Featured Posts', 'mantranews'),
                'mantranews_widgets_default' => 0,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_category_dropdown,
                'mantranews_widgets_field_multiple' => true,

            ),
            'mantranews_feature_slider_category_parameter' => array(
                'mantranews_widgets_name' => 'mantranews_feature_slider_category_parameter',
                'mantranews_widgets_title' => esc_html__('Category Parameters for Featured Posts', 'mantranews'),
                'mantranews_widgets_default' => 1,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_category_dropdown_parameter,
            ),
            'mantranews_feature_slider_tags' => array(
                'mantranews_widgets_name' => 'mantranews_feature_slider_tags',
                'mantranews_widgets_title' => esc_html__('Tags for Featured Posts', 'mantranews'),
                'mantranews_widgets_default' => 0,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_tags_dropdown,
                'mantranews_widgets_field_multiple' => true,

            ),
            'mantranews_feature_slider_tags_parameter' => array(
                'mantranews_widgets_name' => 'mantranews_feature_slider_tags_parameter',
                'mantranews_widgets_title' => esc_html__('Tags Parameters for Featured Posts', 'mantranews'),
                'mantranews_widgets_default' => 1,
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_tag_dropdown_parameter,
            ),
            'mantranews_slider_layout' => array(
                'mantranews_widgets_name' => 'mantranews_slider_layout',
                'mantranews_widgets_title' => esc_html__('Layout', 'mantranews'),
                'mantranews_widgets_default' => 'left',
                'mantranews_widgets_field_type' => 'select',
                'mantranews_widgets_field_options' => $mantranews_feature_slider_layout
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
    public function widget($args, $instance)
    {
        extract($args);
        if (empty($instance)) {
            return;
        }
        $mantranews_slide_count = intval(empty($instance['mantranews_slide_count']) ? 5 : $instance['mantranews_slide_count']);
        $mantranews_featured_category_id = isset($instance['mantranews_featured_category']) ? is_array($instance['mantranews_featured_category']) ? array_map('absint', wp_unslash($instance['mantranews_featured_category'])) : absint($instance['mantranews_featured_category']) : 0;
        $mantranews_feature_slider_category_parameter = intval(!isset($instance['mantranews_feature_slider_category_parameter']) ? 1 : $instance['mantranews_feature_slider_category_parameter']);
        $mantranews_feature_slider_tag_id = isset($instance['mantranews_feature_slider_tags']) ? is_array($instance['mantranews_feature_slider_tags']) ? array_map('absint', wp_unslash($instance['mantranews_feature_slider_tags'])) : absint($instance['mantranews_feature_slider_tags']) : 0;
        $mantranews_feature_slider_tags_parameter = intval(!isset($instance['mantranews_feature_slider_tags_parameter']) ? 1 : $instance['mantranews_feature_slider_tags_parameter']);

        $mantranews_slider_category_parameter = intval(!isset($instance['mantranews_slider_category_parameter']) ? 1 : $instance['mantranews_slider_category_parameter']);
        $mantranews_slider_category_id = isset($instance['mantranews_slider_category']) ? is_array($instance['mantranews_slider_category']) ? array_map('absint', wp_unslash($instance['mantranews_slider_category'])) : absint($instance['mantranews_slider_category']) : 0;
        $mantranews_slider_tag_id = isset($instance['mantranews_slider_tags']) ? is_array($instance['mantranews_slider_tags']) ? array_map('absint', wp_unslash($instance['mantranews_slider_tags'])) : absint($instance['mantranews_slider_tags']) : 0;
        $mantranews_slider_tag_parameter = intval(!isset($instance['mantranews_slider_tags_parameter']) ? 1 : $instance['mantranews_slider_tags_parameter']);
        $mantranews_slider_layout = isset($instance['mantranews_slider_layout']) ? $instance['mantranews_slider_layout'] : '';
        echo $before_widget;
        ?>
        <div class="mb-feature-slider <?php echo esc_attr($mantranews_slider_layout); ?>">

            <?php if ($mantranews_slider_layout !== 'center') {
                $slider_args = mantranews_query_args($mantranews_slider_category_id, $mantranews_slide_count, $mantranews_slider_category_parameter, $mantranews_slider_tag_id, $mantranews_slider_tag_parameter);
                $slider_args['meta_query'] = array(
                    array(
                        'key' => '_thumbnail_id'
                    )
                );
                $slider_query = new WP_Query($slider_args);
                $slider_class = (absint($slider_query->post_count) > 1) ? 'slider_exist' : 'noslider';

                ?>
                <div class="mb-featured-slider-wrapper">
                    <div class="mb-slider-section  <?php echo $slider_class; ?>">
                        <?php

                        if ($slider_query->have_posts()) {
                            echo '<ul class="mantranewsSlider">';
                            while ($slider_query->have_posts()) {
                                $slider_query->the_post();
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $thumbnail_size = 'mantranews-slider-large';
                                        if ($mantranews_slider_layout == 'slider_only') {
                                            $thumbnail_size = 'full';
                                        }
                                        ?>
                                        <figure><?php the_post_thumbnail($thumbnail_size); ?></figure>
                                    </a>
                                    <div class="slider-content-wrapper">

                                        <h3 class="slide-title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta-wrapper">
                                            <?php mantranews_posted_on(); ?>
                                            <?php mantranews_post_comment(); ?>
                                        </div>
                                        <?php do_action('mantranews_post_categories'); ?>
                                    </div><!-- .post-meta-wrapper -->
                                </li>
                                <?php
                            }
                            echo '</ul>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div><!-- .mb-slider-section -->
                </div><!-- .mb-featured-slider-wrapper -->

            <?php } ?>
            <?php if ($mantranews_slider_layout !== 'slider_only') { ?>
                <div class="feature-post">
                    <div class="featured-post-wrapper">
                        <?php
                        $number_of_left_posts = 2;
                        $featured_left_args = mantranews_query_args($mantranews_featured_category_id, $number_of_left_posts, $mantranews_feature_slider_category_parameter, $mantranews_feature_slider_tag_id, $mantranews_feature_slider_tags_parameter);
                        $featured_left_args['meta_query'] = array(
                            array(
                                'key' => '_thumbnail_id'
                            )
                        );
                        $featured_left_query = new WP_Query($featured_left_args);
                        if ($featured_left_query->have_posts()) {
                            while ($featured_left_query->have_posts()) {
                                $featured_left_query->the_post();
                                $post_id = get_the_ID();
                                $image_path = get_the_post_thumbnail($post_id, 'mantranews-featured-medium');
                                ?>
                                <div class="single-featured-wrap">
                                    <div class="single-slide">
                                        <div class="mb-post-thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <figure><?php echo $image_path; ?></figure>
                                            </a>
                                        </div>
                                        <div class="featured-content-wrapper">

                                            <h3 class="featured-title"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta-wrapper"> <?php mantranews_posted_on(); ?> </div>
                                            <?php do_action('mantranews_post_categories'); ?>
                                        </div><!-- .post-meta-wrapper -->
                                    </div><!-- .single-featured-wrap -->
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <?php

                        wp_reset_postdata();
                        if ($mantranews_slider_layout === 'center') {
                            $slider_args = mantranews_query_args($mantranews_slider_category_id, $mantranews_slide_count, $mantranews_slider_category_parameter, $mantranews_slider_tag_id, $mantranews_slider_tag_parameter);
                            $slider_args['meta_query'] = array(
                                array(
                                    'key' => '_thumbnail_id'
                                )
                            );
                            $slider_query = new WP_Query($slider_args);
                            $slider_class = (absint($slider_query->post_count) > 1) ? 'slider_exist' : 'noslider';

                            ?>
                            <div class="mb-featured-slider-wrapper">
                                <div class="mb-slider-section  <?php echo $slider_class; ?>">
                                    <?php

                                    if ($slider_query->have_posts()) {
                                        echo '<ul class="mantranewsSlider">';
                                        while ($slider_query->have_posts()) {
                                            $slider_query->the_post();
                                            ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>"
                                                   title="<?php the_title_attribute(); ?>">
                                                    <?php
                                                    $thumbnail_size = 'mantranews-slider-large';
                                                    if ($mantranews_slider_layout == 'slider_only') {
                                                        $thumbnail_size = 'full';
                                                    }
                                                    ?>
                                                    <figure><?php the_post_thumbnail($thumbnail_size); ?></figure>
                                                </a>
                                                <div class="slider-content-wrapper">

                                                    <h3 class="slide-title"><a
                                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="post-meta-wrapper">
                                                        <?php mantranews_posted_on(); ?>
                                                        <?php mantranews_post_comment(); ?>
                                                    </div>
                                                    <?php do_action('mantranews_post_categories'); ?>
                                                </div><!-- .post-meta-wrapper -->
                                            </li>
                                            <?php
                                        }
                                        echo '</ul>';
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div><!-- .mb-slider-section -->
                            </div><!-- .mb-featured-slider-wrapper -->
                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                        <?php
                        $number_of_right_posts = 2;
                        $right_thumbnail_size = 'mantranews-featured-medium';

                        if ($mantranews_slider_layout === 'left' || empty($mantranews_slider_layout)) {
                            $number_of_right_posts = 2;
                            $right_thumbnail_size = 'mantranews-featured-medium';
                        }

                        $featured_right_args = mantranews_query_args($mantranews_featured_category_id, $number_of_right_posts, $mantranews_feature_slider_category_parameter, $mantranews_feature_slider_tag_id, $mantranews_feature_slider_tags_parameter);
                        $featured_right_args['offset'] = $number_of_left_posts;
                        $featured_right_args['meta_query'] = array(
                            array(
                                'key' => '_thumbnail_id'
                            )
                        );
                        $featured_right_query = new WP_Query($featured_right_args);
                        if ($featured_right_query->have_posts()) {
                            while ($featured_right_query->have_posts()) {
                                $featured_right_query->the_post();
                                $post_id = get_the_ID();
                                $image_path = get_the_post_thumbnail($post_id, $right_thumbnail_size);
                                ?>
                                <div class="single-featured-wrap">
                                    <div class="single-slide">
                                        <div class="mb-post-thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <figure><?php echo $image_path; ?></figure>
                                            </a>
                                        </div>
                                        <div class="featured-content-wrapper">

                                            <h3 class="featured-title"><a
                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta-wrapper"> <?php mantranews_posted_on(); ?> </div>
                                            <?php do_action('mantranews_post_categories'); ?>
                                        </div><!-- .post-meta-wrapper -->
                                    </div>
                                </div><!-- .single-featured-wrap -->
                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            <?php } ?>

        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see     WP_Widget::update()
     *
     * @param    array $new_instance Values just sent to be saved.
     * @param    array $old_instance Previously saved values from database.
     *
     * @uses    mantranews_widgets_updated_field_value()        defined in mantranews-widget-fields.php
     *
     * @return    array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

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
     * @see     WP_Widget::form()
     *
     * @param    array $instance Previously saved values from database.
     *
     * @uses    mantranews_widgets_show_widget_field()        defined in mantranews-widget-fields.php
     */
    public function form($instance)
    {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $mantranews_widgets_field_value = !empty($instance[$mantranews_widgets_name]) ? ($instance[$mantranews_widgets_name]) : '';
            $mantranews_widgets_field_value = is_string($mantranews_widgets_field_value) ? wp_kses_post($mantranews_widgets_field_value) : $mantranews_widgets_field_value;
            mantranews_widgets_show_widget_field($this, $widget_field, $mantranews_widgets_field_value);
        }
    }

}
