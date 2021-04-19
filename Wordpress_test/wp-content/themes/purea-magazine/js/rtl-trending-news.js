// Trending News
jQuery('.trending-content').owlCarousel( {
    animateOut: 'slideOutDown',
    animateIn: 'flipInX',
    items: 1,
    margin: 30,
    stagePadding: 30,
    smartSpeed: 450,
    autoHeight: true,
    autoplay: true,
    loop: true,
    rtl: true,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
    navClass: ['owl-prev', 'owl-next'],
});