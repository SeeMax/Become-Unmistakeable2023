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
      $('.posts-preview-section').each(function(){
          initializeBlock( $(this) );
      });

      // var eventPreview = $('.single-posts-preview');
      //
      // if(!eventPreview.hasClass('chicago-posts-preview')) {
      //   $('.allChicagoEventsButton').hide();
      // }
      //
      // if(!eventPreview.hasClass('el-salvador-posts-preview')) {
      //   $('.allElSalvadorEventsButton').hide();
      // }

  });

  // Initialize dynamic block preview (editor).
  if( window.acf ) {
      window.acf.addAction( 'render_block_preview/type=posts-preview-section', initializeBlock );
  }

})(jQuery);
