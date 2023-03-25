export let scrollAnims = () => {
  $(".animatedSection").each(function () {
    let lineCovers = $(this).find(".animatedLineCover");
    let circSpin = $(this).find(".circleSpinner");
    let circIcon = $(this).find(".iconSpinner");
    let smallIcon = $(this).find(".smallSpinner");
    let secondIcon = $(this).find(".secondIconSpinner");
    let aboutSpin = $(this).find(".aboutSpinner");
    let thisImg = $(this).find("img");
    let thisBackImg = $(this).find(".slidingImage");
    let links = $(this).find("a");
    let resultsAfter = $(".single-co-results h4:after");
    // Make A Timeline for Each Animated Section
    let dur = 0.75;
    let ease = "circ.out";

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: this,
        start: "top center", // when the top of the trigger hits the top of the viewport
        toggleActions: "play none none reverse",
        // fastScrollEnd: true,
        // end: "top center",
        // scrub: 1,
      },
      defaults: {
        duration: dur,
        ease: ease,
      },
    });

    if (circSpin.length) {
      tl.to(circSpin, { duration: 1, rotate: 0, scale: 1 }, "rollin");
    }

    if (circIcon.length) {
      tl.to(
        circIcon,
        { scale: 1, opacity: 1, rotate: 0, duration: dur - 0.25 },
        "rollin+=0.5"
      );
    }

    if (smallIcon.length) {
      tl.to(
        smallIcon,
        { stagger: 0.1, scale: 1, opacity: 1, rotate: 0 },
        "rollin"
      );
    }

    if (secondIcon.length) {
      tl.to(secondIcon, { scale: 1, rotation: 0 }, "rollin+=0.45");
    }

    if (thisImg.length) {
      tl.to(thisImg, { scale: 1, rotateY: 0 }, "rollin+=0.3");
    }

    if (thisBackImg.length) {
      tl.to(thisBackImg, { stagger: 0.2, x: 0, rotation: 0 }, "rollin+=0.25");
    }

    if (aboutSpin.length) {
      tl.to(aboutSpin, { stagger: 0.2, scale: 1 }, "rollin+=0.25");
    }

    if (lineCovers.length) {
      tl.to(
        lineCovers,
        { stagger: 0.1, width: 0, ease: "power4.out" },
        "rollin+=0.25"
      );
    }

    if (links.length) {
      tl.to(links, { opacity: 1, duration: dur / 2 }, "rollin2-=0.3");
    }
  });
};
