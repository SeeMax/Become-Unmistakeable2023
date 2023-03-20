import {
  preLoader,
  mobileNavSetup,
  externalLinks,
  gsapRegisters,
  clickEvents,
  menuItemSetup,
  // navSearchSetup,
} from "./index.js";

window.addEventListener("load", function () {
  // Setup Basic Functionality
  preLoader();
  externalLinks();
  gsapRegisters();
  clickEvents();
  menuItemSetup();

  if ($("body").hasClass("page-home")) {
  }

  if ($(window).width() <= 1024) {
    mobileNavSetup();
  } else {
  }
});

window.addEventListener("resize", function () {
  if ($(window).width() < 1024) {
  } else {
  }
});
