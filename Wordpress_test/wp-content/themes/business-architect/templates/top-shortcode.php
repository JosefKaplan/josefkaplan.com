<?php 
$business_architect_shortcode = get_theme_mod('header_shortcode', '');
if($business_architect_shortcode !='') { 

?>
<section id="booking-shortcode">
	<div class="center-text">
		<?php 
			echo do_shortcode( wp_kses_post($business_architect_shortcode) );	
		?>
	</div>
</section>

<?php
} 

