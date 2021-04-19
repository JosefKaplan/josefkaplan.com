<?php
/**
 * Social bar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kurma_social_bar' ) ) {
	add_action( 'kurma_social_bar_action', 'kurma_social_bar' );
	function kurma_social_bar() {
		$socials_facebook_url  		=  kurma_get_setting( 'socials_facebook_url' );
		$socials_twitter_url   		=  kurma_get_setting( 'socials_twitter_url' );
		$socials_google_url    		=  kurma_get_setting( 'socials_google_url' );
		$socials_tumblr_url    		=  kurma_get_setting( 'socials_tumblr_url' );
		$socials_pinterest_url 		=  kurma_get_setting( 'socials_pinterest_url' );
		$socials_youtube_url   		=  kurma_get_setting( 'socials_youtube_url' );
		$socials_linkedin_url  		=  kurma_get_setting( 'socials_linkedin_url' );
		$socials_custom_icon_1  	=  kurma_get_setting( 'socials_custom_icon_1' );
		$socials_custom_icon_url_1  =  kurma_get_setting( 'socials_custom_icon_url_1' );
		$socials_custom_icon_2  	=  kurma_get_setting( 'socials_custom_icon_2' );
		$socials_custom_icon_url_2  =  kurma_get_setting( 'socials_custom_icon_url_2' );
		$socials_custom_icon_3  	=  kurma_get_setting( 'socials_custom_icon_3' );
		$socials_custom_icon_url_3  =  kurma_get_setting( 'socials_custom_icon_url_3' );
		$socials_mail_url     		=  kurma_get_setting( 'socials_mail_url' );
	?>
    <div class="kurma-social-bar">
    	<ul class="kurma-socials-list">
        <?php if ( $socials_facebook_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_facebook_url ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
        <?php } ?>
        <?php if ( $socials_twitter_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_twitter_url ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if ( $socials_google_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_google_url ); ?>" target="_blank"><i class="fa fa-google"></i></a></li>
        <?php } ?>
        <?php if ( $socials_tumblr_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_tumblr_url ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
        <?php } ?>
        <?php if ( $socials_pinterest_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_pinterest_url ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
        <?php } ?>
        <?php if ( $socials_youtube_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_youtube_url ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
        <?php } ?>
        <?php if ( $socials_linkedin_url != '' ) { ?>
        	<li><a href="<?php echo esc_url( $socials_linkedin_url ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if ( ( $socials_custom_icon_1 != '' ) && ( $socials_custom_icon_url_1 != '' ) ) { ?>
        	<li><a href="<?php echo esc_url( $socials_custom_icon_url_1 ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_custom_icon_1 ); ?>"></i></a></li>
        <?php } ?>
        <?php if ( ( $socials_custom_icon_2 != '' ) && ( $socials_custom_icon_url_2 != '' ) ) { ?>
        	<li><a href="<?php echo esc_url( $socials_custom_icon_url_2 ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_custom_icon_2 ); ?>"></i></a></li>
        <?php } ?>
        <?php if ( ( $socials_custom_icon_3 != '' ) && ( $socials_custom_icon_url_3 != '' ) ) { ?>
        	<li><a href="<?php echo esc_url( $socials_custom_icon_url_3 ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_custom_icon_3 ); ?>"></i></a></li>
        <?php } ?>
        <?php if ( $socials_mail_url != '' ) { ?>
        	<li><a href="mailto:<?php echo esc_attr( $socials_mail_url ); ?>"><i class="fa fa-envelope"></i></a></li>
        <?php } ?>
        </ul>
    </div>    
	<?php
	}
}
