<?php

add_action( "wp_ajax_bizberg_install_plugins", "bizberg_install_recommended_plugins" );
function bizberg_install_recommended_plugins(){

	if ( !wp_verify_nonce( $_POST['nonce'], "bizberg_install_plugins" ) ) {
      	die;
   	}  

   	$recommended_plugins = apply_filters( 'bizberg_plugins', $plugins = array() );

   	bizberg_install_activate_plugins( $recommended_plugins );
   	update_option( 'bizberg_hide_msg', true );

   	echo 'success';

   	die;

}

function bizberg_install_activate_plugins( $recommended_plugins ){

	// Install and activate recommended plugins
	foreach ( $recommended_plugins as $key => $value ) {
		
		if ( !bizberg_is_plugin_installed( $value['slug'] ) ) {
	    	bizberg_install_plugin( 'https://downloads.wordpress.org/plugin/' . $value['zip'] . '.latest-stable.zip' );
	  	}

	    activate_plugin( $value['slug'] , '' , '' , true );

	}

}

function bizberg_is_plugin_installed( $slug ) {

  	if ( ! function_exists( 'get_plugins' ) ) {
    	require_once ABSPATH . 'wp-admin/includes/plugin.php';
  	}

  	$all_plugins = get_plugins();
   
  	if ( !empty( $all_plugins[$slug] ) ) {
    	return true;
  	} else {
    	return false;
  	}

}

function bizberg_install_plugin( $plugin_zip ) {

	$upgrader = new \Plugin_Upgrader( new Bizberg_Quiet_Skin() );

  	$installed = $upgrader->install( $plugin_zip );
 
  	return $installed;

}

include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';   	
class Bizberg_Quiet_Skin extends \WP_Upgrader_Skin {

    public function feedback( $string, ...$args )
    {
        
    }
    public function header() 
    {
        
    }
    public function footer() 
    {
       
    }

}