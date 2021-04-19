<?php
class consultus_Search_Widget extends WP_Widget {

	/**
	 * Setup the widget options
	 * @since 1.0
	 */
	public function __construct() {
	
		// set widget options
		$options = array(
			'classname'   => 'consultus_Search_Widget', // CSS class name
			'description' => esc_html__( 'WooCommerce Search [With Categories]', 'consultus' ),
		);
		
		// instantiate the widget
		parent::__construct( 'consultus_Search_Widget', esc_html__( 'Pro- WooCommerce Search Widget', 'consultus' ), $options );
	}
	
	

	public function widget( $args, $instance ) {
		
		// get the widget configuration
		$title = "";
		if(isset($instance['title'])) $title = $instance['title'];
				
		if ( $title ) {
			echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);
		}

		?>
		<div class="row">
		<div class="col-sm-12">
			<div class="woo-search">
			  <?php if ( class_exists( 'WooCommerce' ) ) { ?>
			  <div class="header-search-form">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				  <select class="header-search-select" name="product_cat">
					<option value="">
					<?php esc_html_e( 'Categories', 'consultus' ); ?>
					</option>
					<?php
									/*
									 * @package envo-ecommerce
									 * @subpackage consultus
									 */
									$args = array(
										'taxonomy'     => 'product_cat',
										'orderby'      => 'date',
										'order'      	=> 'ASC',
										'show_count'   => 1,
										'pad_counts'   => 0,
										'hierarchical' => 1,
										'title_li'     => '',
										'hide_empty'   => 1,
									);
									$categories = get_categories( $args);
									foreach ( $categories as $category ) {
										$option = '<option value="' . esc_attr( $category->category_nicename ) . '">';
										$option .= esc_html( $category->cat_name );
										$option .= ' (' . absint( $category->category_count ) . ')';
										$option .= '</option>';
										echo wp_kses_post($option); 
									}
									?>
				  </select>
				  <input type="hidden" name="post_type" value="product" />
				  <input class="header-search-input" name="s" type="text" placeholder="<?php esc_attr_e( 'Search products...', 'consultus' ); ?>"/>
				  <button class="header-search-button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			  </div>
			  <?php } ?>
			</div>
			</div>
		</div>
		<?php
		
	}
	


	public function update( $new_instance, $old_instance ) {
	
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}
	

	public function form( $instance ) {
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'consultus' ) ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' ); ?>" />
		</p>
		
		<?php
	}
	
} 
