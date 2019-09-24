$(document).ready(function () {

  $(".slider-intro").owlCarousel({
    items: 1,
    stagePadding: 0,
    loop: true,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
  });

  $(".slider-best-sellers").owlCarousel({
    items: 4,
    stagePadding: 0,
    margin: 40,
    loop: true,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
  });

  $(".slider-news").owlCarousel({
    items: 2,
    stagePadding: 0,
    margin: 40,
    loop: true,
    dots: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
  });

});