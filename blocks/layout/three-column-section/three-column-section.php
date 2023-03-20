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
$id = 'three-column-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'three-column-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<?php $backColor = get_field("background_color");?>
<?php $highlightColor = get_field("highlight_color");?>
<section id="<?php echo esc_attr($id); ?>"
  class="<?php echo esc_attr($className); ?> <?php echo $backColor;?>-background <?php echo $highlightColor;?>-text-section">
  <div class="content">
    <?php if( have_rows('left_half') ): while( have_rows('left_half') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
    $headline = get_sub_field('headline');
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="three-column-left c-width-33-3">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($headline):?>
      <h3>
        <?php echo $headline;?>
      </h3>
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

    <?php if( have_rows('center_half') ): while( have_rows('center_half') ) : the_row();
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $svgCode = get_sub_field('svg_code');
    $headline = get_sub_field('headline');
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="three-column-center c-width-33-3">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($headline):?>
      <h3>
        <?php echo $headline;?>
      </h3>
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
    $body = get_sub_field('body');
    if( have_rows('button') ): while( have_rows('button') ) : the_row();
      $btn_dest = get_sub_field('button_destination');
      $btn_text = get_sub_field('button_text');
    endwhile;endif;?>
    <div class="three-column-right c-width-33-3">
      <?php if ($imageType == 'img'):?>
      <img src="<?php echo $image['url'];?>">
      <?php else:?>
      <?php echo $svgCode;?>
      <?php endif;?>
      <?php if($headline):?>
      <h3>
        <?php echo $headline;?>
      </h3>
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