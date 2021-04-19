/**
 * For user experience
 */
jQuery(document).ready(function ($) {
    //Navigation toggle
    $('#toggle').click(function () {
        $(this).toggleClass('on');
        $('#colophon').toggleClass('fp-show');
    });

    //Service tab
    $('.service-content:first').show();
    $('.service-tab:first').addClass('sm-active');

    $('.service-tab').click(function(){
        var serviceId = $(this).attr('href');
        $('.service-content').hide();
        $(serviceId).show();
        $('.service-tab').removeClass('sm-active');
        $(this).addClass('sm-active');
        return false;
    });

    $('a.port-lbox-link').nivoLightbox();

    // Bxslider Home
    $('.scrollme-slider').bxSlider({
        auto: true,
        pager: true,
        mode: 'fade',
        controls: false,
        pause: sBxslider.pause,
        touchEnabled: false,
        speed: 800
    });


    $(window).load(function () {
        $(window).resize(function () {
            var windowHeight = $(window).height();
            $('.slider-section .bx-viewport, .slider-section .bx-slides').height(windowHeight);
        }).resize();
    });

    // Number Counter
    $('.ak-counter').each(function () {
        var elm = $(this);
        var color = elm.attr("data-fgColor");
        var perc = elm.attr("value");
        $('.ak-counter').knob({
            angleArc: 180,
            readOnly: true,
            angleOffset: -90
        });

        $({value: 0}).animate({value: perc}, {
            duration: 1000,
            easing: 'swing',
            progress: function () {
                elm.val(Math.ceil(this.value)).trigger('change')
            }
        });

        //circular progress bar color
        $(this).append(function () {
            elm.parent().parent().find('.circular-bar-content').css('color', color);
            elm.parent().parent().find('.circular-bar-content label').text(perc + '%');
        });
    });

    // Animate counter widget when viewed
    startKnob =  function() {
        $('.ak-counter').each(function () {
            $(this).each(function () {
                $(this).animate({
                    value: $(this).data('number')
                }, {
                    duration: 2500,
                    easing: 'swing',
                    progress: function () {
                        $(this).val(Math.round(this.value)).trigger('change');
                    }
                });
            });
        });

    }

    $('.widget_scrollme-number-counter').one('inview', startKnob);

    // Portfolio Masonary
    var $container = $('#sm-portfolio').imagesLoaded( function() {

    if( $('#portfolio-wrap').length > 0 ){
            
          GetMasonary();    
            
            $container.isotope({
                itemSelector: '.item',
                gutter:0,
                transitionDuration: "0.5s"
            });     
            
            $(window).on( 'resize', function () {
               GetMasonary();
            });
        }
    });

    var wwidth = $(window).width();

    if(($('html').hasClass('mobile') || (wwidth < 770 && $('html').hasClass('tablet'))) && $('body').hasClass('page-template-tpl-home')){
       $('#site-navigation a').click(function(){
        $('.site-footer').removeClass('scroll-show');
        });

        $("body #site-navigation li").click(function(evn){
            $('#site-navigation li').removeClass('current-menu-item');
            if($(this).data('menuanchor')){
                evn.preventDefault();
                $('html,body').scrollTo('#'+$(this).data('menuanchor'),{
                    axis: 'y',
                    duration: 1000,
                    offset: -86
                });
                $(this).addClass('current-menu-item'); 
            }
        });
    } 
    
    // Pre Loader
    $(window).load(function () {
        // Animate loader off screen
        $(".scrollme-preloader").fadeOut("slow");
    });

    // Scroll Sections
    if($('body').hasClass('page-template-tpl-home')){
        $('#fullpage').fullpage({
    
            //Custom selectors
            sectionSelector: '.scrollme-main-section',
            slideSelector: '.sec-slide',
    
            // Scrolling
            loopHorizontal: false,
            responsiveWidth: 795,
    
            // Navigation
            menu: '#site-navigation',
    
            //Accessibility
            recordHistory: false,
            verticalCentered: false,
    
            // Events
            afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){
                if( slideIndex == 0 ) {
                    $('.header-wrapper').addClass('hide-header').removeClass('show-header');
                    $('#colophon').removeClass('fp-show');
                }else {
                    $('.header-wrapper').addClass('show-header').removeClass('hide-header');
                    $('#colophon').addClass('fp-show');
                }
    
                $('#site-navigation li').removeClass('current-menu-item');
                if( document.location.hash ) {
                    $('a[href="' + document.location + '"]').parent().addClass('current-menu-item');
                }else {
                    $('a[href="' + document.location + '#home"]').parent().addClass('current-menu-item');
                }
            },
    
            afterLoad: function(anchorLink, index){
                if( index == 1 ){
                    $('.header-wrapper').addClass('hide-header').removeClass('show-header');
                    $('#colophon').removeClass('fp-show');
                }else {
                    $('.header-wrapper').addClass('show-header').removeClass('hide-header');
                    $('#colophon').addClass('fp-show');
                }
            }
        });
    }

    function scrollMeFocusForce(focEl){
        var _doc = document;
        setTimeout( function() {
        focEl = _doc.querySelector( focEl );
        focEl.focus();

        }, 100 );
    }

    $('body').on('click keypress','.toggle-nav', function(){
        
        $('.site-footer').addClass('scroll-show').addClass('fp-show');
        
    });

    $('body').on('click keypress','.btn-transparent-toggle', function(){
        
        $('.site-footer').addClass('scroll-show').addClass('fp-show');
        scrollMeFocusForce('.main-navigation ul li:first-child a');
    });

   


    $('#toggle').click(function(){
        $('.site-footer').removeClass('scroll-show');
        $(this).addClass('on');
    });

        $(".s-panel-inner").mCustomScrollbar({
        theme: "dark-thin",
        axis:"y" // horizontal scrollbar
    });


    function GetMasonary(){
    var winWidth = window.innerWidth;
        columnNumb = 1;         
        var attr_col = $('#sm-portfolio').attr('data-col');
            
         if (winWidth >= 1466) {
            
            $('#portfolio-wrap').css( {width : $('#portfolio-wrap').parent().width() - 20 + 'px'});
            var portfolioWidth = $('#portfolio-wrap').width();
            
            if (typeof attr_col !== typeof undefined && attr_col !== false) {
                columnNumb = $('#sm-portfolio').attr('data-col');
            } else columnNumb = 3;
            
            postHeight = window.innerHeight
            postWidth = Math.floor(portfolioWidth / columnNumb)         
            $container.find('.item').each(function () { 
                $('.item').css( { 
                    width : postWidth * 1 - 20 + 'px',
                    height : postWidth * 1 - 20 + 'px',
                    margin : 10 + 'px' 
                });
                $('.item.wide').css( { 
                    width : postWidth * 2 - 20 + 'px',
                    height : postWidth * 2 - 20 + 'px'
                });
            });
            
            
        } else if (winWidth > 1024) {
            
            $('#portfolio-wrap').css( {width : $('#portfolio-wrap').parent().width() - 40 + 'px'});
            var portfolioWidth = $('#portfolio-wrap').width();
                        
            if (typeof attr_col !== typeof undefined && attr_col !== false) {
                columnNumb = $('#sm-portfolio').attr('data-col');
            } else columnNumb = 3;
            
            postHeight = window.innerHeight
            postWidth = Math.floor(portfolioWidth / columnNumb)         
            $container.find('.item').each(function () { 
                $('.item').css( { 
                    width : postWidth - 20 + 'px',
                    height : postWidth  - 20 + 'px',
                    margin : 10 + 'px' 
                });
                $('.item.wide').css( { 
                    width : postWidth * 2 - 20 + 'px',
                    height : postWidth * 2 - 20 + 'px'
                });
            });
                    
        } else if (winWidth > 767) {
            
            $('#portfolio-wrap').css( {width : $('#portfolio-wrap').parent().width() - 40 + 'px'});
            var portfolioWidth = $('#portfolio-wrap').width();
            
            columnNumb = 2;
            postWidth = Math.floor(portfolioWidth / columnNumb)         
            $container.find('.item').each(function () { 
                $('.item').css( { 
                    width : postWidth - 20 + 'px',
                    height : postWidth  - 20 + 'px',
                    margin : 10 + 'px' 
                });
                $('.item.wide').css( { 
                    width : postWidth * 2 - 20 + 'px',
                    height : postWidth * 2 - 20 + 'px'
                });             
            });
            
            
        }   else if (winWidth > 479) {
            
            $('#portfolio-wrap').css( {width : $('#portfolio-wrap').parent().width() - 40 + 'px'});
            var portfolioWidth = $('#portfolio-wrap').width();
            
            columnNumb = 1;
            postWidth = Math.floor(portfolioWidth / columnNumb)         
            $container.find('.item').each(function () { 
                $('.item').css( { 
                    width : postWidth - 20 + 'px',
                    height : postWidth  - 20 + 'px',
                    margin : 10 + 'px' 
                });
                $('.item.wide').css( { 
                    width : postWidth  - 20 + 'px',
                    height : postWidth  - 20 + 'px'
                });
            }); 
        }
        
        else if (winWidth <= 479) {
            
            $('#portfolio-wrap').css( {width : $('#portfolio-wrap').parent().width() - 10 + 'px'});
            var portfolioWidth = $('#portfolio-wrap').width();
            
            columnNumb = 1;
            postWidth = Math.floor(portfolioWidth / columnNumb)         
            $container.find('.item').each(function () { 
                $('.item').css( { 
                    width : postWidth - 10 + 'px',
                    height : postWidth  - 10 + 'px',
                    margin : 5 + 'px' 
                });
                $('.item.wide').css( { 
                    width : postWidth  - 10 + 'px',
                    height : postWidth  - 10 + 'px'
                });
            }); 
        }       
        return columnNumb;
    }

});