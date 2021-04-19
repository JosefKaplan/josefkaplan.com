jQuery(document).on( 'click' , '.kirki_dtm_icons a' , function(){
	
	jQuery(this).closest( '.kirki_dtm_icons' ).find('a').each(function(){

		var hide_ID = jQuery(this).attr('data-link');	

		// Hide all fields
		jQuery( '#' + hide_ID ).attr( 'style' , 'display:none !important' );

		// Remove active class
		jQuery(this).removeClass('active');

	});

	// Show only clicked field
	var control_id = jQuery(this).attr('data-link');
	jQuery( '#' + control_id ).attr( 'style' , 'display:block !important' );

	// Add active class on clicked
	jQuery(this).addClass('active');

	// Get which device to show
	var device = jQuery(this).attr('data-device');
	change_screen_size( device );

});

function change_screen_size( device ){

	switch( device ){

		case 'desktop':		
			customizer_desktop_view();
			break;

		case 'tablet':
			customizer_tablet_view();
			break;

		default:
			customizer_mobile_view()
			break;

	}

}

function customizer_desktop_view(){
    jQuery('button.preview-desktop').click();
}

function customizer_tablet_view(){
	jQuery('button.preview-tablet').click();
}

function customizer_mobile_view(){
	jQuery('button.preview-mobile').click();
}