export let searchReveal = () => {
  let tl = new gsap.timeline({
		paused:true,
		defaults: {
			ease: 'Power4.in()',
			duration:0.3,
		}
	});

  let container = $('.headerSearchContainer');
  let headline = container.find('h4');
  let form = container.find('.searchform');
  let close = $('.mobile-search-close');
  let toggleHeight = container.attr('data-height');

  // Rotate Main Nav Item / Different Class than click event trigger
  tl.to('.searchNavItem', {rotation:90}, 'searchOpen');
	tl.to(container, {height:toggleHeight}, 'searchOpen');
  tl.to([headline, form, close], {opacity:1, y:0, duration:0.2}, 'searchOpen+=0.1');
  
	return tl;
}