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
$id = 'full-width-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'full-width-section animatedSection';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php $backColor = get_field("background_color");?>
<?php $textAlign = get_field("text_alignment");?>
<section id="<?php echo esc_attr($id); ?>"
  class="<?php echo esc_attr($className); ?> <?php echo $backColor;?>-background <?php echo $textAlign;?>-text-alignment">
  <div class="content">
    <?php if( have_rows('inner_content') ): while( have_rows('inner_content') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
    $headline = get_sub_field('headline');
    $body = get_sub_field('body', false, false);
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="full-width-inner">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($headline):?>
      <h1>
        <?php echo $headline;?>
      </h1>
      <?php endif;?>
      <?php if($body):?>
      <h6><?php echo $body;?></h6>
      <?php endif;?>
      <?php if($btn_text):?>
      <div class="seemax-button">
        <span><?php echo $btn_text;?></span>
        <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
      </div>
      <?php endif;?>
    </div>
    <?php endwhile;endif;?>
  </div>
</section>