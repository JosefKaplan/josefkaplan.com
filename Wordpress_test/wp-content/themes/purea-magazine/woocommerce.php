<?php
/**
 * @package purea-magazine
 */

get_header();
purea_magazine_before_title();
purea_magazine_after_title();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    	<div class="content-inner">
    		<div class="page-content-area">
		        <?php
		            get_template_part( 'template-parts/shop/content', 'woocommerce' );           
		        ?>
	    	</div>
	    </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
	get_footer();
?>