// Animate The Mobile Nav open and closed - called in clickEvents.js
export let menuToggle = () => {
	let tl = new gsap.timeline({
		paused:true,
		defaults: {
			ease: 'circ.out()',
			duration:0.3,
		}
	});

	let menuWidth = $('.menuToggle').outerWidth();
	let menuHeight = $('.menuToggle').outerHeight();
	let toggledWidth = (menuWidth / 4) * 3;
	let toggledX = menuWidth / 4;
	let angledWidth = menuWidth / 3;
	let angledY = (menuHeight / 3) - 1;
	let angledX = (menuWidth - angledWidth) + 1;

	tl.to('.main-nav', {duration:0.3, x:'0%'}, 'menuOpen');
	tl.to('nav .menu-item', {opacity:1, x:'0%', stagger: {amount:0.1}}, 'menuOpen+=0.2');
	tl.to('.hamTop', {rotation:45,x:angledX ,y:angledY, width:angledWidth, transformOrigin:'50% 50%'}, 'menuOpen');
	tl.to('.hamMid', {x:toggledX, width:toggledWidth}, 'menuOpen');
	tl.to('.hamBot', {rotation:-45, x:angledX, y:-angledY, width:angledWidth, transformOrigin:'50% 50%'}, 'menuOpen');

	return tl;
}