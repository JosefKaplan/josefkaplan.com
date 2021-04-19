<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
$body_class = ''; 
if( function_exists( 'bizberg_get_homepage_style_class' ) ){
	$body_class = bizberg_get_homepage_style_class();
}
?>

<body <?php body_class( 'bizberg sidebar ' . $body_class ); ?>>

<?php 

/**
* https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook/
*/

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else { 
	do_action( 'wp_body_open' ); 
}

do_action( 'bizberg_after_body' );

$primary_header_layout = bizberg_get_theme_mod( 'primary_header_layout' ); ?>

<header id="masthead" class="primary_header_<?php echo esc_attr( $primary_header_layout ); ?>">

	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'bizberg' ); ?>		
	</a>

	<?php 
	do_action( 'bizberg_top_header' );
	?>

	<?php 

	$header_2_position = bizberg_get_theme_mod( 'header_2_position' );
	$flex_container = 'bizberg-flex-container';
	$primary_header_layout_width = bizberg_get_theme_mod( 'primary_header_layout_width' );

	$header_columns = bizberg_get_theme_mod( 'header_columns' );
	$header_columns_class = explode( '|' , $header_columns );

	$header_columns_middle_style = bizberg_get_theme_mod( 'header_columns_middle_style' );
	$header_columns_middle_style_class = explode( '|' , $header_columns_middle_style );

	$last_item_header = bizberg_get_theme_mod( 'last_item_header' );
	if( $last_item_header == 'none' ){
		$header_columns_class = array( 'col-sm-7' , 'col-sm-5' );
	}

	if( $primary_header_layout == 'center' ){ ?>

		<div class="primary_header_2_wrapper <?php echo esc_attr( $primary_header_layout_width == "100%" ? 'full_width' : '' ); ?>">

			<div class="container <?php echo esc_attr( $flex_container ); ?>">

				<div class="row <?php echo esc_attr( $flex_container ); ?>">

					<?php

					if( $header_2_position == 'left' ){ ?>

						<div class="<?php echo esc_attr( $header_columns_class[0] ); ?>">
							<div class="primary_header_2">
								<?php bizberg_get_primary_header_logo(); ?>
					   		</div>
					   	</div>
					   	<div class="<?php echo esc_attr( $header_columns_class[1] ); ?>">
					   		<div class="custom_header_content">
					   			<?php bizberg_get_last_item_header(); ?>
					   		</div>
					   	</div>

					   	<?php

					} else { ?>

						<div class="<?php echo esc_attr( $header_columns_middle_style_class[0] ); ?>">
							<div class="custom_header_content_logo_center left">
					   			<?php bizberg_get_first_item_header_logo_center(); ?>
					   		</div>
						</div>

						<div class="<?php echo esc_attr( $header_columns_middle_style_class[1] ); ?>">
							<div class="primary_header_2">
								<?php bizberg_get_primary_header_logo(); ?>
					   		</div>
					   	</div>

					   	<div class="<?php echo esc_attr( $header_columns_middle_style_class[2] ); ?>">
					   		<div class="custom_header_content_logo_center right">
					   			<?php bizberg_get_last_item_header_logo_center(); ?>
					   		</div>
					   	</div>

						<?php

					} ?>

				</div>

			</div>

		</div>		

		<?php
	} ?>

    <nav class="navbar navbar-default with-slicknav">

        <div id="navbar" class="collapse navbar-collapse navbar-arrow">

            <div class="container">

            	<div class="bizberg_header_wrapper">

	                <?php 	                
	                
	                bizberg_get_primary_header_logo();	                	               

	                if( has_nav_menu( 'menu-1' ) ){

	                	$walker = new Bizberg_Menu_With_Description;
	                	wp_nav_menu( array(
						    'theme_location' => 'menu-1',
						    'menu_class'=>'nav navbar-nav pull-right',
						    'container' => 'ul',
						    'menu_id' => 'responsive-menu',
						    'walker' => $walker,
						    'link_before' => '<span class="eb_menu_title">',
						    'link_after' => '</span>'
						) );

	                } else {

	                	wp_nav_menu( array(
						    'theme_location' => 'menu-1',
						    'menu_class'=>'nav navbar-nav pull-right',
						    'container' => 'ul',
						    'menu_id' => 'responsive-menu',
						    'link_before' => '<span class="eb_menu_title">',
						    'link_after' => '</span>'
						) );
						
	                }
	                
	                ?>

	            </div>

            </div>

        </div><!--/.nav-collapse -->

        <div id="slicknav-mobile" class="<?php echo ( !has_custom_logo() ? 'text-logo' : '' ); ?>"></div>

    </nav> 
</header><!-- header section end -->

<?php 
global $template; // For elementor
if( is_page_template( 'page-templates/full-width.php' ) 
	|| is_404() 
	|| is_page_template( 'contact-us.php' )
	|| is_page_template( 'page-templates/page-fullwidth-transparent-header.php' )
	|| is_page_template( 'page-template/home.php' )
	|| basename($template) == 'header-footer.php' ){
	// no breadcrum
	echo '';
} elseif( ! ( is_front_page() || is_home() ) ){
	bizberg_get_breadcrums();
} else { 

	$status = bizberg_get_theme_mod( 'slider_banner' );
	switch ( $status ) {
		case 'slider':
			bizberg_get_slider_1();
			break;

		case 'banner':
			bizberg_get_banner();
			break;

		case 'video':
			bizberg_get_video();
			break;
		
		default:
			# code...
			break;
	}

} 