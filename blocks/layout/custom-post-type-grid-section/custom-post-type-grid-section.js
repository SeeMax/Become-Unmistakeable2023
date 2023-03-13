(function($){
    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
      
        $('.singleCPTGridItem').on('click', function(){
          let thisPost = $(this).attr('data-cpt-popup');
          console.log(thisPost);
          ajaxPost(thisPost)
          showPopup();
        });

        $('.CPTPopupClose').on('click', function(){
          CPTPopupClose();  
        });

        $('.CPTPopUpOverlay').on('click', function(){
          CPTPopupClose();  
        });
        
        let ajaxPost = (linkID) => {  
          $.ajax({          
              url: '/wp-json/wp/v2/custom_post_type/'+linkID,                                       
              success: function( data ) { 
                // console.log(data);
                if(!data.acf.image == "") {
                  var imageURL = data.acf.image.sizes.large
                } else {
                  var imageURL = '../wp-content/themes/seemax-theme/dist/images/default-image.jpg'
                }
                // Clear Info First    
                $('.custom-post-type-pop-up-text .contact-info').html('');   
                // Populate Data
                $('.custom-post-type-pop-up-image').html(`
                  <div class="popup-image-mask background-image-section" 
                  style="background-image:url(`+imageURL+`)"> 
                  </div>
                `)
                $('.custom-post-type-pop-up-text h3').html(data.title.rendered);
                $('.custom-post-type-pop-up-text h5').html(data.acf.subheadline);
                $('.custom-post-type-pop-up-text p').html(data.acf.body);
                // Reveal After Data is In
                fillPopup();
              },
              cache: false
          }); 
        }

        let showPopup = () => {
          let tl = gsap.timeline();
          tl.set('#ajaxLoader', {zIndex:15});
          tl.set('.CPTPopUpOverlay', {zIndex:14});
          tl.to('#ajaxLoader', {opacity:1}, "comein");
          tl.to('.CPTPopUpOverlay', {opacity:0.8}, "comein");
        }

        let fillPopup = () => {
          let tl = gsap.timeline();
          tl.to('#ajaxLoader', {opacity:0}, "comein");
          tl.set('#ajaxLoader', {zIndex:-1});
          tl.set('.CPTPopup', {zIndex:50});
          tl.to('.CPTPopup', {opacity:1}, "comein");
          tl.to(window, {scrollTo: {y:".CPTPopup", offsetY:100}}, "comein");
        }

        let CPTPopupClose = () => {
          let tl = gsap.timeline();
          tl.to('.CPTPopup', {opacity:0}, "comeout")
          tl.to('.CPTPopUpOverlay', {opacity:0}, "comeout")
          tl.set('.CPTPopup', {zIndex:-1});
          tl.set('.CPTPopUpOverlay', {zIndex:-1});
        }
    };
  
    // Initialize each block on page load (front end).
    $(document).ready(function(){
      
      // Make sure it's not the wp-backend
      if (!$('body').hasClass("wp-admin")) {
        
        $('.custom-post-type-grid-section').each(function(){
            // Function Above Called For Popup
            initializeBlock( $(this) );          
        });      
      }
    });
  
    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=custom-post-type-grid-section', initializeBlock );
    }
  
  })(jQuery);
