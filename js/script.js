/**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

// Preloader js
$(window).on("load", function () {
  "use strict";
  $(".preloader").fadeOut(0);
});

(function ($) {
  "use strict";

  // tab
  $(".tab-content")
    .find(".tab-pane")
    .each(function (idx, item) {
      var navTabs = $(this).closest(".code-tabs").find(".nav-tabs"),
        title = $(this).attr("title");
      navTabs.append(
        '<li class="nav-item"><a class="nav-link" href="#">' +
          title +
          "</a></li>"
      );
    });

  $(".code-tabs ul.nav-tabs").each(function () {
    $(this).find("li:first").addClass("active");
  });

  $(".code-tabs .tab-content").each(function () {
    $(this).find("div:first").addClass("active");
  });

  $(".nav-tabs a").click(function (e) {
    e.preventDefault();
    var tab = $(this).parent(),
      tabIndex = tab.index(),
      tabPanel = $(this).closest(".code-tabs"),
      tabPane = tabPanel.find(".tab-pane").eq(tabIndex);
    tabPanel.find(".active").removeClass("active");
    tab.addClass("active");
    tabPane.addClass("active");
  });

  // accordion-collapse
  $(".accordion-collapse").on("show.bs.collapse", function () {
    $(this).siblings(".accordion-header").addClass("active");
  });
  $(".accordion-collapse").on("hide.bs.collapse", function () {
    $(this).siblings(".accordion-header").removeClass("active");
  });

  //post slider
  $(".post-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4500,
    dots: false,
    arrows: true,
    prevArrow:
      '<button type="button" class="prevArrow"><i class="fas fa-angle-left"></i></button>',
    nextArrow:
      '<button type="button" class="nextArrow"><i class="fas fa-angle-right"></i></button>',
  });

  // videoPopupInit
  function videoPopupInit() {
    var $videoSrc;
    $(".video-play-btn").click(function () {
      $videoSrc = $(this).data("src");
    });
    $("#videoModal").on("shown.bs.modal", function (e) {
      $("#showVideo").attr(
        "src",
        $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
      );
    });
    $("#videoModal").on("hide.bs.modal", function (e) {
      $("#showVideo").attr("src", $videoSrc);
    });
  }
  videoPopupInit();

  // table of content
  new ScrollMenu("#TableOfContents a", {
    duration: 400,
    activeOffset: 40,
    scrollOffset: 10,
  });
})(jQuery);

document.getElementById("shipment-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent form submission
  
  let valid = true;

  // Clear previous error messages
  document.querySelectorAll(".error").forEach(el => el.textContent = "");

  // Form field values
  const service = document.getElementById("service");
  const length = document.getElementById("length");
  const height = document.getElementById("height");
  const fromCountry = document.getElementById("from-country");
  const toCountry = document.getElementById("to-country");
  const weight = document.getElementById("weight");
  const email = document.getElementById("email");

  // Validation checks
  if (!service.value) {
    document.getElementById("service-error").textContent = "Please select a service.";
    valid = false;
  }
  if (!length.value || length.value <= 0) {
    document.getElementById("length-error").textContent = "Length must be a positive number.";
    valid = false;
  }
  if (!height.value || height.value <= 0) {
    document.getElementById("height-error").textContent = "Height must be a positive number.";
    valid = false;
  }
  if (!fromCountry.value.trim()) {
    document.getElementById("from-country-error").textContent = "From Country is required.";
    valid = false;
  }
  if (!toCountry.value.trim()) {
    document.getElementById("to-country-error").textContent = "To Country is required.";
    valid = false;
  }
  if (!weight.value || weight.value <= 0) {
    document.getElementById("weight-error").textContent = "Weight must be a positive number.";
    valid = false;
  }
  if (!email.value || !email.value.includes("@")) {
    document.getElementById("email-error").textContent = "Please enter a valid email address.";
    valid = false;
  }

  // If valid, submit form or display success
  if (valid) {
    alert("Form submitted successfully!");
    e.target.submit(); // Uncomment this line if you want to submit the form
  }
});

document.getElementById("shipment-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent form submission
  
  let valid = true;

  // Clear previous error messages
  document.querySelectorAll(".error").forEach(el => el.textContent = "");

  // Form field values
  const service = document.getElementById("service");
  const length = document.getElementById("length");
  const height = document.getElementById("height");
  const fromCountry = document.getElementById("from-country");
  const toCountry = document.getElementById("to-country");
  const weight = document.getElementById("weight");
  const email = document.getElementById("email");

  // Validation checks
  if (!service.value) {
    document.getElementById("service-error").textContent = "Please select a service.";
    valid = false;
  }
  if (!length.value || length.value <= 0) {
    document.getElementById("length-error").textContent = "Length must be a positive number.";
    valid = false;
  }
  if (!height.value || height.value <= 0) {
    document.getElementById("height-error").textContent = "Height must be a positive number.";
    valid = false;
  }
  if (!fromCountry.value.trim()) {
    document.getElementById("from-country-error").textContent = "From Country is required.";
    valid = false;
  }
  if (!toCountry.value.trim()) {
    document.getElementById("to-country-error").textContent = "To Country is required.";
    valid = false;
  }
  if (!weight.value || weight.value <= 0) {
    document.getElementById("weight-error").textContent = "Weight must be a positive number.";
    valid = false;
  }
  if (!email.value || !email.value.includes("@")) {
    document.getElementById("email-error").textContent = "Please enter a valid email address.";
    valid = false;
  }

  // If valid, submit form or display success
  if (valid) {
    alert("Form submitted successfully!");
    e.target.submit(); // Uncomment this line if you want to submit the form
  }
});
