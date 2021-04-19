//Fixed nav on scroll
    jQuery(document).scroll(function($){
      var scrollTop = jQuery(document).scrollTop();
      if(scrollTop > jQuery('header nav').height()){
        //console.log(scrollTop);
        jQuery('header nav').addClass('navbar-fixed-top');
      }
      else {
        jQuery('header nav').removeClass('navbar-fixed-top');
      }
    });