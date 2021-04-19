/* --------------------------------------
=========================================
Quality Construction
Version: 1.0.0
Designed By: Canyon Themes
=========================================
*/

(function ($) {
	"use strict";

    jQuery(document).ready(function($){
	    
		//carousel active
        $(".carousel-inner .item:first-child").addClass("active");
		
		
			
			 //Portfolio Popup
    $('.magnific-popup').magnificPopup({type:'image'});
				
    });

   
	//Wow js
	new WOW().init();
	 
}(jQuery));	


 jQuery(window).load(function(){

    //Portfolio container     
    var $container = jQuery('.portfolioContainer');
    $container.isotope({
      filter: '*',
      animationOptions: {
        duration: 750,
        easing: 'linear',
        queue: false
      }
    });
 
    jQuery('.portfolioFilter a').on('click', function(){
      jQuery('.portfolioFilter a').removeClass('current');
      jQuery(this).addClass('current');
   
      var selector = jQuery(this).attr('data-filter');
         $container.isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: 'linear',
          queue: false
        }
       });
       return false;
    }); 

  });