import { 
  preLoader,
  mobileNavSetup,
  externalLinks,
  gsapRegisters,
  clickEvents,
  navSearchSetup, 
} from './index.js';
 
window.addEventListener('load', function() {
  // Setup Basic Functionality
  preLoader();
  externalLinks();
  gsapRegisters();
  navSearchSetup();
  clickEvents();
  
    
  if($('body').hasClass('page-home')) {
     
  }
    
  if ($(window).width() <= 1024) {
    mobileNavSetup();
  }
  else {
  
  }  
})

window.addEventListener('resize', function() {

  if ($(window).width() < 1024) {

  }
  else {

 }
});