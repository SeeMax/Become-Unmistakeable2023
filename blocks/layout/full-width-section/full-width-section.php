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
$className = 'full-width-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php
  $CorI = get_field('color_or_image_background');  
  $color = get_field('background_color');
  $overlayColor = get_field('image_overlay_color');
  $image = get_field('image');    
  $headline = get_field('headline');
  $subheadline = get_field('subheadline');
  $body = get_field('body');
  if( have_rows('button') ): while( have_rows('button') ) : the_row();
    $btn_dest = get_sub_field('button_destination');
    $btn_text = get_sub_field('button_text');
  endwhile;endif;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className);?> 
  <?php if($CorI == 'color'):?>
    <?php echo $color;?>-full-width-section">
  <?php else:?>
    background-image-section <?php echo $overlayColor;?>-image-overlay-section" style="background-image:url(<?php echo $image['url'];?>)">
  <?php endif;?>
  <div class="c-block-fill full-width-section-image-overlay"></div>
  <div class="content">
    <?php if($headline):?>
      <h2><?php echo $headline;?></h2>
    <?php endif;?>  
    <?php if($subheadline):?>
      <h4><?php echo $subheadline; ?></h4>
    <?php endif;?>
    <?php if($body):?>
      <?php echo $body;?>
    <?php endif;?>
    <?php if($btn_text):?>
      <div class="seemax-button">
        <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
        <span><?php echo $btn_text;?></span>
      </div>
    <?php endif;?>
  </div>
</section>
