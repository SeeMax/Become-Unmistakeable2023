(function ($) {
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
  var initializeBlock = function ($block) {
    // $( ".quote-section").addClass( "seemax-quote" );
  };

  // Initialize each block on page load (front end).
  $(document).ready(function () {
    // Make sure it's not the wp-backend
    if (!$("body").hasClass("wp-admin")) {
      $(".quote-section").each(function () {
        initializeBlock($(this));
        let thisID = $(this).attr("id");
        $("#" + thisID + " .quoteSliderContainer").slick({
          autoplay: true,
          autoplaySpeed: 5000,
          infinite: true,
          speed: 800,
          centerMode: true,
          fade: true,
          cssEase: "linear",
          arrows: true,
          // prevArrow: $('.slick-prev-arrow'),
          // nextArrow: $('.slick-next-arrow'),
          dots: true,
        });
      });
    }
  });

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction(
      "render_block_preview/type=quote-section",
      initializeBlock
    );
  }
})(jQuery);
