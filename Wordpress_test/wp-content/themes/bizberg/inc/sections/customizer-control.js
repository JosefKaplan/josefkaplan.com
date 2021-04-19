(function() {

    wp.customize.bind('ready', function() {

        wp.customize.control('slider_banner', function(control) {

            // When Page Refresh
            if (control.params.value != 'slider') {
                jQuery('#customize-control-read_more_section_title, #customize-control-paginations_options, #customize-control-font_section_title, #customize-control-slider_height, #customize-control-opacity_slider, #customize-control-slider_shape_divider, #customize-control-slider_title_options').attr('style', 'display: none !important');
            } else {
                jQuery('#customize-control-read_more_section_title, #customize-control-paginations_options, #customize-control-font_section_title, #customize-control-slider_height, #customize-control-opacity_slider, #customize-control-slider_shape_divider, #customize-control-slider_title_options').attr('style', 'display: block !important');
            }

            /**
            * For Banner
            */

            if (control.params.value == 'banner') {
                jQuery('#customize-control-banner_image_options').attr('style', 'display: block !important');
            } else {
                jQuery('#customize-control-banner_image_options').attr('style', 'display: none !important');  
            }

            // When user change the data
            control.setting.bind(function(value) {

                if (value != 'slider') {
                    jQuery('#customize-control-read_more_section_title, #customize-control-paginations_options, #customize-control-font_section_title, #customize-control-slider_height, #customize-control-opacity_slider, #customize-control-slider_shape_divider, #customize-control-slider_title_options').attr('style', 'display: none !important');
                } else {
                    jQuery('#customize-control-read_more_section_title, #customize-control-paginations_options, #customize-control-font_section_title, #customize-control-slider_height, #customize-control-opacity_slider, #customize-control-slider_shape_divider, #customize-control-slider_title_options').attr('style', 'display: block !important');
                }

                /**
                * For Banner
                */

                if (value == 'banner') {
                    jQuery('#customize-control-banner_image_options').attr('style', 'display: block !important');
                } else {
                    jQuery('#customize-control-banner_image_options').attr('style', 'display: none !important');  
                }

            });

        });

        bizberg_customizer_desktop_view( 'slider_height_desktop' );
        bizberg_customizer_tablet_view( 'slider_height_tablet' );
        bizberg_customizer_mobile_view( 'slider_height_mobile' );

        bizberg_customizer_mobile_view( 'slider_title_font_mobile' );

        bizberg_customizer_tablet_view( 'typography_h1_tablet' );
        bizberg_customizer_mobile_view( 'typography_h1_mobile' );

        bizberg_customizer_tablet_view( 'typography_h2_tablet' );
        bizberg_customizer_mobile_view( 'typography_h2_mobile' );

        bizberg_customizer_tablet_view( 'typography_h3_tablet' );
        bizberg_customizer_mobile_view( 'typography_h3_mobile' );

        bizberg_customizer_tablet_view( 'typography_h4_tablet' );
        bizberg_customizer_mobile_view( 'typography_h4_mobile' );

        bizberg_customizer_tablet_view( 'site_title_font_tablet' );
        bizberg_customizer_mobile_view( 'site_title_font_mobile' );

        bizberg_customizer_tablet_view( 'site_tagline_font_tablet' );
        bizberg_customizer_mobile_view( 'site_tagline_font_mobile' );

        bizberg_customizer_desktop_view( 'site_tagline_font_sticky_menu' );
        bizberg_customizer_desktop_view( 'site_title_font_sticky_menu' );

    });

})();

function bizberg_customizer_desktop_view( $field ){

    wp.customize.control( $field , function(control) {

        // When user change the data
        control.setting.bind(function(value) {
            jQuery('button.preview-desktop').click();
        });

    });

}

function bizberg_customizer_tablet_view( $field ){

    wp.customize.control( $field , function(control) {

        // When user change the data
        control.setting.bind(function(value) {
            jQuery('button.preview-tablet').click();
        });

    });

}

function bizberg_customizer_mobile_view( $field ){

    wp.customize.control( $field , function(control) {

        // When user change the data
        control.setting.bind(function(value) {
            jQuery('button.preview-mobile').click();
        });

    });

}