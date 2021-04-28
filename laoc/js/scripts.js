/*!
    * Start Bootstrap - Grayscale v6.0.3 (https://startbootstrap.com/theme/grayscale)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
    */
    (function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 70,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 100,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
})(jQuery); // End of use strict

//ANIMATION
// Wrap every letter in a span
let T = 700;
let firstText = document.getElementById("firstText");
anime.timeline({loop: false})
  .add({
  targets: '.firstText',
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: T*1,
  delay: 500
  });
  let secondText = document.getElementById("secondText");
anime.timeline({loop: false})
  .add({
  targets: '.secondText',
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: T*2,
  delay: 2*T-T
  });
  let thirdText = document.getElementById("thirdText");
anime.timeline({loop: false})
  .add({
  targets: '.thirdText',
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: T*3,
  delay: 3*T-T
  });
  let fourthText = document.getElementById("fourthText");
  anime.timeline({loop: false})
    .add({
    targets: '.fourthText',
    opacity: [0,1],
    easing: "easeInOutQuad",
    duration: T*4,
    delay: 4*T-T
    });
