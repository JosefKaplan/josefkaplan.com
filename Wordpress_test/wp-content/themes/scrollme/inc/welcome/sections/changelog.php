<?php
/**
* Changelog
*/
?>
<div class="featured-section changelog">
<?php
	WP_Filesystem();
	global $wp_filesystem;
	$themechangelog     = $wp_filesystem->get_contents( get_template_directory() . '/readme.txt' );
	$changelog_start 			= strpos($themechangelog,'== Changelog ==');
	$themechangelog_before = substr($themechangelog,0,($changelog_start));
	$themechangelog = str_replace($themechangelog_before,'',$themechangelog);
	$themechangelog = str_replace('== Changelog ==','<h2>== Changelog ==</h2>',$themechangelog);
	$themechangelog = str_replace('**','<br/>**',$themechangelog);
	for($i=0; $i<10; $i++){
		$themechangelog = str_replace('= '.$i.'.','<br/><br/>= '.$i.'.',$themechangelog);
	}
	echo ''.wp_kses_post($themechangelog);
	echo '<hr />';
	?>
</div>

