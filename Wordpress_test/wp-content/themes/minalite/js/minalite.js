jQuery(document).ready(function($) {

	"use strict";

	// Search
	
	$('#top-search a').on('click', function ( e ) {
		e.preventDefault();
    	$('.show-search').slideToggle('fast');
    });

	// Instagram
    var $instagram_items = $('.instagram-footer .instagram-pics li');
        if ( $instagram_items.length ) {
            var $item_width = parseFloat( 100 / $instagram_items.length ).toFixed(4);
            $instagram_items.css({
                'width': $item_width + '%'
        })
    }

});