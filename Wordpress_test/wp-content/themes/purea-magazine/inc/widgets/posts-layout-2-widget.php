<?php

/**
 * Posts Layout 2 Widget
 *
 * This will show 2 columns. Each column will have one full width post and other with sub posts.
 */


if( ! class_exists('Purea_Magazine_Posts_Layout_2_Widget')) :

class Purea_Magazine_Posts_Layout_2_Widget extends WP_Widget {

	var $defaults;
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'purea_magazine_posts_layout_2_widget', // Base ID
			esc_html__( '[New] Purea Magazine: Posts Layout 2 Widget', 'purea-magazine' ), // Name
			array( 'description' => esc_html__( 'This will show 2 columns. Each column will have one full width post and other with sub posts. ', 'purea-magazine'), ) // Args
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

		$no_of_posts = ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 5;
		$section_title = ! empty( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : '';
		$category = ! empty( $instance['category'] ) ? esc_html( $instance['category'] ) : 'category';

		?>


		<div class="posts-layout-2-wrapper">
			<?php 
				if(!empty($section_title) ) { 
					?>
						<h2 class="section-title">
							<?php echo $section_title; ?>
						</h2>
					<?php 
				} 
			?>
			<div class="posts-layout-2-lists-wrapper">
				<div class="layout-2-content">
					<?php
						if("-1"==$category){
							$query = new WP_Query( array(
								'posts_per_page' 			=> $no_of_posts,
								'post_type'					=> 'post',
							) );	
						}
						else{
							$query = new WP_Query( array(
								'posts_per_page' 			=> $no_of_posts,
								'post_type'					=> 'post',
								'category__in'				=> $category
							) );
						}
						if($query-> have_posts()) : $postCount = 0;
							while( $query-> have_posts() ) : $postCount++; $query->the_post(); ?>
								<div id="post-<?php the_ID(); ?>" class="layout-2-category-post">
									<div class="layout-2-category-post-content">
										<div class="section-layout-2-area-box">
											<div class="col-first">
												<div class="layout-2-post-image">
													<?php
														if(has_post_thumbnail()) { 
															if($postCount==1 || $postCount==2 ) {
																the_post_thumbnail('purea-magazine-posts');
															}
															else{
																the_post_thumbnail('purea-magazine-posts-thumb');	
															}
														}
														else{
															$post_img_url = get_template_directory_uri().'/img/no-image.jpg';
															?><img src="<?php echo $post_img_url; ?>" alt="<?php esc_attr_e('post-image','purea-magazine'); ?>" /><?php
														}
													?>
												</div>
											</div>
											<div class="col-second">
												<div class="layout-2-area-content">
													<div class="content-wrapper">
														<div class="content">
					                                        <div class="category">
					                                            <span><?php the_category(); ?></span>
					                                        </div>
					                                        <div class="title">
					                                            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					                                        </div>
					                                        <div class="meta">
					                                            <span class="by"><?php esc_html_e('By: ','purea-magazine') ?></span><span class="author"><a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a></span><span class="separator"> | </span>
					                                            <span class="date"><?php the_time(get_option('date_format')) ?></span>
					                                            <?php esc_html(purea_magazine_posts_layout_1_after_meta()); ?>

					                                        </div>
					                                        <?php 
					                                        	if($postCount==1 || $postCount==2) {
					                                        		?>
					                                        			<div class="excerpt">
								                                        	<?php 
								                                        		if(has_excerpt()){
								                                        			if('both-sidebars'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))) {
								                                        					echo wp_trim_words( get_the_excerpt(), 15, '...' );
								                                        			}
								                                        			else{
								                                        				echo wp_trim_words( get_the_excerpt(), 50, '...' );
								                                        			}
								                                        		}
								                                        		else{
								                                        			if('both-sidebars'===esc_html(get_theme_mod('purea_magazine_home_page_layout','right-sidebar'))) {
								                                        					echo wp_trim_words( get_the_content(), 15, '...' );
								                                        			}
								                                        			else{
								                                        				echo wp_trim_words( get_the_content(), 50, '...' );
								                                        			}
								                                        			
								                                        		}
								                                        	?>
								                                        </div>
					                                        		<?php
					                                        	}
					                                        ?>  
					                                    </div>
				                                    </div>
				                                </div>
											</div>
				                        </div>
									</div>
								</div>
							<?php endwhile;
						endif;
						wp_reset_postdata();
					?>
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
	    $no_of_posts = ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 5;
		$section_title = ! empty( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : '';
		$category = ! empty( $instance['category'] ) ? esc_html( $instance['category'] ) : 'category';
	    ?>     	  	    	
		    <p>
		        <label for="<?php echo esc_attr($this->get_field_id('section_title')); ?>"><?php esc_html_e('Title:','purea-magazine'); ?></label>
		        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('section_title')); ?>" name="<?php echo esc_attr($this->get_field_name('section_title')); ?>" type="text" value="<?php echo esc_attr($section_title); ?>" />
		    </p>
		    <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'no_of_posts' )); ?>"><?php esc_html_e( 'Number of posts:', 'purea-magazine' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('no_of_posts')); ?>" type="text" value="<?php echo absint( $no_of_posts ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Choose Category', 'purea-magazine' ); ?>:</label>
				<?php wp_dropdown_categories( array( 'show_option_none' =>esc_html__('-- Select -- ','purea-magazine'),'name' => esc_attr($this->get_field_name( 'category' )), 'selected' => esc_attr($category) ) ); ?>
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
		$instance[ 'category' ] = sanitize_text_field($new_instance[ 'category' ]);
    	return $instance;
	}

}
endif;

if( ! function_exists('purea_magazine_register_posts_layout_2_widget')) :
// register widget
function purea_magazine_register_posts_layout_2_widget() {
    register_widget( 'Purea_Magazine_Posts_Layout_2_Widget' );
}
endif;

add_action( 'widgets_init', 'purea_magazine_register_posts_layout_2_widget' );
