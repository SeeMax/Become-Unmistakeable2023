<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'image-text-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-text-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<?php $backColor = get_field("background_color");?>
<?php $highlightColor = get_field("highlight_color");?>
<?php $leftRight = get_field("image_left_or_right");?>
<section id="<?php echo esc_attr($id); ?>"
  class="<?php echo esc_attr($className); ?> <?php echo $backColor;?>-background <?php echo $leftRight;?>-image-section <?php echo $highlightColor;?>-text-section">
  <div class="content">
    <?php if( have_rows('left_half') ): while( have_rows('left_half') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
    $preHeadline = get_sub_field('pre_headline');
    $headline = get_sub_field('headline');
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="image-text-left-side c-width-50">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($preHeadline):?>
      <h5 class="preheadline">
        <?php echo $preHeadline;?>
      </h5>
      <?php endif;?>
      <?php if($headline):?>
      <h2>
        <?php echo $headline;?>
      </h2>
      <?php endif;?>
      <?php if($body):?>
      <?php echo $body;?>
      <?php endif;?>
      <?php if($btn_text):?>
      <div class="seemax-button <?php echo $highlightColor;?>-button">
        <span><?php echo $btn_text;?></span>
        <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
      </div>
      <?php endif;?>
    </div>
    <?php endwhile;endif;?>

    <?php if( have_rows('right_half') ): while( have_rows('right_half') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
    $headline = get_sub_field('headline');
    $preHeadline = get_sub_field('pre_headline');
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="image-text-right-side c-width-50">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($preHeadline):?>
      <h5 class="preheadline">
        <?php echo $preHeadline;?>
      </h5>
      <?php endif;?>
      <?php if($headline):?>
      <h2>
        <?php echo $headline;?>
      </h2>
      <?php endif;?>
      <?php if($body):?>
      <?php echo $body;?>
      <?php endif;?>
      <?php if($btn_text):?>
      <div class="seemax-button <?php echo $highlightColor;?>-button">
        <span><?php echo $btn_text;?></span>
        <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
      </div>
      <?php endif;?>
    </div>
    <?php endwhile;endif;?>
  </div>
</section>