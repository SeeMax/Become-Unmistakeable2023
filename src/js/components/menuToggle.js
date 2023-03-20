// Animate The Mobile Nav open and closed - called in clickEvents.js
export let menuToggle = () => {
  let tl = new gsap.timeline({
    paused: true,
    defaults: {
      ease: "circ.out()",
      duration: 0.3,
    },
  });

  let menuWidth = $(".menuToggle").outerWidth();
  let menuHeight = $(".menuToggle").outerHeight();
  let toggledWidth = (menuWidth / 4) * 3;
  let toggledX = menuWidth / 4;
  let angledWidth = menuWidth / 3;
  let angledY = menuHeight / 3 - 1;
  let angledX = menuWidth - angledWidth + 1;

  tl.to(
    ".hamTop",
    {
      rotation: -45,
      x: angledX / 2,
      y: angledY * 1.6,
      width: angledWidth * 2,
      transformOrigin: "50% 50%",
    },
    "menuOpen"
  );
  tl.to(".hamMid", { x: toggledX, width: 0 }, "menuOpen");
  tl.to(
    ".hamBot",
    {
      rotation: 45,
      x: angledX / 2,
      y: -angledY * 1.6,
      width: angledWidth * 2,
      transformOrigin: "50% 50%",
    },
    "menuOpen"
  );
  tl.to(".main-nav", { duration: 0.1, x: "0%" }, "menuOpen");
  tl.to("nav .menu-item", { x: "0%", stagger: { amount: 0.4 } }, "menuOpen");

  return tl;
};
