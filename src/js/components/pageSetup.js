// Show and Hide the Preloader - Called on windowLoad.js
export let preLoader = () => {
  let tl = new gsap.timeline({
    defaults: {
      duration:0.3,
      ease:'power1.in',
    },
    onComplete: function(){
      $('#preloader').remove();
    }
  })
  tl.to('#preloader svg', {rotateY:90});
	tl.to('#preloader', {opacity:0},"+=0.05");
}


// Hide Each of the Mobile Nav Links - called in windowLoad.js
export let mobileNavSetup = () => {
  gsap.set('nav .menu-item', {opacity:0, x:'50%'});
}

// Hide Each of the Mobile Nav Links - called in windowLoad.js
export let navSearchSetup = () => {
  let container = $('.headerSearchContainer')
  let headline = container .find('h4');
  let thisForm = container .find('.searchform');
  let searchContainerHeight = container.outerHeight();
  let close = $('.mobile-search-close');
  container.attr('data-height', searchContainerHeight)
	gsap.set([headline, thisForm], {opacity:0, y: -10});
  gsap.set(close, {opacity:0, y:-10});
  gsap.set(container, {height:0});
}


// Always Open External Links in a new tab - called in windowLoad.js
export let externalLinks= () => {
  $('a').each(function() {
    let a = new RegExp('/' + window.location.host + '/');
    if(!a.test(this.href)) {
      $(this).on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        window.open(this.href, '_blank');
      });
    }
  });
}

// Function for SmoothScrolling - Called in clickEvents.js
export let smoothScrolling = (theLink) => {
  
  let target = $(theLink).attr('href');
  let headerHeight = $('.header').outerHeight(); 
  gsap.to(window, {duration:.5, ease: 'circ.out', 
    scrollTo:{
      y:target, 
      // Activate if Header Is Fixed
      // offsetY:headerHeight
    }
  });
  return false;
}