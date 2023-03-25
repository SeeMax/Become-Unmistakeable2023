// Register any GSAP plugins we need
export let gsapRegisters = () => {
  gsap.registerPlugin(ScrollTrigger);
  gsap.registerPlugin(ScrollToPlugin);
  gsap.registerPlugin(SplitText);
};
