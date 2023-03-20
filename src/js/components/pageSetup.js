// Show and Hide the Preloader - Called on windowLoad.js
export let preLoader = () => {
  let tl = new gsap.timeline({
    defaults: {
      duration: 0.3,
      ease: "power1.in",
    },
    onComplete: function () {
      $("#preloader").remove();
    },
  });
  tl.to("#preloader svg", { scale: 0 });
  tl.to("#preloader", { opacity: 0 }, "+=0.05");
};

// Hide Each of the Mobile Nav Links - called in windowLoad.js
export let mobileNavSetup = () => {
  gsap.set("nav .menu-item", { x: "-100%" });
};

export let menuItemSetup = () => {
  // Wrap each nav item in a span so it appears above the :after dot
  $(".menu-item").each(function (i, v) {
    $(this).contents().wrap('<span class="menu-item-text"/>');
  });

  $(".menu-item").append(`
    <span class="menu-circle menu-circle-1"></span>
    <span class="menu-circle menu-circle-2"></span>
  `);
};

// Always Open External Links in a new tab - called in windowLoad.js
export let externalLinks = () => {
  $("a").each(function () {
    let a = new RegExp("/" + window.location.host + "/");
    if (!a.test(this.href)) {
      $(this).on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        window.open(this.href, "_blank");
      });
    }
  });
};

// Function for SmoothScrolling - Called in clickEvents.js
export let smoothScrolling = (theLink) => {
  let target = $(theLink).attr("href");
  let headerHeight = $(".header").outerHeight();
  gsap.to(window, {
    duration: 0.5,
    ease: "circ.out",
    scrollTo: {
      y: target,
      // Activate if Header Is Fixed
      // offsetY:headerHeight
    },
  });
  return false;
};
