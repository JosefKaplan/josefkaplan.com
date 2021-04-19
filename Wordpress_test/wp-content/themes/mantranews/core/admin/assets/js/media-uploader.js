jQuery(document).ready(function($){

   var mantranews_upload;
   var mantranews_selector;

   function mantranews_add_file(event, selector) {

      var upload = $(".uploaded-file"), frame;
      var $el = $(this);
      mantranews_selector = selector;

      event.preventDefault();

      // If the media frame already exists, reopen it.
      if ( mantranews_upload ) {
         mantranews_upload.open();
      } else {
         // Create the media frame.
         mantranews_upload = wp.media.frames.mantranews_upload =  wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),

            // Customize the submit button.
            button: {
               // Set the text of the button.
               text: $el.data('update'),
               // Tell the button not to close the modal, since we're
               // going to refresh the page when the image is selected.
               close: false
            }
         });

         // When an image is selected, run a callback.
         mantranews_upload.on( 'select', function() {
            // Grab the selected attachment.
            var attachment = mantranews_upload.state().get('selection').first();
            mantranews_upload.close();
            mantranews_selector.find('.upload').val(attachment.attributes.url);
            if ( attachment.attributes.type == 'image' ) {
               mantranews_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '" style="width:100%;">').slideDown('fast');
            }
            mantranews_selector.find('.wid-upload-button').unbind().addClass('wid-remove-file').removeClass('wid-upload-button').val(mantranews_l10n.remove);
            mantranews_selector.find('.of-background-properties').slideDown();
            mantranews_selector.find('.remove-image, .wid-remove-file').on('click', function() {
               mantranews_remove_file( $(this).parents('.section') );
            });
         });
      }

      // Finally, open the modal.
      mantranews_upload.open();
   }

   function mantranews_remove_file(selector) {
      selector.find('.remove-image').hide();
      selector.find('.upload').val('');
      selector.find('.of-background-properties').hide();
      selector.find('.screenshot').slideUp();
      selector.find('.wid-remove-file').unbind().addClass('wid-upload-button').removeClass('wid-remove-file').val(mantranews_l10n.upload);
      // We don't display the upload button if .upload-notice is present
      // This means the user doesn't have the WordPress 3.5 Media Library Support
      if ( $('.section-upload .upload-notice').length > 0 ) {
         $('.upload-button').remove();
      }
      selector.find('.upload-button').on('click', function(event) {
         mantranews_add_file(event, $(this).parents('.sub-option'));
      });
   }

   $('body').on('click', '.remove-image, .wid-remove-file', function() {
      mantranews_remove_file( $(this).parents('.sub-option') );
    });

    $('body').on('click', '.wid-upload-button', function( event ) {
      mantranews_add_file(event, $(this).parents('.sub-option'));
    });

});