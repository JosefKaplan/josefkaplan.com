		jQuery("body").ready(function($){
			$(window).on("scroll", function () {
			if ( $(this).scrollTop() > 500 )
				$("#totop").fadeIn();
				else
				$("#totop").fadeOut();
			});

			$("#totop").on("click", function () {
				$("body,html").animate({ scrollTop: 0 }, 800 );
				return false;
			});
		});