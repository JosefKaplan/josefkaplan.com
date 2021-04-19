<?php 
$business_architect_banner = get_theme_mod('banner_image', '');
if($business_architect_banner !='') {
?>
<section id="top-banner" style="text-align:center">
	<div class="center-text" >
		<?php 
			echo '<a href="'.esc_url(get_theme_mod('banner_link', '#')).'" ><img src="'.esc_url($business_architect_banner).'" /></a>';	
		?>
	</div>
</section>
<?php
} 

