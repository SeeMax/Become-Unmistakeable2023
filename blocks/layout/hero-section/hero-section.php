<?php
  /**
  * Hero Block Template.
  * @param   array $block The block settings and attributes.
  * @param   string $content The block inner HTML (empty).
  * @param   bool $is_preview True during AJAX preview.
  * @param   (int|string) $post_id The post ID this block is saved to.
  */
  // Create id attribute allowing for custom "anchor" value.
  $id = 'hero-section-' . $block['id'];
  if( !empty($block['anchor']) ) {$id = $block['anchor'];}
  // Create class attribute allowing for custom "className" and "align" values.
  $className = 'hero-section heroSection';
  if( !empty($block['className']) ) {$className .= ' ' . $block['className'];}
  if( !empty($block['align']) ) {$className .= ' align' . $block['align'];}
?>
<?php if( have_rows('image_half') ): while( have_rows('image_half') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
  ?>
<?php endwhile;endif;?>
<?php if( have_rows('text_half') ): while( have_rows('text_half') ) : the_row();    
      $headline = get_sub_field('headline');
      $body = get_sub_field('body');
      if( have_rows('button') ): while( have_rows('button') ) : the_row();
        $btn_dest = get_sub_field('button_destination');
        $btn_text = get_sub_field('button_text');
        $btn_color = get_sub_field('button_color');
      endwhile;endif;
    endwhile;endif;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class=" content">
    <div class="hero-image-half c-width-40">
      <?php if ($imageType == 'img'):?>
      <img src="(<?php echo $image['url'];?>)">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
    </div>
    <div class="hero-text-half c-width-60">
      <?php if($headline):?>
      <h1>
        <?php echo $headline;?>
      </h1>
      <?php endif;?>
      <?php if($body):?>
      <span class="big-body"><?php echo $body;?></span>
      <?php endif;?>
      <?php if($btn_text):?>
      <div class="seemax-button <?php echo $btn_color;?>-button">
        <span><?php echo $btn_text;?></span>
        <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
      </div>
      <?php endif;?>
    </div>
  </div>
</section>