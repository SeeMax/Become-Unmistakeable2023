import {
  preLoader,
  mobileNavSetup,
  externalLinks,
  gsapRegisters,
  clickEvents,
  menuItemSetup,
  scrollSetup,
  scrollAnims,
  subMenu,
  // navSearchSetup,
} from "./index.js";

window.addEventListener("load", function () {
  // Setup Basic Functionality

  externalLinks();
  gsapRegisters();
  scrollSetup();
  clickEvents();
  menuItemSetup();
  preLoader();
  scrollAnims();

  if ($("body").hasClass("page-home")) {
  }

  if ($(window).width() <= 1024) {
    mobileNavSetup();
  } else {
    subMenu();
  }
});

window.addEventListener("resize", function () {
  if ($(window).width() < 1024) {
  } else {
  }
});
