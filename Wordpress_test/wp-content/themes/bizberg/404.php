<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bizberg
 */

get_header(); ?>

<div class="breadcrumb-wrapper error-section">
	<div class="container">
	    <div class="section-title">
	        <h1><?php esc_html_e( '404', 'bizberg' ); ?></h1>
	        <p><?php esc_html_e( 'OOPS! - Could not Find it', 'bizberg' ); ?></p> 
	         <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Home' , 'bizberg' ); ?></a>  
	    </div>
    </div>
    <div class="overlay"></div>
</div>

<?php
get_footer();
