<?php

function bizberg_kirki_dtm_options( $data ){

	$data['settings'] = !empty( $data['settings'] ) ? $data['settings'] : wp_generate_password( 12, false, false );

	Kirki::add_field( $data['field_id'], [
		'type'        => 'custom',
		'settings'    => 'custom_setting_' . esc_attr( $data['settings'] ),
		'section'     => $data['section'],
		'default'     => bizberg_kirki_dtm_icons( $data ),
		'active_callback' => $data['global_active_callback']
	] );

	if( !empty( $data['fields'] ) ){

		foreach ( $data['fields'] as $key => $field ) {

			switch ( $key ) {

				case 'number':
				case 'slider':
				case 'dimension':
				case 'dimensions':
				case 'typography':
					
					if( !empty( $data['display'] ) ):

						foreach ( $data['display'] as $device ):
							
							$options = $field[$device];						
							$options['type'] = $key; // number / slider
							$options['settings'] = 'number_setting_' . $device . '_' . $field[$device]['settings'];
							$options['section'] = $data['section'];
							$options['active_callback'] = $data['global_active_callback'];

							Kirki::add_field( $data['field_id'], $options );

						endforeach;

					endif;

					break;
				
				default:
					# code...
					break;
			}

		}

	}

}

function bizberg_kirki_parent_control_key( $data , $device ){

	if ( array_key_exists( 'number' , $data['fields'] ) ) {
	 	return 'customize-control-number_setting_' . $device . '_' . $data['fields']['number'][$device]['settings'];
	}

	if ( array_key_exists( 'slider' , $data['fields'] ) ) {
	 	return 'customize-control-number_setting_' . $device . '_' . $data['fields']['slider'][$device]['settings'];
	}

	if ( array_key_exists( 'dimension' , $data['fields'] ) ) {
	 	return 'customize-control-number_setting_' . $device . '_' . $data['fields']['dimension'][$device]['settings'];
	}

	if ( array_key_exists( 'dimensions' , $data['fields'] ) ) {
	 	return 'customize-control-number_setting_' . $device . '_' . $data['fields']['dimensions'][$device]['settings'];
	}

	if ( array_key_exists( 'typography' , $data['fields'] ) ) {
	 	return 'customize-control-number_setting_' . $device . '_' . $data['fields']['typography'][$device]['settings'];
	}

}

function bizberg_kirki_dtm_icons( $data ){ 

	ob_start(); ?>

	<div class="kirki_dtm_icons">

		<?php 

		if( !empty( $data['display'] ) ){

			foreach ( $data['display'] as $key => $value ) {
				
				switch ( $value ) {

					case 'desktop':
						echo '<a data-device="desktop" data-link="' . bizberg_kirki_parent_control_key( $data , 'desktop' ) . '" href="javascript:void(0)" class="desktop_icon ' . ( array_keys( $data['display'] )[0] == 'desktop' ? ' active' : '' ) . '">
							<span class="dashicons dashicons-laptop"></span>
						</a>';
						break;

					case 'tablet':
						echo '<a data-device="tablet" data-link="' . bizberg_kirki_parent_control_key( $data , 'tablet' ) . '" href="javascript:void(0)" class="tablet_icon' . ( array_keys( $data['display'] )[0] == 'tablet' ? ' active' : '' ) . '">
							<span class="dashicons dashicons-tablet"></span>
						</a>';
						break;

					case 'mobile':
						echo '<a data-device="mobile" data-link="' . bizberg_kirki_parent_control_key( $data , 'mobile' ) . '" href="javascript:void(0)" class="mobile_icon ' . ( array_keys( $data['display'] )[0] == 'mobile' ? ' active' : '' ) . '">
							<span class="dashicons dashicons-smartphone"></span>
						</a>';
						break;
					
					default:
						# code...
						break;
				}

			}

		} ?>

	</div>

	<style type="text/css">
		
		li#customize-control-custom_setting_<?php echo esc_attr( $data['settings'] ); ?> label {
		    pointer-events: all;
		}

		li#customize-control-custom_setting_<?php echo esc_attr( $data['settings'] ); ?>{
			z-index: 1;
    		position: relative;
    		margin-top: 10px;
		}

		<?php echo bizberg_kirki_dtm_hide_tablet_mobile( $data ); ?>

	</style>

	<?php

	return ob_get_clean();
}

function bizberg_kirki_dtm_hide_tablet_mobile( $data ){

	ob_start();
	$inline_css = '';

	foreach ( $data['fields'] as $key => $field ):

		$devices = $data['display'];

		// Remove first element from array
		array_shift($devices);

		switch ( $key ) {

			case 'number':
			case 'slider':
			case 'dimension':
			case 'dimensions':
			case 'typography':

				foreach ( $devices as $device ): 

					echo '#customize-control-number_setting_' . esc_attr( $device ) . '_' . esc_attr( $field[$device]['settings'] ) . ' {
						display: none !important;
					}';	

				endforeach;

				break;

		}

	endforeach;

	echo '#customize-control-custom_setting_' . esc_attr( $data['settings'] ) . ' .kirki_dtm_icons a.active {
		background: #0073aa;
	}';

	echo '#customize-control-custom_setting_' . esc_attr( $data['settings'] ) . ' .kirki_dtm_icons a.active span {
		color: #fff;
	}';

	return ob_get_clean();

}