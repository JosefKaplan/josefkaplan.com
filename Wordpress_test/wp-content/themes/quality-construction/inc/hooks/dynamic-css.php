<?php
/**
 * Dynamic css
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('quality_construction_dynamic_css') ):
    function quality_construction_dynamic_css(){

    $quality_construction_top_header_color = esc_attr( quality_construction_get_option('quality_construction_top_header_background_color') );

    $quality_construction_top_footer_color = esc_attr( quality_construction_get_option('quality_construction_top_footer_background_color') );

    $quality_construction_bottom_footer_color = esc_attr( quality_construction_get_option('quality_construction_bottom_footer_background_color') );

    $quality_construction_primary_color = esc_attr( quality_construction_get_option('quality_construction_primary_color') );


    $custom_css = '';


    /*====================Dynamic Css =====================*/
    $custom_css .= ".top-header{
         background-color: " . $quality_construction_top_header_color . ";}
    ";

    $custom_css .= ".footer-top{
         background-color: " . $quality_construction_top_footer_color . ";}
    ";

    $custom_css .= ".footer-bottom{
         background-color: " . $quality_construction_bottom_footer_color . ";}
    ";


    $custom_css .= ".section-0-background,
     .btn-primary,
     .section-1-box-icon-background,
     .section-14-box .date,
     #quote-carousel a.carousel-control,
     .section-10-background,
     .footer-top .submit-bgcolor,
     .nav-links .nav-previous a, 
     .nav-links .nav-next a,
     .comments-area .submit,
     .inner-title,
     header .navbar-menu .navbar-nav>li>a:hover, 
      header .navbar-menu .navbar-nav>li.active >a:active,
      header .dropdown-menu > li > a:hover,
      header .dropdown-menu > .active > a, 
      header .dropdown-menu > .active > a:focus, 
      header .dropdown-menu > .active > a:hover,
      .section16 form input[type='submit'],
      .woocommerce a.button, 
      .woocommerce #respond input#submit.alt, 
      .woocommerce a.button.alt, 
      .woocommerce button.button.alt, 
      .woocommerce input.button.alt,
      .woocommerce nav.woocommerce-pagination ul li a:focus, 
      .woocommerce nav.woocommerce-pagination ul li a:hover, 
      .woocommerce nav.woocommerce-pagination ul li span.current,
      header .navbar-toggle
     {
         background-color: " . $quality_construction_primary_color . ";
     }
    ";

 $custom_css .= " header .navbar-menu .navbar-nav>li> a:hover, 
                  header .navbar-menu .navbar-nav>li.active > a,
                  .navbar-default .navbar-nav > .active > a,
                  .navbar-default .navbar-nav > .active > a:focus,
                  .navbar-default .navbar-nav > .active > a:hover,
                  .widget ul li a:hover,a:hover, a:focus, a:active,
                  .section-14-box h3 a:hover,
                  .nav-links .nav-previous a:hover, 
                  .nav-links .nav-next a:hover,
                  header .navbar-menu .navbar-nav > .open > a, 
                  header .navbar-menu .navbar-nav > .open > a:focus, 
                  header .navbar-menu .navbar-nav > .open > a:hover{
                      color: " . $quality_construction_primary_color . ";
                   }
                  ";

    $custom_css .= ".widget .tagcloud a:hover,
    .woocommerce nav.woocommerce-pagination ul li a:focus, 
    .woocommerce nav.woocommerce-pagination ul li a:hover, 
    .woocommerce nav.woocommerce-pagination ul li span.current
                 
                {

                   border: 1px solid " . $quality_construction_primary_color . ";
                }
                ";



    $custom_css .= ".section-4-box-icon-cont i,
    .btn-seconday,
    a:visited{
        color: " . $quality_construction_primary_color . ";}
    ";

    $custom_css .= ".section-14-box .underline,
   .item blockquote img,
   .widget .widget-title,
   .btn-primary,
   #quote-carousel .carousel-control.left, 
   #quote-carousel .carousel-control.right{
        border-color: " . $quality_construction_primary_color . ";}
    ";
    /*------------------------------------------------------------------------------------------------- */

    /*custom css*/

    wp_add_inline_style('quality-construction-style', $custom_css);

}
endif;
add_action('wp_enqueue_scripts', 'quality_construction_dynamic_css', 99);