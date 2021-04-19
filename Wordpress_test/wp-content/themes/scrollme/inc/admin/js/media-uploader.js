jQuery(document).ready(function ($){
    $(document).on('click' , '.upload-button', function(e) {
    	e.preventDefault();
        var $this = $(this);
    	var image = wp.media({ 
    		title: 'Upload Image',
    		// mutiple: true if you want to upload multiple files at once
    		multiple: false
    	}).open()
    	.on('select', function(e){
    		// This will return the selected image from the Media Uploader, the result is an object
    		var uploaded_image = image.state().get('selection').first();
    		// We convert uploaded_image to a JSON object to make accessing it easier
    		// Output to the console uploaded_image
    		var image_url = uploaded_image.toJSON().url;
    		// Let's assign the url value to the input field
    		$this.prev('.upload').val(image_url);
            
            var img = "<img src='"+image_url+"' style='width: 275px; height: auto' /><a class='remove-image remove-screenshot'>Remove</a>";
            $this.next('.screenshot').html(img);
    	});
    });
    
    $('body').on('click', ".remove-file, .remove-image", function (e) {
        $(this).parents('.widget-upload').find('.button').val('Upload');
        $(this).parents('.widget-upload').find('.button').removeClass('remove-file').addClass('upload-button');
        $(this).parents('.widget-upload').find('.upload').val('');
        $(this).parents('.widget-upload').find('.screenshot').html('');
    });
    /*
    $('.team-thumb .remove-image').on('click', function (e){
        e.preventDefault();
        alert("msg");
    });*/
});