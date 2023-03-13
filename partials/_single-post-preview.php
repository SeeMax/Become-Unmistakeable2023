<div class="single-post-preview c-width-32">
  <div class="single-post-preview-image background-image-section"
    style="background-image:url(
    <?php if ( get_the_post_thumbnail() != '' ):?>
      <?php the_post_thumbnail_url();?>
    <?php else:?>
      <?php echo catch_that_image();?>
    <?php endif;?>
    );"
  >
    <a class="no-after c-block-fill" href="<?php the_permalink();?>"></a>
  </div>
  <div class="single-post-preview-text">
    <h6><?php the_category(' | ') ?></h6>
    <h3>
      <?php the_title();?>
      <a class="no-after c-block-fill" href="<?php the_permalink();?>"></a>
    </h3>
    <h6><?php the_time('F jS, Y') ?></h6>
    <p>
      <?php the_excerpt();?>
      <a class="no-after c-block-fill" href="<?php the_permalink();?>"></a>
    </p>
  </div>
</div> 