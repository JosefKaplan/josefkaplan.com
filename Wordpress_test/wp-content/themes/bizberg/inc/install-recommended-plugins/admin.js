jQuery(document).on( 'click' , '.button_wrapper_theme a.bizberg_install_plugins' , function(){

	var $this = jQuery(this);
	var nonce = $this.attr('data-nonce');
	var demo_import_page = $this.attr('data-redirect');

	jQuery.ajax({
		type : "post",
		url : ajaxurl,
		data : {
			action: "bizberg_install_plugins", 
			nonce: nonce
		},
		beforeSend: function() {
			
			$this.css({
				'pointer-events' : 'none'
			}); // Disable button

			jQuery('.theme-info-wrapper .bizberg_dismiss').css({
				'pointer-events' : 'none'
			}); // Disable button

			$this.find('span').css({
				'padding-left' : '5px'
			}).text( 'Processing ... Please wait' );

			$this.find('i.fas').show();
	    },
	    success: function() {
	     	window.location.href = demo_import_page;
	    }
	})
});