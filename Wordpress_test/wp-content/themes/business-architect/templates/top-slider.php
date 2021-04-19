<?php
/**
 * Displays home slider
 * @package business-idea
 * @sub-package business-architect
 * @since 1.0
 */


business_architect_slider();

function business_architect_slider(){
?>
<section id="slider-section">
	<div>
		<div>

<?php

$business_architect_slider_cat = get_theme_mod('slider_category' , 0);
$business_architect_animation_type = get_theme_mod('slider_animation_type' , '');
$business_architect_slider_speed = get_theme_mod('slider_speed' , '');
$business_architect_image_height = get_theme_mod('slider_image_height' , '600');
$business_architect_button_text = get_theme_mod('slider_button_text' , esc_html__('Read More', 'business-architect'));

//set query args to show specified amount or show all posts from particular category. 
$count = 0;
$args = array ( 'post_type' => 'post', 'posts_per_page'=> 3 , 'cat'=> $business_architect_slider_cat , 'order' => 'DESC');

			
$loop = new WP_Query($args);
$count = $loop->post_count;


if($count==0): 

if ( class_exists( 'WP_Customize_Control' ) ) {
?>

<div id="featured_slider" class="carousel slide" >

<img src="<?php echo esc_url(get_template_directory_uri().'/images/header.jpg'); ?>" alt="<?php esc_attr_e('No Image','business-architect'); ?>" >
			<div class="carousel-caption custom-settings">
				<h1 class="slider-title"><?php esc_html_e('Create a page from home-page template and start customizing','business-architect'); ?></h1>
			</div>
</div>
<?php } ?>			
<?php else: ?>

<div id="featured_slider" class="carousel slide <?php if( $business_architect_animation_type =='fade' ){ echo 'carousel-' . 'fade'; } ?>" data-ride="carousel"  data-interval="<?php echo absint($business_architect_slider_speed); ?>">
	<div>
	<?php if($count>1): ?>
	  <ol class="carousel-indicators">
		<?php 
				$j = 0;			
				for ($j = 0; $j < $count; $j++):							
		?>
		<li data-target="#featured_slider" data-slide-to="<?php echo absint($j); ?>" class="<?php if($j==0){ echo 'active'; }  ?>"></li>
		<?php								
				endfor;
		?>
	  </ol>
	 <?php endif; ?>
    </div>

  <div class="carousel-inner" role="listbox">
    <?php 
		  $i = 0;
		  while( $loop->have_posts() ) : $loop->the_post();		  
			
    ?>
    <div class="item <?php if($i==0){ echo 'active'; } $i++; ?> "> 
	<?php 
	$thumb_id = $url = $my_title = '';
	$alt = '';
	$thumb_id = get_post_thumbnail_id(get_the_ID());	
	$my_title = esc_html(get_the_title());
	$post_link = get_permalink( get_the_ID() );
	if( has_post_thumbnail() ):
		$url = esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
		$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
	else:
		$url = esc_url(get_template_directory_uri().'/images/header.jpg');
	endif;
	?>
	<div style="background:url(<?php echo esc_url($url); ?>) no-repeat;background-position:center center;background-size:cover;height:<?php echo absint($business_architect_image_height); ?>px;" alt="<?php echo esc_attr($alt); ?>" ></div>	     
	  <div class="sectionoverlay" >
	  <div class="carousel-caption custom-settings">
        <?php
						
			echo ('<p class="slider-title">'.esc_html($my_title).'</p>');
			$content = wp_trim_words( get_the_content(), 70, ' [...]' );
			echo '<p>'.esc_html($content).'</p>';
			if($business_architect_button_text !='') {
				echo '<br/><a class="call-to-action" href="'.esc_url(get_the_permalink()).'" >'.esc_html($business_architect_button_text).'</a>';
			}	
		?>
      </div>
	  </div>	
    </div>
    <?php
		endwhile;
		wp_reset_postdata();
		if(get_theme_mod('slider_shape_devider' , 0)){
	?>
	
		<svg class="section_divider" viewBox="0 24 150 28" preserveAspectRatio="none">
		<defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/></defs>
		<g class="section_divider_parallax">
		   <use xlink:href="#gentle-wave" x="50" y="6" fill="#fff"/>  
		  </g>
		</svg>
	
	<?php } ?>

</div>
	<?php if($count>1): ?>
			<ul class="carousel-navigation">
				<li><a class="carousel-prev" href="#featured_slider" data-slide="prev"></a></li>
				<li><a class="carousel-next" href="#featured_slider" data-slide="next"></a></li>
			</ul>
	<?php endif; ?> 
	<?php endif; ?>

   </div>
  </div>

 </div>
</section>

<?php
}

