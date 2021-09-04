//INIT animations
AOS.init({
  once: true,
  duration: 500,
  easing: "ease-in-out",
  delay: 100,
});

(function ($) {
  //SET the parallax effect
  $(".elementor-element-f336667").parallax("center", 0, 0.1, true);
  $(".elementor-element-3aec5b2").parallax("center", 0, -0.1, true);

  //SET the animations
  $(".elementor-element-f336667 h2").attr("data-aos", "zoom-in");
  $(".elementor-element-e25eca2, .elementor-element-279b1c2").attr(
    "data-aos",
    "fade-down"
  );
  $(".recent-post-98").attr("data-aos", "fade-right");
  $(".recent-post-96").attr("data-aos", "fade-left");
  $(".elementor-element-f9a63c5 .elementor-widget-wrap").attr(
    "data-aos",
    "fade-down"
  );
  $(".elementor-element-e9d48a7, .elementor-element-02c05c6").attr(
    "data-aos",
    "fade-up"
  );

  //SCROLL TOP
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll > 800) {
      $("#scroll-top").fadeIn();
    } else {
      $("#scroll-top").fadeOut();
    }
  });

  $("#scroll-top").click(() => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  //PUT form label in the same div than input (required for floating labels)
  $(".form-field").each(function () {
    var form = $(this).children("label")[0].outerHTML;
    $(this).children("label").remove();
    $(this).children("span").append(form);
  });
})(jQuery);
