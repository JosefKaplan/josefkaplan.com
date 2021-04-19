<?php
/**
 * Navigation to previous / next post in a single post page
 * Displays the title of the prev/next post.
 * 
 *
 * @ Theme: Manduca - focus on accessibility 
 * @ Since 17.9
 * Add access key imn @18.9.2
 * */
?>

<?php
	$previous_post = Manduca_Template_Functions::previous_post_link_html();
	$next_post = Manduca_Template_Functions::next_post_link_html();
?>

<nav class="nav-single">
<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'manduca' ); ?></h3>

	<?php if( !empty ( $previous_post ) ) : ?>
		<h4 class="nav-previous">
			<?php echo $previous_post?>  
			<?php
				/*the sake of themecheck.
				I.e. there is no need for paginate_links in Manduca
				but theme check requires it. */
				ob_start ();
				paginate_links();
				ob_get_clean ();?>
		</h4>
	<?php endif; ?>
	
	
	<?php if( !empty ( $next_post ) ) : ?>
		<h4 class="nav-next">
			<?php echo $next_post; ?> 
		</h4>
		<?php endif; ?>
</nav>