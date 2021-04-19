
  (function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");

    });

    $(document).ready(function () { 

        $(".toggle-button").click( function () {
            $(this).parent().toggleClass("menu-collapsed");
        });     

         /*--- adding dropdown class to menu -----*/
        $("ul.sub-menu").parent().addClass("dropdown");
        $("ul.sub-menu").addClass("dropdown-menu");
        $("ul#menuid li.dropdown a").addClass("dropdown-toggle");
        $("ul.sub-menu li a").removeClass("dropdown-toggle"); 
        $('nav li.dropdown > a').append('<span class="caret"></span>');
        $('a.dropdown-toggle').attr('data-toggle', 'dropdown'); 

        //Side Bar
        function hdSideBarMenu() {
            $('.hd-bar .side-menu').find('.dropdown').children('ul').hide();
            $('.hd-bar .side-menu').find('li.dropdown > .fas').each(function () {
                $(this).on('click', function (e) {
                   e.preventDefault();
                    return false;
                });
            });
        }
        hdSideBarMenu();

        //hd Sidebar
        if ($('.hd-bar').length) {
            $('.hd-bar-opener').on('click', function () {
                $('.hd-bar').addClass('visible-sidebar');
            });
            $('.hd-bar-opener').on('focus', function () {
                $('.hd-bar').addClass('visible-sidebar');
            });
            $('.hd-bar-closer').on('click', function () {
                $('.hd-bar').removeClass('visible-sidebar');
            });
        }
        
        /*-- Mobile menu --*/
        if($('#navbar-collapse-2').length) {
            $('#navbar-collapse-2 .navigation li.dropdown').append(function () {
              return '<i class="fas fa-angle-down" aria-hd="true"></i>';
            });
            $('#navbar-collapse-2 .navigation li.dropdown .fas').on('click', function () {
              $(this).parent('li').children('ul').slideToggle();
            });
        }

        /*-- Search Overlay */
        var obtn = $('.search-btn');
        var cbtn = $('.search-closebtn');
        obtn.on('click', function () {
            $('#searchOverlay').css({'display': 'block'});
            $('.overlay input.blog-search').focus();
        });
        obtn.focus(
        function() {
            $('#searchOverlay').css({'display': 'block'});
            $('.overlay input.blog-search').focus();
        });
        cbtn.on('click', function () {
            $('#searchOverlay').css({'display': 'none'});
        });
        cbtn.on("focusout", function() {
            $('#searchOverlay').css({'display': 'none'});
        });


        /* hd Sidebar menu */
        $(".hd-bar-wrapper ul.navigation > li:nth-last-child(3) a").on("focusout", function() {
            if ($('.hd-bar').length) { 
                $('.hd-bar').removeClass('visible-sidebar');
            }
        });
        $(".hd-bar-wrapper ul.navigation > li:last-child a").on("focusout", function() {
            if ($('.hd-bar').length) { 
                $('.hd-bar').removeClass('visible-sidebar');
            }
        });

        /*-- tooltip --*/
        $('[data-toggle="tooltip"]').tooltip();

        /*-- Button Up --*/
        var btnUp = $('<div/>', { 'class': 'btntoTop' });
        btnUp.appendTo('body');
        $(document).on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });

        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });
        
        /*-- Sticky Sidebar --*/
        $('#sidebar-wrapper, #post-wrapper').theiaStickySidebar({minWidth: 1024});
        $('#content-main, #content-left, #content-right').theiaStickySidebar({minWidth: 1024});

        /*-- Remove hd bar for larger screens --*/
        if ($(window).width() > 768) {
            $( '#hd-left-bar' ).remove();
       }

        /*-- Reload page when width is between 320 and 768px and only from desktop */
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
        $(window).on('resize', function() {
            var win = $(this); //this = window
            if (win.width() > 320 && win.width() < 768 && isMobile==false && !$( "body" ).hasClass( "elementor-editor-active" )) { 
                location.reload();
            }
        });
    });        

})(this.jQuery);