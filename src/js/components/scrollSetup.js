export let scrollSetup = () => {
  let theHeadlines = $(".animatedSection").find("h1, h2, h3, h4, h5");
  let theBodies = $(".animatedSection").find("h6, p");
  $(theHeadlines).addClass("animatedHeadline");
  $(theBodies).addClass("animatedBodies");
  let mySplitText = new SplitText(theHeadlines, { type: "lines" });
  let lines = mySplitText.lines; //an array of all the divs that wrap each character
  $(lines).addClass("animatedSingleLine");
  $(".animatedSingleLine").append('<div class="animatedLineCover"></div>');
  $(theBodies).append('<div class="animatedLineCover"></div>');
  $(".seemax-button").append('<div class="animatedLineCover"></div>');

  $(".animatedSection").each(function () {
    let circSpin = $(this).find(".circleSpinner");
    let circIcon = $(this).find(".iconSpinner");
    let smallIcon = $(this).find(".smallSpinner");
    let secondIcon = $(this).find(".secondIconSpinner");
    let aboutSpin = $(this).find(".aboutSpinner");
    let thisImg = $(this).find("img");
    let thisBackImg = $(this).find(".slidingImage");
    let thisImgParent = $(thisImg).parent();
    let thisBackImgParent = $(thisBackImg).parent();
    let links = $(this).find("a");

    // Add Perspective for Any Animated Image Container
    $(thisImgParent).addClass("perspectiveBox");
    $(thisBackImgParent).addClass("perspectiveBox");

    // Setup Any Existing Elements
    if (circSpin.length) {
      gsap.set(circSpin, { transformOrigin: "50% 50%", scale: 0, rotate: 720 });
    }

    if (circIcon.length) {
      gsap.set(circIcon, {
        transformOrigin: "50% 50%",
        scale: 0,
        rotate: -90,
      });
    }

    if (smallIcon.length) {
      gsap.set(smallIcon, {
        transformOrigin: "50% 50%",
        scale: 0,
        rotate: 360,
      });
    }

    if (secondIcon.length) {
      gsap.set(secondIcon, {
        transformOrigin: "100% 100%",
        rotate: -180,
      });
    }

    if (thisImg.length) {
      gsap.set(thisImg, {
        transformOrigin: "50% 50%",
        scale: 0,
        rotateY: 45,
      });
    }

    if (aboutSpin.length) {
      gsap.set(aboutSpin, {
        transformOrigin: "100% 50%",
        scale: 0,
      });
    }

    if (thisBackImg.length) {
      gsap.set(thisBackImg, {
        transformOrigin: "0% 100%",
        x: "100%",
        rotation: 180,
        // rotateY: 20,
      });
    }

    if (links.length) {
      gsap.set(links, {
        opacity: 0,
      });
    }

    if ($(".single-co-results h4").length) {
      gsap.set(".single-co-results h4:after", {
        left: 0,
      });
    }
  });
};
