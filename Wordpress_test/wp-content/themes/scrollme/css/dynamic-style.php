<?php
    /* Dyanmic Styles **/
    if( !function_exists( 'scrolme_lively_styles' ) ) {
        function scrolme_lively_styles() {
            
            $custom_css = "";
            $tpl_color = get_theme_mod( 'scrollme_tpl_color', '#df2c45' );
            $tpl_color_rgbs = scrollme_hex2rgb( $tpl_color );
            
            if( $tpl_color ) {
                
                /** Background Color **/
                $custom_css .= "
                .main-navigation li:hover > a,
                .main-navigation li.current-menu-item > a,
                .port-link-wrap a,
                .banner-btn a.btn,
                .sl-blog-post-excerpt .sl-blog-readmore,
                button, input[type=\"button\"],
                input[type=\"reset\"],
                input[type=\"submit\"]{
                   background: {$tpl_color}; 
                }";
                
                /** Background Color (0.8 Opacity)) **/
                $custom_css .= ".page-template-tpl-home #toggle{
                   background: rgba($tpl_color_rgbs[0], $tpl_color_rgbs[1], $tpl_color_rgbs[2], 0.8);
                }";
                
                /** Box Shadow (0.5 Opacity) **/
                $custom_css .= ".page-template-tpl-home #toggle{
                   box-shadow: 0px 0px 0 2px rgba($tpl_color_rgbs[0], $tpl_color_rgbs[1], $tpl_color_rgbs[2], 0.5);
                }";
                
                /** Color **/
                $custom_css .= "
                h1.entry-title a:hover, h1.entry-title span,
                .feature-box-container h3 a:hover,
                .service-tab.sm-active h3,
                a,
                .widget-area a:hover,
                .sl-blog-post-excerpt h5 a:hover,
                h1.site-title a{
                    color: {$tpl_color};    
                }";
                
                /** Border **/
                $custom_css .= "
                .slider-section .bx-pager-item a,
                .entry-header,
                .service-content-wrap,
                button, input[type=\"button\"],
                input[type=\"reset\"],
                input[type=\"submit\"]{
                    border-color: {$tpl_color};
                }";

                /** Box Shadow Color **/
                $custom_css .= "
                    @media screen and (max-width: 1000px){
                        .toggle-nav span{
                            background: {$tpl_color} !important;
                            box-shadow: 0 10px 0px 0px {$tpl_color}, 0 -10px 0px 0px {$tpl_color} !important;
                        }
                    }";
            }
            
            wp_add_inline_style( 'scrollme-style', $custom_css );
        }
        add_action( 'wp_enqueue_scripts', 'scrolme_lively_styles' );

    }
    
    function scrollme_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }