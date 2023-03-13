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
$id = 'half-half-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'half-half-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php
  $LorR = get_field('image_left_or_right');
  $BorW = get_field('black_or_white');
  $InorFull = get_field('inset_or_full');
  $image = get_field('image');    
  if( have_rows('text_half') ): while( have_rows('text_half') ) : the_row();
    $headline = get_sub_field('headline');
    $subheadline = get_sub_field('subheadline');
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;
  endwhile;endif;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo $BorW;?>-half-half-section <?php echo $LorR;?>-half-half-section <?php echo $InorFull;?>-half-half-section">
  <div class="content">
    <?php if($InorFull == 'full'):?>
      <div class="half-half-image-half c-width-50 background-image-section" style="background-image:url(<?php echo $image['url'];?>)">
      </div>
    <?php else:?>
      <div class="half-half-image-half c-width-50">
        <img src="<?php echo $image['url'];?>">
      </div> 
    <?php endif;?>
    <div class="half-half-text-half c-width-50">
      <div class="half-half-text-half-inner">
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
    </div> 
  </div>
</section>
