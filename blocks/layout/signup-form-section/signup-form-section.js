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
      // $block.find('h2').css( "color", "blue" );
  };

  // Initialize each block on page load (front end).
  $(document).ready(function(){

    // Make sure it's not the wp-backend
    if (!$('body').hasClass("wp-admin")) {

      $('.signup-form-section').each(function(){
        initializeBlock( $(this) );
      });
    }
  });

  // Initialize dynamic block preview (editor).
  if( window.acf ) {
      window.acf.addAction( 'render_block_preview/type=signup-form-section', initializeBlock );
  }

})(jQuery);
