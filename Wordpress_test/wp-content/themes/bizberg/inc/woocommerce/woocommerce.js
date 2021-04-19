jQuery(window).on( 'load resize', function(){

	setTimeout(function(){ 

		if( jQuery(window).width() > 567 && !jQuery('.products').hasClass('related') ){
			jQuery('.products').masonry({
	           itemSelector: '.product',
	           transitionDuration: 0
	        }); 
		} else {
			jQuery('.products').masonry({
                transitionDuration: 0
            });
			jQuery('.products').masonry('destroy');
			jQuery('.products').removeData('masonry');
		}       

    }, 1000); 

});

jQuery( document ).on( 'click' , '.bizberg-shop-quantity button.plus', function(){

	var cart_quantity_input = jQuery(this).closest('.bizberg-shop-quantity').find('input');

	var input_quantity;
	if( jQuery.isNumeric( cart_quantity_input.val() ) ){
		input_quantity = cart_quantity_input.val();
	} else {
		input_quantity = 0;
	}

	var max = cart_quantity_input.attr( 'max' );
	if( jQuery.isNumeric( max ) ){
		max = max;
	} else {
		max = 99999;
	}

	cart_quantity = parseInt( input_quantity ) + 1;

	if( cart_quantity <= max ){
		cart_quantity_input.val( cart_quantity );
	}

	jQuery('.woocommerce-cart .woocommerce-cart-form button[name="update_cart"]').prop( 'disabled' , false );

});

jQuery( document ).on( 'click' , '.bizberg-shop-quantity button.minus', function(){

	var cart_quantity_input = jQuery(this).closest('.bizberg-shop-quantity').find('input');

	var min = cart_quantity_input.attr( 'min' );
	if( jQuery.isNumeric( min ) ){
		min = min;
	} else {
		min = 0;
	}

	var input_quantity;
	if( jQuery.isNumeric( cart_quantity_input.val() ) ){
		input_quantity = cart_quantity_input.val();
	} else {
		input_quantity = 0;
	}

	cart_quantity = parseInt( input_quantity ) - 1;

	if( cart_quantity >= min ){
		cart_quantity_input.val( cart_quantity );
	}

	jQuery('.woocommerce-cart .woocommerce-cart-form button[name="update_cart"]').prop( 'disabled' , false );
	
});

jQuery(document).ready(function(){
   	jQuery('[data-toggle="tooltip"]').tooltip();   
});

jQuery(document).on( 'click', '.menu-ham', function () {
    jQuery('.menu').animate({right: '0px'}, 50)
    jQuery('.header_sidemenu_in .overlay').addClass('show').removeClass('hide');
});

jQuery(document).on( 'click', '.close-menu', function () {
    jQuery('.menu').animate({right: '-500px'}, 50)
    jQuery('.header_sidemenu_in .overlay').addClass('hide').removeClass('show');
});

jQuery(document).on( 'click', '.header_sidemenu_in .overlay', function () {
    jQuery('.header_sidemenu_in .overlay').addClass('hide').removeClass('show');
    jQuery('.menu').animate({right: '-500px'}, 50)
});