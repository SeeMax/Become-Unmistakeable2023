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
$id = 'signup-form-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'signup-form-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php
  $color = get_field('background_color');
  $headline = get_field('headline');
  $subheadline = get_field('subheadline');
  $body = get_field('body');
  $embed = get_field('form_embed_code');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className);?> <?php echo $color;?>-signup-form-section">
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
    <div class="signup-embed-code">
      <?php echo $embed;?>
    </div>  
  </div>
</section>
