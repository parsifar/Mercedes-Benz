// Initializing Slick.js

$(document).ready(function () {
  $(".testimonial-container").slick({
    slidesToShow: window.innerWidth <= 850 ? 1 : 2,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});
